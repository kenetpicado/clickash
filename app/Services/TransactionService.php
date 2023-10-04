<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;

class TransactionService
{
    public function get(array $request, $raffle_id = null)
    {
        $start_date = $request['start_date'] . ' 00:00:00';
        $end_date = $request['end_date'] . ' 23:59:59';

        $teamIds = User::where('id', auth()->id())
            ->orWhere('user_id', auth()->id())
            ->pluck('id');

        return Transaction::query()
            ->when($raffle_id, function ($query) use ($raffle_id) {
                $query->where('raffle_id', $raffle_id);
            }, function ($query) {
                $query->with('raffle:id,name');
            })
            ->whereIn('user_id', $teamIds)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->with('user:id,name')
            ->orderBy('id', $request['order'] ?? 'desc')
            ->paginate();
    }

    public function getCurrentTotal(array $request)
    {
        $userService = new UserService;
        $user_id = $userService->getUserId();

        return Transaction::query()
            ->whereIn('user_id', $userService->getTeamIds($user_id))
            ->where('raffle_id', $request['raffle_id'])
            ->where('created_at', '>=', now()->format('Y-m-d') . ' 00:00:00')
            ->where('hour', $request['hour'])
            ->where('digit', $request['digit'])
            ->sum('amount');
    }
}
