<?php

namespace App\Services;

use App\Models\Raffle;
use App\Models\Transaction;
use App\Models\User;

class RaffleService
{
    public function getRaffles()
    {
        $userService = new UserService;
        $user_id = $userService->getUserId();
        $is_owner = $userService->isOwner();

        $time = now()->format('H:i:s');

        return Raffle::query()
            ->whereHas('users', function ($query) use ($user_id) {
                $query->where('raffle_user.user_id', $user_id);
            })
            ->when(! $is_owner, function ($query) use ($user_id, $time) {
                $query->whereIn('id', function ($query) use ($user_id, $time) {
                    $query->select('raffle_id')
                        ->from('availabilities')
                        ->where('user_id', $user_id)
                        ->where('order', now()->dayOfWeek)
                        ->where('start_time', '<=', $time)
                        ->where('end_time', '>=', $time);
                });
            })
            ->with([
                'raffle_user' => function ($query) use ($user_id) {
                    $query->where('user_id', $user_id)->select('id', 'settings', 'raffle_id', 'user_id');
                },
                'currentAvailability' => function ($query) use ($user_id) {
                    $query->where('user_id', $user_id)->select('id', 'raffle_id', 'user_id', 'blocked_hours');
                },
            ])
            ->get(['id', 'name'])
            ->transform(function ($raffle) use ($is_owner) {
                $raffle->settings = $raffle->raffle_user->settings;
                $raffle->blocked_hours = collect($raffle->currentAvailability->blocked_hours ?? [])
                    ->filter(function ($value, $key) use ($is_owner) {
                        if ($is_owner)
                            return $value;
                        else
                            return $value > now()->format('H:i:s');
                    })
                    ->values();
                unset($raffle->raffle_user);
                unset($raffle->currentAvailability);

                return $raffle;
            });
    }

    public function getTransactions($raffle_id, array $request)
    {
        $start_date = $request['start_date'] . ' 00:00:00';
        $end_date = $request['end_date'] . ' 23:59:59';

        $teamIds = User::where('id', auth()->id())
            ->orWhere('user_id', auth()->id())
            ->pluck('id');

        return Transaction::query()
            ->where('raffle_id', $raffle_id)
            ->whereIn('user_id', $teamIds)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->with('user:id,name')
            ->orderBy('id', $request['order'] ?? 'desc')
            ->paginate();
    }
}
