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

    public function getParsedHours($raffle)
    {
        $hours = (new AvailabilityRepository)->getHoursByRaffle($raffle);

        return $hours->transform(function ($item) {
            return [
                'value' => $item,
                'label' => Carbon::parse($item)->format('g:i A')
            ];
        });
    }
}
