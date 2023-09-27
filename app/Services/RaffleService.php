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
        $user_id = (new UserService)->getUserId();
        $is_owner = (new UserService)->isOwner();

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
            ->with(['raffle_user' => function ($query) use ($user_id) {
                $query->where('user_id', $user_id)->select('id', 'settings','raffle_id', 'user_id');
            }])
            ->with([
                "blockedNumbers" => function ($query) use ($user_id) {
                    $query->where('user_id', $user_id)->select('id', 'number', 'raffle_id', 'user_id');
                },
                "currentAvailability" => function ($query) use ($user_id) {
                    $query->where('user_id', $user_id)->select('id', 'raffle_id', 'user_id', 'blocked_hours');
                }
            ])
            ->get(['id', 'name', 'image'])
            ->transform(function ($raffle) {
                $raffle->settings = $raffle->raffle_user->settings;
                $raffle->blocked_numbers = $raffle->blockedNumbers->pluck('number');
                $raffle->blocked_hours = collect($raffle->currentAvailability->blocked_hours ?? [])
                    ->filter(function ($value, $key) {
                        return $value > now()->format('H:i:s');
                    })
                    ->values();
                unset($raffle->raffle_user);
                unset($raffle->blockedNumbers);
                unset($raffle->currentAvailability);
                return $raffle;
            });
    }

    public function getBlockedHours($raffle)
    {
        $user_id = (new UserService)->getUserId();

        return Availability::query()
            ->where('availability_type', User::class)
            ->where('availability_id', $user_id)
            ->where('raffle_id', $raffle)
            ->where('order', now()->dayOfWeek)
            ->value('blocked_hours');
    }

    public function getNextBlockedHours($raffle)
    {
        $blockedHours = self::getBlockedHours($raffle);

        $nextBlockedHours = collect($blockedHours)->filter(function ($value, $key) {
            return $value > now()->format('H:i:s');
        });

        return $nextBlockedHours->values();
    }

    public function getBlockedNumbers($raffle)
    {
        $user_id = (new UserService)->getUserId();

        return BlockedNumber::query()
            ->where('user_id', $user_id)
            ->where('raffle_id', $raffle)
            ->pluck('number');
    }
}
