<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SalesReportRequest;
use App\Http\Resources\SalesReportResource;
use App\Models\Raffle;
use App\Repositories\TransactionRepository;

class SalesReportController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
    ) {
    }

    public function __invoke(SalesReportRequest $request, Raffle $raffle)
    {
        $validated = $request->validated();

        $sales = auth()->user()->isSeller()
            ? $this->transactionRepository->getUserSalesReport(auth()->id(), $raffle->id, $validated)
            : $this->transactionRepository->getTeamSalesReport($raffle->id, $validated);

        return SalesReportResource::collection($sales)
            ->additional([
                'total' => 'C$ '.number_format($sales->sum('total')),
            ]);
    }
}
