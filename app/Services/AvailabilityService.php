<?php

namespace App\Services;

use App\Enums\DayEnum;
use App\Models\Availability;
use App\Models\RaffleUser;

class AvailabilityService
{
    public function index($raffle_user)
    {
        return Availability::query()
            ->where('availability_type', RaffleUser::class)
            ->where('availability_id', $raffle_user)
            ->orderBy('order')
            ->get();
    }

    public function check($day, $raffle_user, $availability = null)
    {
        $dayNumber = DayEnum::getDayNumber($day);

        return Availability::query()
            ->where('availability_type', RaffleUser::class)
            ->where('availability_id', $raffle_user)
            ->where('order', $dayNumber)
            ->when($availability, function ($query) use ($availability) {
                $query->where('id', '!=', $availability);
            })
            ->exists();
    }

    public function store(array $request, $raffle_user): void
    {
        Availability::create([
            'day' => $request['day'],
            'order' => DayEnum::getDayNumber($request['day']),
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],
            'blocked_hours' => $request['blocked_hours'],
            'availability_id' => $raffle_user,
            'availability_type' => RaffleUser::class
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
