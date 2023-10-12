<?php

namespace App\Services;

use App\Models\Availability;
use App\Models\BlockedNumber;
use App\Models\RaffleUser;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;

class TransactionService
{
    public function store(array $request)
    {
        $transactionRepository = new TransactionRepository();

        $userService = new UserService();

        $user_id = $userService->getOwnerId();

        $blockedHours = Availability::query()
            ->where('raffle_id', $request['raffle_id'])
            ->where('user_id', $user_id)
            ->where('order', now()->dayOfWeek)
            ->value('blocked_hours');

        $currentTime = Carbon::now();

        foreach ($blockedHours as $blockedHour) {
            $lessFive = Carbon::createFromFormat('H:i:s', $blockedHour)
                ->subMinutes(5);

            $plusFive = Carbon::createFromFormat('H:i:s', $blockedHour)
                ->addMinutes(5);

            if ($currentTime->between($lessFive, $plusFive)) {
                abort(422, 'No puedes realizar transacciones entre las ' . $lessFive->format('g:i A') . ' y las ' . $plusFive->format('g:i A'));
            }
        }

        $blockedNumber = BlockedNumber::query()
            ->where('raffle_id', $request['raffle_id'])
            ->where('user_id', $user_id)
            ->where('number', $request->digit)
            ->first();

        if ($blockedNumber) {
            if ($blockedNumber['settings']['individual_limit']) {
                if ($request->amount > $blockedNumber['settings']['individual_limit']) {
                    abort(422, 'El monto máximo es C$' . $blockedNumber['settings']['individual_limit']);
                }
            }

            if ($blockedNumber['settings']['general_limit']) {
                $transactionsTotalAmount = $transactionRepository->getTeamCurrentTotal($request->validated());

                if ($transactionsTotalAmount + $request->amount > $blockedNumber['settings']['general_limit']) {
                    $availableAmount = $blockedNumber['settings']['general_limit'] - $transactionsTotalAmount;
                    abort(422, 'El monto disponible es C$' . $availableAmount);
                }
            }
        }

        $settings = RaffleUser::query()
            ->where('user_id', $user_id)
            ->where('raffle_id', $request->raffle_id)
            ->value('settings');

        if ($settings['general_limit']) {
            $transactionsTotalAmount = $transactionRepository->getTeamCurrentTotal($request);

            if ($transactionsTotalAmount + $request->amount > $settings['general_limit']) {
                $availableAmount = $settings['general_limit'] - $transactionsTotalAmount;
                abort(422, 'El monto disponible es C$' . $availableAmount);
            }
        }

        $total = $settings['super_x']
            ? ($request->amount * $settings['multiplier']) * 2
            : $request->amount * $settings['multiplier'];

        $transaction = Transaction::create(
            $request + [
                'user_id' => auth()->id(),
                'prize' => $total,
                'status' => 'PURCHASED'
            ]
        );

        $transaction->load('raffle:id,name');

        return $transaction;
    }
}
