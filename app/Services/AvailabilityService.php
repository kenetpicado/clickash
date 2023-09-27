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
        $user_id = (new UserService)->getUserId();

        return Availability::query()
            ->where('user_id', $user_id)
            ->where("raffle_id", $raffle)
            ->orderBy('order')
            ->get();
    }

    public function check($day, $raffle, $availability = null)
    {
        $dayNumber = DayEnum::getDayNumber($day);

        return Availability::query()
            ->where('user_id', auth()->id())
            ->where('raffle_id', $raffle)
            ->where('order', $dayNumber)
            ->when($availability, function ($query) use ($availability) {
                $query->where('id', '!=', $availability);
            })
            ->exists();
    }

    public function store(array $request, $raffle): void
    {
        $blockedHours = array_unique($request['blocked_hours']);

        sort($blockedHours);

        Availability::create([
            'day' => $request['day'],
            'order' => DayEnum::getDayNumber($request['day']),
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],
            'blocked_hours' => $blockedHours,
            'raffle_id' => $raffle,
            'user_id' => auth()->id(),
        ]);
    }

    public function update(array $request, $id)
    {
        $blockedHours = array_unique($request['blocked_hours']);

        sort($blockedHours);

        Availability::query()
            ->where('id', $id)
            ->update([
                'day' => $request['day'],
                'order' => DayEnum::getDayNumber($request['day']),
                'start_time' => $request['start_time'],
                'end_time' => $request['end_time'],
                'blocked_hours' => $blockedHours,
            ]);
    }
}
