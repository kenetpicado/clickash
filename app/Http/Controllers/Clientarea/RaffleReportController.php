<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Models\Raffle;
use App\Repositories\AvailabilityRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class RaffleReportController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
        private readonly AvailabilityRepository $availabilityRepository,
    ) {
    }

    public function __invoke(Request $request, Raffle $raffle)
    {
        $sales_by_number = [];

        if ($request->has('hour')) {
            $sales_by_number = $this->transactionRepository->getTeamSalesReport($raffle->id, $request->all());
        }

        return inertia('Clientarea/Raffle/Report', [
            'raffle' => $raffle,
            'sales_by_number' => $sales_by_number,
            'hours' => $this->availabilityRepository->getAllRaffleHours($raffle->id),
        ]);
    }
}
