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

    public function getRafflesWithResults(array $request)
    {
        $ownerId = auth()->user()->getOwnerId();

        return RaffleUser::query()
            ->where('user_id', $ownerId)
            ->with([
                'raffle:id,name',
                'winningNumbers' => fn ($query) => $query->when(
                    isset($request['date']),
                    fn ($query) => $query->where('date', $request['date']),
                    fn ($query) => $query->where('date', Carbon::today())
                )
                    ->where('user_id', $ownerId)
                    ->orderBy('hour')
            ])
            ->get(['id', 'raffle_id', 'user_id']);
    }
}
