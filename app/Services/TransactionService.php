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
        $transaction = $this->transactionRepository->store($request+ [
            'prize' => self::calculatePrize($request['super_x'], $request['amount'], $settings['multiplier']),
        ]);

        $transaction->load('raffle:id,name');

        return $transaction;
    }

    public function calculatePrize(bool $super_x, $amount, $multiplier)
    {
        return $super_x ? ($amount * $multiplier) * 2 : $amount * $multiplier;
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
}
