<?php

namespace App\Observers;

use App\Models\Raffle;
use App\Models\RaffleUser;
use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        if ($user->role === 'owner') {
            $raffles = Raffle::with('availability')->get(['id', 'settings']);

            $raffles->each(function ($raffle) use ($user) {
                $created = RaffleUser::create([
                    'raffle_id' => $raffle->id,
                    'user_id' => $user->id,
                    'settings' => $raffle->settings
                ]);

                foreach ($raffle->availability as $availability) {
                    $created->availability()->create([
                        'day' => $availability->day,
                        'order' => $availability->order,
                        'start_time' => $availability->start_time,
                        'end_time' => $availability->end_time,
                        'blocked_hours' => $availability->blocked_hours,
                    ]);
                }
            });
        }
    }
}
