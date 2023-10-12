<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository
{
    public function getUserTransactions($user)
    {
        return $user->transactions()->with('raffle:id,name')->latest('id')->paginate();
    }

    public function getTeamTransactions()
    {
        $team = (new UserRepository)->getTeam();

        return Transaction::whereIn('user_id', $team)->with(['user:id,name', 'raffle:id,name'])->latest()->paginate();
    }
}
