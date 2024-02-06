<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SellerReportRequest;
use App\Http\Resources\SalesReportResource;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class SellerReportController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository
    ) {
    }

    public function __invoke(SellerReportRequest $request, $seller)
    {
        $sales = $this->transactionRepository->getUserSalesReport($seller, $request->raffle_id, $request->validated());

        return SalesReportResource::collection($sales)
            ->additional([
                'total' => 'C$ ' . number_format($sales->sum('total')),
            ]);
    }
}
