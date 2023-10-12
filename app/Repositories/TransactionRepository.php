<?php

namespace App\Repositories;

use App\Models\Transaction;
use Carbon\Carbon;

class TransactionRepository
{
    public function getByUser($user)
    {
        return $user->transactions()->with('raffle:id,name')->latest('id')->paginate();
    }

    private function setTeam()
    {
        $team = (new UserRepository)->getTeam();

        return Transaction::whereIn('user_id', $team);
    }

    public function getByTeam()
    {
        return self::setTeam()->with(['user:id,name', 'raffle:id,name'])->latest('id')->paginate();
    }

    public function getTeamByRaffle($raffle_id)
    {
        return self::setTeam()->where('raffle_id', $raffle_id)->with('user:id,name')->latest('id')->paginate();
    }

    public function getToday()
    {
        return Transaction::where('user_id', auth()->id())
            ->latest('id')
            ->with('raffle:id,name')
            ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
            ->select(['id', 'digit', 'amount', 'client', 'hour', 'created_at', 'raffle_id', 'user_id'])
            ->paginate();
    }
}
