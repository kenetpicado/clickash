<?php

namespace App\Services;

use App\Repositories\AvailabilityRepository;
use Carbon\Carbon;

class AvailabilityService
{
    public function getPastHours($raffle_id)
    {
        $hours = (new AvailabilityRepository)->getTodayBlockedHours($raffle_id, auth()->user()->getOwnerId());

        return collect($hours)->filter(function ($value) {
            return Carbon::parse($value)->isPast();
        });
    }
}
