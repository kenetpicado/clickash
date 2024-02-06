<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\AvailabilityService;
use Illuminate\Http\Request;

class RaffleParsedHourController extends Controller
{
    public function __construct(
        private readonly AvailabilityService $availabilityService,
    ) {
    }

    public function __invoke(Request $request, $raffle)
    {
        return $this->availabilityService->getParsedHours($raffle);
    }
}
