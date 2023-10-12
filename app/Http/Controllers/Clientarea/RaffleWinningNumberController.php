<?php

namespace App\Http\Controllers\Clientarea;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Repositories\WinningNumberRepository;
use App\Http\Requests\API\WinningNumberRequest;

class RaffleWinningNumberController extends Controller
{
    public function __construct(
        private WinningNumberRepository $winningNumberRepository
    ) {
    }

    public function store(WinningNumberRequest $request, $raffle)
    {
        if (Carbon::parse($request->hour)->isFuture()) {
            return back()->withErrors(['message' => 'No puedes registrar una turno que no ha pasado']);
        }

        $this->winningNumberRepository->store($request->validated(), $raffle);

        return back();
    }
}
