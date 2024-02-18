<?php

namespace App\Repositories;

use App\Models\BlockedNumber;

class BlockedNumberRepository
{
    public function getRaffleBlockedNumbers($raffle_id)
    {
        return BlockedNumber::where('user_id', auth()->id())
            ->where('raffle_id', $raffle_id)
            ->orderBy('number')
            ->get(['id', 'number', 'settings']);
    }

    public function getUserBlockedNumbers($user_id, $raffle_id = null)
    {
        return BlockedNumber::where('user_id', $user_id)
            ->when($raffle_id, fn ($query) => $query->where('raffle_id', $raffle_id))
            ->with('raffle:id,name')
            ->orderBy('number')
            ->get(['blocked_numbers..id', 'number', 'settings', 'raffle_id']);
    }

    public function store(array $request)
    {
        BlockedNumber::create([
            'number' => $request['number'],
            'settings' => $request['settings'],
            'user_id' => $request['user_id'],
            'raffle_id' => $request['raffle_id'],
        ]);
    }

    public function alreadyExists(array $request)
    {
        return BlockedNumber::query()
            ->where('raffle_id', $request['raffle_id'])
            ->where('number', $request['number'])
            ->where('user_id', $request['user_id'])
            ->exists();
    }

    public function findWhere($rafffle_id, $user_id, $number)
    {
        return BlockedNumber::query()
            ->where('raffle_id', $rafffle_id)
            ->where('user_id', $user_id)
            ->where('number', $number)
            ->first();
    }
}
