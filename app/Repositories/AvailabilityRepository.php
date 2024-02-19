<?php

namespace App\Repositories;

use App\Models\Availability;
use App\Services\DateTimeServiceCopy;
use Carbon\Carbon;

class AvailabilityRepository
{
    public function getRaffleAvailability($raffle)
    {
        return Availability::query()
            ->where('user_id', auth()->id())
            ->where('raffle_id', $raffle)
            ->orderBy('order')
            ->get(['id', 'order', 'day', 'start_time', 'end_time', 'blocked_hours']);
    }

    public function update(array $request, $id)
    {
        Availability::where('id', $id)->update($request);
    }

    public function getTodayBlockedHours($raffle_id, $user_id)
    {
        return Availability::where('raffle_id', $raffle_id)
            ->where('user_id', $user_id)
            ->where('order', Carbon::now()->dayOfWeek)
            ->value('blocked_hours');
    }

    public function getAllRaffleHours($raffle_id)
    {
        return Availability::where('raffle_id', $raffle_id)
            ->where('user_id', auth()->user()->getOwnerId())
            ->pluck('blocked_hours')
            ->flatten()
            ->unique()
            ->sort()
            ->values();
    }

    public function store(array $request): void
    {
        Availability::create($request);
    }
}
