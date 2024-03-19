<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Resources\RaffleReportListResource;
use App\Http\Resources\SalesReportResource;
use App\Services\RaffleService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class RaffleReportController extends Controller
{
    public function __construct(
        private readonly RaffleService $raffleService,
        private readonly TransactionService $transactionService
    ) {
    }

    public function __invoke(Request $request, $raffle)
    {
        $data = $this->transactionService->getSalesReport($request->all(), $raffle);

        return inertia('Clientarea/Raffle/Report', [
            'raffle' => RaffleReportListResource::make($this->raffleService->getRaffleWithAvailability($raffle))->resolve(),
            'sales' => SalesReportResource::collection($data['sales'])->resolve(),
            'total' => $data['total'],
        ]);
    }
}
