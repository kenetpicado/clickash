<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;

class TransactionService
{
    public function getCurrentTotal(array $request)
    {
        $userService = new UserService;
        $user_id = $userService->getUserId();

        return Transaction::query()
            ->whereIn('user_id', $userService->getTeamIds($user_id))
            ->where('raffle_id', $request['raffle_id'])
            ->where('created_at', '>=', now()->format('Y-m-d').' 00:00:00')
            ->where('hour', $request['hour'])
            ->where('digit', $request['digit'])
            ->sum('amount');
    }
}
