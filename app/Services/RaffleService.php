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
                        ->where('availability_type', User::class)
                        ->where('order', now()->dayOfWeek)
                        ->where('start_time', '<=', $time)
                        ->where('end_time', '>=', $time)
                        ->where('availability_id', $user_id);
                });
            })
            ->with(['raffle_user' => function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            }])
            ->get(['id', 'name', 'image', 'settings']);
    }

    public function getBlockedHours($raffle)
    {
        return Availability::query()
            ->where('availability_type', User::class)
            ->where('availability_id', auth()->id())
            ->where('raffle_id', $raffle)
            ->where('order', now()->dayOfWeek)
            ->value('blocked_hours');
    }

    public function getBlockedNumbers($raffle)
    {
        return BlockedNumber::query()
            ->where('user_id', auth()->id())
            ->where('raffle_id', $raffle)
            ->pluck('number');
    }
}
