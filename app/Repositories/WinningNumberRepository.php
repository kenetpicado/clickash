<?php

namespace App\Repositories;

use App\Models\WinningNumber;
use Carbon\Carbon;

class WinningNumberRepository
{
    public function getByRaffle($raffle_id, $loadRaffle = false)
    {
        return WinningNumber::where('raffle_id', $raffle_id)
            ->where('user_id', auth()->id())
            ->when($loadRaffle, fn ($query) => $query->with('raffle:id,name'))
            ->where('date', Carbon::now()->format('Y-m-d'))
            ->orderBy('hour')
            ->get(['id', 'number', 'hour', 'date', 'raffle_id']);
    }

    public function store(array $request, int $raffle)
    {
        return WinningNumber::create([
            'raffle_id' => $raffle,
            'user_id' => auth()->id(),
            'number' => $request['number'],
            'hour' => $request['hour'],
            'date' => Carbon::now()->format('Y-m-d'),
        ]);
    }

    public function alreadyExists($raffle, $hour)
    {
        return WinningNumber::where('raffle_id', $raffle)
            ->where('hour', $hour)
            ->where('date', Carbon::now()->format('Y-m-d'))
            ->exists();
    }
}
