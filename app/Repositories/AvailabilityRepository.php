<?php

namespace App\Repositories;

use App\Models\Availability;
use Carbon\Carbon;

class AvailabilityRepository
{
    public function getByRaffle($raffle)
    {
        return Availability::query()
            ->where('user_id', auth()->id())
            ->where('raffle_id', $raffle)
            ->orderBy('order')
            ->get(['id', 'order', 'day', 'start_time', 'end_time', 'blocked_hours']);
    }

    public function store(array $request, $raffle): void
    {
        $parsedHours = collect($request['blocked_hours'])
            ->transform(fn ($hour) => Carbon::parse($hour)->format('H:i:s'))
            ->unique()
            ->sort()
            ->values();

        Availability::create([
            'day' => $request['day'],
            'order' => $request['order'],
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],
            'blocked_hours' => $parsedHours,
            'raffle_id' => $raffle,
            'user_id' => auth()->id(),
        ]);
    }

    public function update(array $request, $id)
    {
        $parsedHours = collect($request['blocked_hours'])
            ->transform(fn ($hour) => Carbon::parse($hour)->format('H:i:s'))
            ->unique()
            ->sort()
            ->values();

        Availability::query()
            ->where('id', $id)
            ->update([
                'start_time' => $request['start_time'],
                'end_time' => $request['end_time'],
                'blocked_hours' => $parsedHours,
            ]);
    }

    public function getTodayBlockedHours($raffle_id, $user_id)
    {
        return Availability::where('raffle_id', $raffle_id)
            ->where('user_id', $user_id)
            ->where('order', Carbon::now()->dayOfWeek)
            ->value('blocked_hours');
    }
}
