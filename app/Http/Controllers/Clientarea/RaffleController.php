<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleRequest;
use App\Models\Raffle;
use App\Repositories\AvailabilityRepository;
use App\Repositories\BlockedNumberRepository;
use App\Repositories\RaffleUserRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\WinningNumberRepository;

class RaffleController extends Controller
{
    public function __construct(
        private readonly AvailabilityRepository $availabilityRepository,
        private readonly BlockedNumberRepository $blockedNumberRepository,
        private readonly WinningNumberRepository $winningNumberRepository,
        private readonly TransactionRepository $transactionRepository,
        private readonly RaffleUserRepository $raffleUserRepository,
    ) {
    }

    public function index()
    {
        return inertia('Clientarea/Raffle/Index', [
            'raffles' => $this->raffleUserRepository->getRaffles(),
        ]);
    }

    public function show(Raffle $raffle)
    {
        return inertia('Clientarea/Raffle/Show', [
            'raffle' => $raffle,
            'transactions' => $this->transactionRepository->getTeamByRaffle($raffle->id),
            'blockeds' => $this->blockedNumberRepository->getByRaffle($raffle->id),
            'availability' => $this->availabilityRepository->getByRaffle($raffle->id),
            'results' => $this->winningNumberRepository->getByRaffle($raffle->id),
            'winners' => $this->transactionRepository->getWinnersByRaffle($raffle->id),
        ]);
    }

    public function update(RaffleRequest $request, $raffle)
    {
        $this->raffleUserRepository->updateSettings($raffle, $request->validated()['settings']);

        return back();
    }
}
