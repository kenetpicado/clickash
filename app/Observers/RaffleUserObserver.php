<?php

namespace App\Observers;

use App\Models\Raffle;
use App\Models\RaffleUser;
use App\Models\User;

class RaffleUserObserver
{
    public function created(RaffleUser $raffleUser)
    {
        $raffle = Raffle::query()
            ->with([
                'availability' => function ($query) {
                    $query->whereNull('user_id');
                },
            ])
            ->find($raffleUser->raffle_id);

        $user = User::find($raffleUser->user_id);

        $user->availability()->createMany($raffle->availability->toArray());
    }

    public function deleted(RaffleUser $raffleUser)
    {
        $user = User::find($raffleUser->user_id);

        $user->availability()->where('raffle_id', $raffleUser->raffle_id)->delete();
    }
}
