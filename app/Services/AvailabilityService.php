<?php

namespace App\Services;

use App\Repositories\AvailabilityRepository;
use Carbon\Carbon;

class AvailabilityService
{
    public function checkTransactionHour($raffle_id)
    {
        $currentTime = Carbon::now();
        $dateTimeService = new DateTimeService();

        // CHECK IF THE TIME IS BLOCKED
        $blockedHours = (new AvailabilityRepository)->getTodayBlockedHours($raffle_id, auth()->user()->getOwnerId());

        foreach ($blockedHours as $blockedHour) {
            $message = $dateTimeService->getBlockedHourMessage($currentTime, $blockedHour);

            if ($message) {
                abort(422, $message);
            }
        }
    }
}
