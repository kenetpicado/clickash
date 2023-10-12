<?php

namespace App\Http\Controllers\Clientarea;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Repositories\WinningNumberRepository;
use App\Http\Requests\API\WinningNumberRequest;
use App\Repositories\TransactionRepository;

class RaffleWinningNumberController extends Controller
{
    public function __construct(
        private readonly WinningNumberRepository $winningNumberRepository,
        private readonly TransactionRepository $transactionRepository
    ) {
    }

    public function store(WinningNumberRequest $request, $raffle)
    {
        if (Carbon::parse($request->hour)->isFuture()) {
            return back()->withErrors(['message' => 'No puedes registrar una turno que no ha pasado']);
        }

        $winningNumber = $this->winningNumberRepository->store($request->validated(), $raffle);

        $this->transactionRepository->markWinners($winningNumber);

        return back();
    }
}
