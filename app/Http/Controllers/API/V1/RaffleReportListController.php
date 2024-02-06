<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RaffleReportListResource;
use App\Services\RaffleService;
use Illuminate\Http\Request;

class RaffleReportListController extends Controller
{
    public function __construct(
        private readonly RaffleService $raffleService
    ) {
    }

    public function __invoke(Request $request)
    {
        return RaffleReportListResource::collection($this->raffleService->getRafflesWithHours());
    }
}
