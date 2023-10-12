<?php

namespace App\Repositories;

use App\Models\RaffleUser;

class RaffleUserRepository
{
    public function getRaffles()
    {
        return RaffleUser::where('user_id', auth()->id())->with('raffle:id,name')->get(['id', 'raffle_id', 'settings', 'user_id']);
    }

    public function updateSettings($raffle, $settings): void
    {
        RaffleUser::where('user_id', auth()->id())
            ->where('raffle_id', $raffle)
            ->update([
                'settings' => $settings,
            ]);
    }
}
