<?php

namespace App\Repositories;


class TransactionRepository
{
    public function getUserTransactions($user)
    {
        return $user->transactions()->with('raffle:id,name')->latest('id')->paginate();
    }
}
