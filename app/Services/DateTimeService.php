<?php

namespace App\Services;

use Carbon\Carbon;

class DateTimeService
{
    public function getBlockedHourMessage($currentTime, $blockedHour)
    {
        $lessFive = Carbon::createFromFormat('H:i:s', $blockedHour)->subMinutes(5);

        $plusFive = Carbon::createFromFormat('H:i:s', $blockedHour)->addMinutes(5);

        if ($currentTime->between($lessFive, $plusFive)) {
            return 'No puedes realizar transacciones entre las ' . $lessFive->format('g:i A') . ' y las ' . $plusFive->format('g:i A');
        }

        return null;
    }
}
