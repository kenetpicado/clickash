<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleRequest;
use App\Models\Raffle;
use App\Repositories\RaffleUserRepository;
use App\Repositories\TransactionRepository;

class RaffleController extends Controller
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
        private readonly RaffleUserRepository $raffleUserRepository,
    ) {
    }

    public function show(Raffle $raffle)
    {
        return inertia('Clientarea/Raffle/Show', [
            'raffle' => $raffle,
            'daily_transactions' => $this->transactionRepository->getDailyTotalByRaffle($raffle->id),
            'transactions' => $this->transactionRepository->getAllOfTheDay($raffle->id),
        ]);
    }

    public function update(RaffleRequest $request, $raffle)
    {
        $this->raffleUserRepository->updateSettings($raffle, $request->validated()['settings']);

        return back();
    }
}
