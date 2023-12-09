<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Repositories\RaffleRepository;

class RaffleSettingController extends Controller
{
    public function __construct(
        private readonly RaffleRepository $raffleRepository,
    ) {
    }

    public function __invoke($raffle)
    {
        return $this->raffleRepository->getRaffleSettings($raffle);
    }
}
