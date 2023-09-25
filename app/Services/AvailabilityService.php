<?php

namespace App\Services;

use App\Enums\DayEnum;
use App\Models\Availability;
use App\Models\RaffleUser;
use App\Models\User;

class AvailabilityService
{
    public function index($raffle)
    {
        return Availability::query()
            ->where('availability_type', User::class)
            ->where('availability_id', auth()->id())
            ->where("raffle_id", $raffle)
            ->orderBy('order')
            ->get();
    }

    public function check($day, $raffle, $availability = null)
    {
        $dayNumber = DayEnum::getDayNumber($day);

        return Availability::query()
            ->where('availability_type', User::class)
            ->where('availability_id', auth()->id())
            ->where('raffle_id', $raffle)
            ->where('order', $dayNumber)
            ->when($availability, function ($query) use ($availability) {
                $query->where('id', '!=', $availability);
            })
            ->exists();
    }

    public function store(array $request, $raffle): void
    {
        Availability::create([
            'day' => $request['day'],
            'order' => DayEnum::getDayNumber($request['day']),
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],
            'blocked_hours' => $request['blocked_hours'],
            'raffle_id' => $raffle,
            'availability_id' => auth()->id(),
            'availability_type' => User::class
        ]);
    }

    public function update(array $request, $id)
    {
        Availability::query()
            ->where('id', $id)
            ->update([
                'day' => $request['day'],
                'order' => DayEnum::getDayNumber($request['day']),
                'start_time' => $request['start_time'],
                'end_time' => $request['end_time'],
                'blocked_hours' => $request['blocked_hours'],
            ]);
    }
}
