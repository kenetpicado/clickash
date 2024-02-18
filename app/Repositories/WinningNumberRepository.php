<?php

namespace App\Repositories;

use App\Models\WinningNumber;
use Carbon\Carbon;

class WinningNumberRepository
{
    public function getWinningNumbers($raffle_id, $request = [])
    {
        return WinningNumber::where('raffle_id', $raffle_id)
            ->where('user_id', auth()->id())
            ->when(isset($request['date']), function ($query) use ($request) {
                $query->whereDate('date', Carbon::parse($request['date']));
            }, function ($query) {
                $query->whereDate('date', Carbon::today());
            })
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
            'date' => Carbon::today(),
        ]);
    }

    public function alreadyExists($raffle, $hour)
    {
        return WinningNumber::where('raffle_id', $raffle)
            ->where('hour', $hour)
            ->where('date', Carbon::today())
            ->exists();
    }
}
