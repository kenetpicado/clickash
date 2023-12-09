<?php

namespace App\Services;

use App\Repositories\RaffleRepository;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    //TODO: COULD BE USED FOR OTHER CACHEABLE DATA
    public function getRaffleSettings($raffle_id)
    {
        $key = "raffle_settings_{$raffle_id}_".auth()->user()->getOwnerId();

        return Cache::get($key, function () use ($raffle_id) {
            return (new RaffleRepository)->getRaffleSettings($raffle_id);
        });
    }
}
