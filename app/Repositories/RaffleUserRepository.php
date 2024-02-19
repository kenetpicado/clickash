<?php

namespace App\Repositories;

use App\Models\RaffleUser;
use Carbon\Carbon;

class RaffleUserRepository
{
    public function updateSettings($raffle, $settings): void
    {
        RaffleUser::where('user_id', auth()->id())->where('raffle_id', $raffle)->update(['settings' => $settings]);
    }

    public function getSettings($user_id, $raffle_id)
    {
        return RaffleUser::where('user_id', $user_id)
            ->where('raffle_id', $raffle_id)
            ->value('settings');
    }
}
