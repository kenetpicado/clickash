<?php

namespace App\Repositories;

use App\Models\BlockedNumber;

class BlockedNumberRepository
{
    public function getByRaffle($raffle)
    {
        return BlockedNumber::where('user_id', auth()->id())->where('raffle_id', $raffle)->orderBy('number')->get(['id', 'number', 'settings']);
    }

    public function updateOrCreate(array $request, $raffle)
    {
        BlockedNumber::updateOrCreate([
            'number' => $request['number'],
            'user_id' => auth()->id(),
            'raffle_id' => $raffle,
        ], [
            'settings' => $request['settings'],
        ]);
    }
}
