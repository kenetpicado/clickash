<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SalesReportRequest;
use App\Http\Resources\SalesReportResource;
use App\Services\TransactionService;

class SalesReportController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService
    ) {
    }

    public function __invoke(SalesReportRequest $request, $raffle)
    {
        $data = $this->transactionService->getSalesReport($request->validated(), $raffle);

        return SalesReportResource::collection($data['sales'])->additional(['total' => $data['total']]);
    }
}
