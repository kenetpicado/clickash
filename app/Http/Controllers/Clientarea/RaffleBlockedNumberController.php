<?php

namespace App\Http\Controllers\Clientarea;

use App\Models\BlockedNumber;
use App\Http\Controllers\Controller;
use App\Repositories\BlockedNumberRepository;
use App\Http\Requests\API\RaffleBlockedNumberRequest;

class RaffleBlockedNumberController extends Controller
{
    public function __construct(
        private readonly BlockedNumberRepository $blockedNumberRepository
    ) {
    }

    public function store(RaffleBlockedNumberRequest $request, $raffle)
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
