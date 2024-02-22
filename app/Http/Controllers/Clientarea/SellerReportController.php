<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Resources\RaffleReportListResource;
use App\Http\Resources\SalesReportResource;
use App\Models\User;
use App\Services\RaffleService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class SellerReportController extends Controller
{
    public function __construct(
        private readonly RaffleService $raffleService,
        private readonly TransactionService $transactionService
    ) {
    }

    public function __invoke(Request $request, User $seller)
    {
        $arrayRequest = $request->merge(['user_id' => $seller->id])->all();

        $data = $this->transactionService->getSalesReport($arrayRequest, $request->get('raffle_id'));

        return inertia('Clientarea/Seller/Report', [
            'seller' => $seller,
            'sales' => SalesReportResource::collection($data['sales'])->resolve(),
            'total' => $data['total'],
            'raffles' => RaffleReportListResource::collection($this->raffleService->getRafflesWithAvailability())->resolve(),
        ]);
    }
}
