<?php

namespace App\Services;

use App\Repositories\AvailabilityRepository;
use App\Repositories\BlockedNumberRepository;
use App\Repositories\RaffleUserRepository;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;

class TransactionService
{
    private $currentTime;

    private $transactionRepository;

    public function __construct()
    {
        $this->currentTime = Carbon::now();
        $this->transactionRepository = new TransactionRepository();
    }

    public function validateBulkTransactions(array $request)
    {
        $availabilityRepository = new AvailabilityRepository();
        $blockedNumberRepository = new BlockedNumberRepository();
        $raffleUserRepository = new RaffleUserRepository();
        $dateTimeService = new DateTimeService();

        $ownerId = auth()->user()->getOwnerId();

        $raffleSettings = $raffleUserRepository->getSettings($ownerId, $request['raffle_id']);

        //CHECK IF THE TIME IS BLOCKED
        $blockedHours = $availabilityRepository->getTodayBlockedHours($request['raffle_id'], $ownerId);

        foreach ($blockedHours as $blockedHour) {
            $message = $dateTimeService->getBlockedHourMessage($this->currentTime, $blockedHour);

            if ($message) {
                abort(422, $message);
            }
        }

        foreach ($request['data'] as $transaction) {

            if (Carbon::parse($transaction['hour'])->isPast()) {
                abort(422, "El turno de las {$transaction['hour']} ya pasó");
            }

            // CHECK IF THE NUMBER IS BLOCKED
            $blockedNumber = $blockedNumberRepository->findWhere($request['raffle_id'], $ownerId, $transaction['digit']);

            if ($blockedNumber) {
                if ($blockedNumber['settings']['individual_limit']) {
                    self::checkIndividualLimit($transaction['amount'], $blockedNumber['settings']['individual_limit']);
                }

                if ($blockedNumber['settings']['general_limit']) {

                    $amount = collect($request['data'])
                        ->where('hour', $transaction['hour'])
                        ->where('digit', $transaction['digit'])
                        ->sum('amount');

                    self::checkGeneralLimit($transaction + ['raffle_id' => $request['raffle_id']], $blockedNumber['settings']['general_limit'], $amount);
                }
            }

            // CHECK IS SETTINGS ARE BLOCKED
            if ($raffleSettings['individual_limit']) {
                self::checkIndividualLimit($transaction['amount'], $raffleSettings['individual_limit']);
            }

            if ($raffleSettings['general_limit']) {

                $amount = collect($request['data'])
                    ->where('hour', $transaction['hour'])
                    ->where('digit', $transaction['digit'])
                    ->sum('amount');

                self::checkGeneralLimit($transaction + ['raffle_id' => $request['raffle_id']], $raffleSettings['general_limit'], $amount);
            }
        }

        return $raffleSettings;
    }

    public function checkIndividualLimit($amount, $limit)
    {
        if ($amount > $limit) {
            abort(422, 'El monto máximo es C$'.$limit);
        }
    }

    public function checkGeneralLimit($request, $limit, $amount)
    {
        $transactionsTotalAmount = $this->transactionRepository->getTeamCurrentTotal($request);

        if ($transactionsTotalAmount + $amount > $limit) {
            $availableAmount = $limit - $transactionsTotalAmount;
            abort(422, "El monto disponible para {$request['digit']} es C$".$availableAmount);
        }
    }

    public function destroy($transaction)
    {
        $transactionHour = Carbon::parse($transaction->created_at)->format('H:i:s');

        if ($transactionHour > $transaction->hour) {
            goto please_do_it;
        }

        if (Carbon::parse($transaction->hour)->isPast()) {
            abort(403, 'No puedes eliminar una transacción que ya pasó');
        }

        please_do_it:
        $this->transactionRepository->delete($transaction);
    }
}
