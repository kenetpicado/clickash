<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleRequest;
use App\Models\Raffle;
use App\Repositories\RaffleUserRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
        private readonly RaffleUserRepository $raffleUserRepository,
    ) {
    }

    public function index(Request $request)
    {
        return inertia('Clientarea/Raffle/Index', [
            'raffles' => $this->raffleUserRepository->getRaffles(),
        ]);
    }

    public function show(Request $request, Raffle $raffle)
    {
        $array = $request->all();

        return inertia('Clientarea/Raffle/Show', [
            'raffle' => $raffle,
            'daily_transactions' => $this->transactionRepository->getRaffleTransactionsTotalPerDay($raffle->id, $array),
            'transactions' => $this->transactionRepository->getRaffleTransactionsPerDay($raffle->id, $array),
        ]);
    }

    public function update(RaffleRequest $request, $raffle)
    {
        $this->raffleUserRepository->updateSettings($raffle, $request->validated()['settings']);

        return back();
    }
}
