<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RaffleReportListResource;
use App\Services\RaffleService;

class RaffleReportListController extends Controller
{
    public function __construct(
        private readonly RaffleService $raffleService
    ) {
    }

    public function __invoke()
    {
        return RaffleReportListResource::collection($this->raffleService->getRafflesWithAvailability());
    }
}
