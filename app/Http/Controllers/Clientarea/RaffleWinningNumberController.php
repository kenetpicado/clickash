<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\WinningNumberRequest;
use App\Models\Raffle;
use App\Models\WinningNumber;
use App\Repositories\RaffleUserRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\WinningNumberRepository;
use App\Services\AvailabilityService;
use Carbon\Carbon;

class RaffleWinningNumberController extends Controller
{
    public function __construct(
        private readonly WinningNumberRepository $winningNumberRepository,
        private readonly TransactionRepository $transactionRepository,
        private readonly AvailabilityService $availabilityService,
        private readonly RaffleUserRepository $raffleUserRepository
    ) {
    }

    public function index(Raffle $raffle)
    {
        return inertia('Clientarea/Raffle/WinningNumber', [
            'raffle' => $raffle,
            'winning_numbers' => $this->winningNumberRepository->getByRaffle($raffle->id),
            'hours' => $this->availabilityService->getPastHours($raffle->id),
            'settings' => $this->raffleUserRepository->getSettings(auth()->user()->getOwnerId(), $raffle->id),
        ]);
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

    public function destroy($raffle, WinningNumber $winningNumber)
    {
        if ($winningNumber->created_at->diffInMinutes(Carbon::now()) > 30) {
            return back()->withErrors(['message' => 'No es posible eliminar este registro']);
        }

        $this->transactionRepository->revertTeamTransactions($raffle, $winningNumber);

        $winningNumber->delete();

        return back();
    }
}
