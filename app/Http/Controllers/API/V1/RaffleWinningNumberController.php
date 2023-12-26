<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\WinningNumberRequest;
use App\Http\Resources\WinningNumberResource;
use App\Models\WinningNumber;
use App\Repositories\TransactionRepository;
use App\Repositories\WinningNumberRepository;
use Carbon\Carbon;

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

        if ($this->winningNumberRepository->alreadyExists($raffle, $request->hour)) {
            abort(403, 'Ya existe registro para esta hora');
        }

        $winningNumber = $this->winningNumberRepository->store($request->validated(), $raffle);

        $this->transactionRepository->setWinningTransactions($winningNumber);

        return self::index($raffle);
    }

    public function destroy($raffle, WinningNumber $winningNumber)
    {
        if ($winningNumber->created_at->diffInMinutes(Carbon::now()) > 30) {
            abort('No es posible eliminar este registro');
        }

        $this->transactionRepository->revertWinningTransactions($winningNumber);

        $winningNumber->delete();

        return self::index($raffle);
    }
}
