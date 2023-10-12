<?php

namespace App\Repositories;

use App\Models\Transaction;
use Carbon\Carbon;

class TransactionRepository
{
    public function getByUser($user, array $request = [])
    {
        $interval = null;

        if (isset($request['start_date']) && isset($request['end_date'])) {
            $start_date = $request['start_date'] . ' 00:00:00';
            $end_date = $request['end_date'] . ' 23:59:00';

            $interval = [$start_date,  $end_date];
        }

        return $user->transactions()
            ->with('raffle:id,name')
            ->when($interval, function ($query, $interval) {
                return $query->whereBetween('created_at', $interval);
            })
            ->orderBy('id', $request['order'] ?? 'desc')
            ->paginate();
    }

    public function getByTeam()
    {
        $team = (new UserRepository)->getTeam();

        return Transaction::whereIn('user_id', $team)->with(['user:id,name', 'raffle:id,name'])->latest()->paginate();
    }

    public function getByRaffle($raffle_id)
    {
        $team = (new UserRepository)->getTeam();

        return Transaction::where('raffle_id', $raffle_id)->whereIn('user_id', $team)->with('user:id,name')->latest('id')->paginate();
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
