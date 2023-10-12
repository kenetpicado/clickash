<?php

namespace App\Repositories;

use App\Models\Raffle;
use Carbon\Carbon;

class RaffleRepository
{
    public function getRaffles()
    {
        $ownerId = auth()->user()->getOwnerId();

        $currentTime = Carbon::now()->format('H:i:s');

        return Raffle::hasUser($ownerId)
            ->when(auth()->user()->isSeller(), function ($query) use ($ownerId, $currentTime) {
                $query->whereHas('currentAvailability', function ($query) use ($ownerId, $currentTime) {
                    $query->where('user_id', $ownerId)->where('start_time', '<=', $currentTime)->where('end_time', '>=', $currentTime);
                });
            })
            ->with([
                'currentAvailability' => function ($query) use ($ownerId) {
                    $query->where('user_id', $ownerId)->select('id', 'raffle_id', 'user_id', 'blocked_hours');
                },
            ])
            ->select('id', 'name')
            ->addSelect([
                'settings' => function ($query) use ($ownerId) {
                    $query->select('settings')->from('raffle_user')->where('user_id', $ownerId)->whereColumn('raffle_id', 'raffles.id');
                },
            ])
            ->get();
    }
}
