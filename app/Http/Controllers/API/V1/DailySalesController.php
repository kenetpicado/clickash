<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DailySalesResource;
use App\Models\Raffle;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailySalesController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
    ) {
    }

    public function __invoke(Request $request, Raffle $raffle)
    {
        $validated = $request->validate([
            'hour' => 'required',
            'date' => 'nullable',
        ]);

        if (auth()->user()->isSeller()) {
            $sales = $this->transactionRepository->getUserSalesSummary(auth()->id(), $raffle->id, $validated);
        } else {
            $sales = $this->transactionRepository->getTeamSalesSummary($raffle->id, $validated);
        }

        return DailySalesResource::collection($sales)
            ->additional([
                'raffle' => $raffle->name,
                'hour' => Carbon::parse($validated['hour'])->format('g:i A'),
                'current_time' => Carbon::now()->format('g:i A'),
                'total' => 'C$ '.number_format($sales->sum('total')),
                'message' => isset($validated['date']) ? 'Reporte de ventas del '.Carbon::parse($validated['hour'])->format('d/m/Y') : 'Reporte de ventas de hoy',
            ]);
    }
}
