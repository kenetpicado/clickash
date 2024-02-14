<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\BlockedNumberRequest;
use App\Models\BlockedNumber;
use App\Repositories\BlockedNumberRepository;

class RaffleBlockedNumberController extends Controller
{
    public function __construct(
        private readonly BlockedNumberRepository $blockedNumberRepository
    ) {
    }

    public function index($raffle)
    {
        return response()->json([
            'data' => $this->blockedNumberRepository->getByRaffle($raffle),
        ]);
    }

    public function store(BlockedNumberRequest $request, $raffle)
    {
        $this->blockedNumberRepository->updateOrCreate($request->validated(), $raffle);

        return self::index($raffle);
    }

    public function destroy($raffle, $blockedNumber)
    {
        BlockedNumber::where('id', $blockedNumber)->delete();

        return self::index($raffle);
    }
}
