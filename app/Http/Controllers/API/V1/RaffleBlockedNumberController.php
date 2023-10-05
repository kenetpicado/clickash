<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleBlockedNumberRequest;
use App\Models\BlockedNumber;
use App\Services\BlockedNumberService;

class RaffleBlockedNumberController extends Controller
{
    public function index($raffle)
    {
        return response()->json([
            'data' => (new BlockedNumberService)->get($raffle),
        ]);
    }

    public function store(RaffleBlockedNumberRequest $request, $raffle)
    {
        (new BlockedNumberService)->store($request->validated(), $raffle);

        return self::index($raffle);
    }

    public function destroy($raffle, $blockedNumber)
    {
        BlockedNumber::where('id', $blockedNumber)->delete();

        return self::index($raffle);
    }
}
