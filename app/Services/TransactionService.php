<?php

namespace App\Services;

use App\Models\BlockedNumber;
use App\Models\RaffleUser;
use App\Repositories\AvailabilityRepository;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;

class TransactionService
{
    private $currentTime;

    public function __construct()
    {
        $this->currentTime = Carbon::now();
    }

    public function store(array $request)
    {
        $transactionRepository  = new TransactionRepository();
        $availabilityRepository = new AvailabilityRepository();
        $userService            = new UserService();
        $dateTimeService        = new DateTimeService();

        $user_id = $userService->getOwnerId();

        // Check if the time is blocked
        $blockedHours = $availabilityRepository->getTodayBlockedHours($request['raffle_id'], $user_id);
        foreach ($blockedHours as $blockedHour) {
            $message = $dateTimeService->getBlockedHourMessage($this->currentTime, $blockedHour);

            if ($message) {
                abort(422, $message);
            }
        }

        // Check if the number is blocked
        $blockedNumber = BlockedNumber::query()
            ->where('raffle_id', $request['raffle_id'])
            ->where('user_id', $user_id)
            ->where('number', $request['digit'])
            ->first();

        if ($blockedNumber) {
            if ($blockedNumber['settings']['individual_limit']) {
                if ($request['amount'] > $blockedNumber['settings']['individual_limit']) {
                    abort(422, 'El monto máximo es C$' . $blockedNumber['settings']['individual_limit']);
                }
            }

            if ($blockedNumber['settings']['general_limit']) {
                $transactionsTotalAmount = $transactionRepository->getTeamCurrentTotal($request);

                if ($transactionsTotalAmount + $request['amount'] > $blockedNumber['settings']['general_limit']) {
                    $availableAmount = $blockedNumber['settings']['general_limit'] - $transactionsTotalAmount;
                    abort(422, 'El monto disponible es C$' . $availableAmount);
                }
            }
        }

        $settings = RaffleUser::query()
            ->where('user_id', $user_id)
            ->where('raffle_id', $request['raffle_id'])
            ->value('settings');

        if ($settings['general_limit']) {
            $transactionsTotalAmount = $transactionRepository->getTeamCurrentTotal($request);

            if ($transactionsTotalAmount + $request['amount'] > $settings['general_limit']) {
                $availableAmount = $settings['general_limit'] - $transactionsTotalAmount;
                abort(422, 'El monto disponible es C$' . $availableAmount);
            }
        }

        $transaction = $transactionRepository->store($request + ['prize' => self::calculatePrize($settings, $request['amount'])]);

        $transaction->load('raffle:id,name');

        return $transaction;
    }

    public function calculatePrize(array $settings, $amount)
    {
        return $settings['super_x'] ? ($amount * $settings['multiplier']) * 2 : $amount * $settings['multiplier'];
    }
}
