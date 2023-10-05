<?php

namespace App\Services;

use App\Models\BlockedNumber;

class BlockedNumberService
{
    public function store(array $request, $raffle)
    {
        BlockedNumber::updateOrCreate([
            'number' => $request['number'],
            'user_id' => auth()->id(),
            'raffle_id' => $raffle,
        ], [
            'settings' => $request['settings'],
        ]);
    }

    public function get($raffle)
    {
        return BlockedNumber::query()
            ->where('user_id', auth()->id())
            ->where('raffle_id', $raffle)
            ->latest('id')
            ->get(['id', 'number', 'settings']);
    }
}
