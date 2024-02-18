<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\WinningNumberRequest;
use App\Http\Resources\RaffleResource;
use App\Http\Resources\WinningNumberResource;
use App\Models\WinningNumber;
use App\Services\RaffleService;
use App\Services\WinningNumberService;
use Exception;

class RaffleWinningNumberController extends Controller
{
    public function __construct(
        private readonly WinningNumberService $winningNumberService,
        private readonly RaffleService $raffleService
    ) {
    }

    public function index($raffle)
    {
        return inertia('Clientarea/Raffle/WinningNumber', [
            'raffle' => RaffleResource::make($this->raffleService->getRaffle($raffle))->resolve(),
            'winning_numbers' => WinningNumberResource::collection($this->winningNumberService->getWinningNumbers($raffle))->resolve(),
        ]);
    }

    public function store(WinningNumberRequest $request, $raffle)
    {
        try {
            $this->winningNumberService->store($request->validated(), $raffle);
        } catch (Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return back();
    }

    public function destroy($raffle, WinningNumber $winningNumber)
    {
        try {
            $this->winningNumberService->destroy($winningNumber);
        } catch (Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return back();
    }
}
