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

    public function getSettings($user_id, $raffle_id)
    {
        return RaffleUser::where('user_id', $user_id)
            ->where('raffle_id', $raffle_id)
            ->value('settings');
    }

    public function getMultiplier($user_id, $raffle_id)
    {
        $settings = RaffleUser::where('user_id', $user_id)
            ->where('raffle_id', $raffle_id)
            ->value('settings');

        return $settings['multiplier'] ?? 70;
    }
}
