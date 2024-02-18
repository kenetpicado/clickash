<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\BlockedNumberRequest;
use App\Models\BlockedNumber;
use App\Models\Raffle;
use App\Services\BlockedNumberService;

class RaffleBlockedNumberController extends Controller
{
    public function __construct(
        private readonly BlockedNumberService $blockedNumberService
    ) {
    }

    public function index(Raffle $raffle)
    {
        return inertia('Clientarea/Raffle/BlockedNumber', [
            'raffle' => $raffle,
            'blockeds' => $this->blockedNumberService->getRaffleBlockedNumbers($raffle->id),
        ]);
    }

    public function store(BlockedNumberRequest $request, $raffle)
    {
        try {
            $this->blockedNumberService->store($request->validated());
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return back();
    }

    public function destroy($raffle, BlockedNumber $blockedNumber)
    {
        $blockedNumber->delete();

        return back();
    }
}
