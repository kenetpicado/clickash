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

    public function store(array $request)
    {
        $availabilityRepository = new AvailabilityRepository();
        $blockedNumberRepository = new BlockedNumberRepository();
        $raffleUserRepository = new RaffleUserRepository();

        $dateTimeService = new DateTimeService();

        $ownerId = auth()->user()->getOwnerId();

        // CHECK IF THE TIME IS BLOCKED
        $blockedHours = $availabilityRepository->getTodayBlockedHours($request['raffle_id'], $ownerId);

        foreach ($blockedHours as $blockedHour) {
            $message = $dateTimeService->getBlockedHourMessage($this->currentTime, $blockedHour);

            if ($message) {
                abort(422, $message);
            }
        }

        // CHECK IF THE NUMBER IS BLOCKED
        $blockedNumber = $blockedNumberRepository->findWhere($request['raffle_id'], $ownerId, $request['digit']);

        if ($blockedNumber) {
            if ($blockedNumber['settings']['individual_limit']) {
                self::checkIndividualLimit($request['amount'], $blockedNumber['settings']['individual_limit']);
            }

            if ($blockedNumber['settings']['general_limit']) {
                self::checkGeneralLimit($request, $blockedNumber['settings']['general_limit']);
            }
        }

        // CHECK IS SETTINGS ARE BLOCKED
        $settings = $raffleUserRepository->getSettings($ownerId, $request['raffle_id']);

        if ($settings['individual_limit']) {
            self::checkIndividualLimit($request['amount'], $settings['individual_limit']);
        }

        if ($settings['general_limit']) {
            self::checkGeneralLimit($request, $settings['general_limit']);
        }

        // STORE TRANSACTION
        $request['prize'] = $request['amount'] * $settings['multiplier'];

        if ($request['super_x']) {
            $request['amount'] = $request['amount'] * 2;
            $request['prize'] = $request['prize'] * 2;
        }

        $transaction = $this->transactionRepository->store($request);

        $transaction->load('raffle:id,name');

        return $transaction;
    }

    public function validateBulkTransactions(array $request)
    {
        $availabilityRepository = new AvailabilityRepository();
        $blockedNumberRepository = new BlockedNumberRepository();
        $raffleUserRepository = new RaffleUserRepository();
        $dateTimeService = new DateTimeService();

        $ownerId = auth()->user()->getOwnerId();

        $raffleSettings = $raffleUserRepository->getSettings($ownerId, $request['raffle_id']);

        // CHECK IF THE TIME IS BLOCKED
        $blockedHours = $availabilityRepository->getTodayBlockedHours($request['raffle_id'], $ownerId);

        foreach ($blockedHours as $blockedHour) {
            $message = $dateTimeService->getBlockedHourMessage($this->currentTime, $blockedHour);

            if ($message) {
                abort(422, $message);
            }
        }

        foreach ($request['data'] as $transaction) {

            // CHECK IF THE NUMBER IS BLOCKED
            $blockedNumber = $blockedNumberRepository->findWhere($request['raffle_id'], $ownerId, $transaction['digit']);

            if ($blockedNumber) {
                if ($blockedNumber['settings']['individual_limit']) {
                    self::checkIndividualLimit($transaction['amount'], $blockedNumber['settings']['individual_limit']);
                }

                if ($blockedNumber['settings']['general_limit']) {
                    self::checkGeneralLimit($transaction + ['raffle_id' => $request['raffle_id']], $blockedNumber['settings']['general_limit']);
                }
            }

            // CHECK IS SETTINGS ARE BLOCKED
            if ($raffleSettings['individual_limit']) {
                self::checkIndividualLimit($transaction['amount'], $raffleSettings['individual_limit']);
            }

            if ($raffleSettings['general_limit']) {
                self::checkGeneralLimit($transaction + ['raffle_id' => $request['raffle_id']], $raffleSettings['general_limit']);
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

    public function checkGeneralLimit($request, $limit)
    {
        $transactionsTotalAmount = $this->transactionRepository->getTeamCurrentTotal($request);

        if ($transactionsTotalAmount + $request['amount'] > $limit) {
            $availableAmount = $limit - $transactionsTotalAmount;
            abort(422, 'El monto disponible es C$'.$availableAmount);
        }
    }

    public function destroy($transaction)
    {
        if (Carbon::parse($transaction->hour)->isPast()) {
            abort(403, 'No puedes eliminar una transacción que ya pasó');
        }

        $this->transactionRepository->delete($transaction);
    }
}
