<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Repositories\AvailabilityRepository;

class RaffleHourController extends Controller
{
    public function __construct(
        private readonly AvailabilityRepository $availabilityRepository
    ) {
    }

    public function __invoke($raffle)
    {
        return $this->availabilityRepository->getHoursByRaffle($raffle);
    }
}
