<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Repositories\AvailabilityRepository;
use Illuminate\Http\Request;

class RaffleHourController extends Controller
{
    public function __construct(
        private readonly AvailabilityRepository $availabilityRepository
    ) {
    }

    public function __invoke(Request $request, $raffle)
    {
        return $this->availabilityRepository->getHoursByRaffle($raffle);
    }
}
