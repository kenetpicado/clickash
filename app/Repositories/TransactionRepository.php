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
            ->select(['id', 'digit', 'amount', 'client', 'hour', 'created_at', 'raffle_id', 'user_id', 'status'])
            ->paginate();
    }

    public function getTeamCurrentTotal(array $request)
    {
        return self::setTeam()
            ->where('raffle_id', $request['raffle_id'])
            ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
            ->where('hour', $request['hour'])
            ->where('digit', $request['digit'])
            ->sum('amount');
    }

    public function store(array $request)
    {
        return Transaction::create([
            'user_id' => auth()->id(),
            'raffle_id' => $request['raffle_id'],
            'digit' => $request['digit'],
            'amount' => $request['amount'],
            'hour' => $request['hour'],
            'client' => $request['client'],
            'prize' => $request['prize'],
            'status' => 'PURCHASED',
        ]);
    }

    public function markWinners($winningNumber)
    {
        self::setTeam()
            ->where('raffle_id', $winningNumber->raffle_id)
            ->where('hour', $winningNumber->hour)
            ->where('digit', $winningNumber->number)
            ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
            ->update(['status' => 'WINNER']);
    }

    public function getWinnersByRaffle($raffle_id)
    {
        return Transaction::where('raffle_id', $raffle_id)
            ->where('status', 'WINNER')
            ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
            ->with('user:id,name')
            ->orderBy('hour')
            ->get();
    }
}
