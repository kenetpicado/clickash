<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\AvailabilityService;

class RaffleHourController extends Controller
{
    public function __construct(
        private readonly AvailabilityService $availabilityService
    ) {
    }

    public function __invoke($raffle)
    {
        return $this->availabilityService->getAllRaffleHours($raffle);
    }
}
