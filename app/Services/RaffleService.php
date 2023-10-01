<?php

namespace App\Services;

use App\Models\Availability;
use App\Models\BlockedNumber;
use App\Models\Raffle;
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
            ->when(!$is_owner, function ($query) use ($user_id, $time) {
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
                    $query->where('user_id', $user_id)->select('id', 'settings','raffle_id', 'user_id');
                },
                "currentAvailability" => function ($query) use ($user_id) {
                    $query->where('user_id', $user_id)->select('id', 'raffle_id', 'user_id', 'blocked_hours');
                }
            ])
            ->get(['id', 'name', 'image'])
            ->transform(function ($raffle) {
                $raffle->settings = $raffle->raffle_user->settings;
                $raffle->blocked_hours = collect($raffle->currentAvailability->blocked_hours ?? [])
                    ->filter(function ($value, $key) {
                        return $value > now()->format('H:i:s');
                    })
                    ->values();
                unset($raffle->raffle_user);
                unset($raffle->currentAvailability);
                return $raffle;
            });
    }
}
