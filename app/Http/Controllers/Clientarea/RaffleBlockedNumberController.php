<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\BlockedNumberRequest;
use App\Models\BlockedNumber;
use App\Models\Raffle;
use App\Repositories\BlockedNumberRepository;

class RaffleBlockedNumberController extends Controller
{
    public function __construct(
        private readonly BlockedNumberRepository $blockedNumberRepository
    ) {
    }

    public function index(Raffle $raffle)
    {
        return inertia('Clientarea/Raffle/BlockedNumber', [
            'blockeds' => $this->blockedNumberRepository->getByRaffle($raffle->id),
            'raffle' => $raffle,
        ]);
    }

    public function store(BlockedNumberRequest $request, $raffle)
    {
        $this->blockedNumberRepository->updateOrCreate($request->validated(), $raffle);

        return back();
    }

    public function destroy($raffle, $blockedNumber)
    {
        BlockedNumber::where('id', $blockedNumber)->delete();

        return back();
    }
}
