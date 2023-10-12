<?php

namespace App\Http\Controllers\API\V1;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\WinningNumberResource;
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

    public function index($raffle)
    {
        return WinningNumberResource::collection($this->winningNumberRepository->getByRaffle($raffle, true));
    }

    public function store(WinningNumberRequest $request, $raffle)
    {
        if (Carbon::parse($request->hour)->isFuture()) {
            abort(403, 'No puedes registrar una turno que no ha pasado');
        }

        $winningNumber = $this->winningNumberRepository->store($request->validated(), $raffle);

        $this->transactionRepository->markWinners($winningNumber);

        return self::index($raffle);
    }
}
