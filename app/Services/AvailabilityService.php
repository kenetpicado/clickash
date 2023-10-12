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
}
