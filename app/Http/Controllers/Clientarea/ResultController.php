<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Models\Raffle;
use App\Repositories\TransactionRepository;
use App\Services\RaffleUserService;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct(
        private readonly RaffleUserService $raffleUserService,
        private readonly TransactionRepository $transactionRepository,
    ) {
    }

    public function index(Request $request)
    {
        return inertia('Clientarea/Result/Index', [
            'results' => $this->raffleUserService->getRafflesWithResultFormated($request->all()),
        ]);
    }

    public function show(Request $request, Raffle $raffle)
    {
        return inertia('Clientarea/Result/Show', [
            'raffle' => $raffle,
            'transactions' => $this->transactionRepository->getTeamWinners($raffle->id, $request->all()),
        ]);
    }
}
