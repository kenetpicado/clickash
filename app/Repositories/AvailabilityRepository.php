<?php

namespace App\Repositories;

use App\Models\Availability;
use App\Services\DateTimeService;
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

    public function updateOrCreate(array $request, $raffle): void
    {
        Availability::updateOrCreate([
            'day' => $request['day'],
            'order' => $request['order'],
            'raffle_id' => $raffle,
            'user_id' => auth()->id(),
        ], [
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],
            'blocked_hours' => (new DateTimeService)->formatHours($request['blocked_hours']),
        ]);
    }

    public function update(array $request, $id)
    {
        Availability::where('id', $id)
            ->update([
                'start_time' => $request['start_time'],
                'end_time' => $request['end_time'],
                'blocked_hours' => (new DateTimeService)->formatHours($request['blocked_hours']),
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
