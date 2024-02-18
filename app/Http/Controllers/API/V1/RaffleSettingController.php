<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RaffleResource;
use App\Services\RaffleService;

class RaffleSettingController extends Controller
{
    public function __construct(
        private readonly RaffleService $raffleService
    ) {
    }

    public function __invoke($raffle)
    {
        return RaffleResource::make($this->raffleService->getRaffle($raffle))->resolve();
    }
}
