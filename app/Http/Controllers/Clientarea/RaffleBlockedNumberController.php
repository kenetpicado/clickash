<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleBlockedNumberRequest;
use App\Models\BlockedNumber;
use App\Repositories\BlockedNumberRepository;

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
