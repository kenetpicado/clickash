<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Resources\RaffleReportListResource;
use App\Models\User;
use App\Repositories\TransactionRepository;
use App\Services\RaffleService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SellerReportController extends Controller
{
    public function __construct(
        private readonly RaffleService $raffleService,
        private readonly TransactionRepository $transactionRepository
    ) {
    }

    public function __invoke(Request $request, User $seller)
    {
        if ($request->get('raffle_id') && $request->get('hour')) {
            $sales = $this->transactionRepository->getUserSalesReport($seller->id, $request->get('raffle_id'), [
                'hour' => $request->get('hour'),
                'date' => $request->get('date')
            ]);
        }

        return inertia('Clientarea/Seller/Report', [
            'seller' => $seller,
            'sales' => $sales ?? [],
            'raffles' => RaffleReportListResource::collection($this->raffleService->getRafflesWithAvailability())->resolve(),
        ]);
    }
}
