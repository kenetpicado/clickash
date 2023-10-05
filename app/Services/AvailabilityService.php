<?php

namespace App\Services;

use App\Models\Availability;

class AvailabilityService
{
    public function index($raffle)
    {
        return Availability::query()
            ->where('user_id', auth()->id())
            ->where('raffle_id', $raffle)
            ->orderBy('order')
            ->get();
    }

    public function store(array $request, $raffle): void
    {
        Availability::create([
            'day' => $request['day'],
            'order' => $request['order'],
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],
            'blocked_hours' => collect($request['blocked_hours'])->unique()->sort()->values(),
            'raffle_id' => $raffle,
            'user_id' => auth()->id(),
        ]);
    }

    public function update(array $request, $id)
    {
        Availability::query()
            ->where('id', $id)
            ->update([
                'start_time' => $request['start_time'],
                'end_time' => $request['end_time'],
                'blocked_hours' => collect($request['blocked_hours'])->unique()->sort()->values(),
            ]);
    }
}
