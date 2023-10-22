<?php

namespace App\Repositories;

use App\Enums\TransactionStatusEnum;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionRepository
{
    public function markAsPaid($transaction)
    {
        Transaction::where('id', $transaction)->update(['status' => TransactionStatusEnum::PAID->value]);
    }

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

    public function getMyDaily()
    {
        return Transaction::where('user_id', auth()->id())
            ->latest('id')
            ->with('raffle:id,name')
            ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
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
            'status' => TransactionStatusEnum::SOLD->value,
            'super_x' => $request['super_x'],
        ]);
    }

    public function markWinners($winningNumber)
    {
        self::setTeam()
            ->where('raffle_id', $winningNumber->raffle_id)
            ->where('hour', $winningNumber->hour)
            ->where('digit', $winningNumber->number)
            ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
            ->update(['status' => TransactionStatusEnum::PRIZE->value]);
    }

    public function getWinnersByRaffle($raffle_id)
    {
        return self::setTeam()
            ->where('raffle_id', $raffle_id)
            ->where('status',  TransactionStatusEnum::PRIZE->value)
            ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
            ->with('user:id,name')
            ->orderBy('hour')
            ->get();
    }

    public function getDailyTotalByUser($user)
    {
        return $user->transactions()
            ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
            ->sum('amount');
    }

    public function getDailyTotalByRaffle($raffle_id)
    {
        return self::setTeam()
            ->where('raffle_id', $raffle_id)
            ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
            ->sum('amount');
    }

    public function getDailyTotalByTeam()
    {
        return self::setTeam()
            ->where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
            ->sum('amount');
    }
}
