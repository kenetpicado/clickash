<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleBlockedNumberRequest;
use App\Models\BlockedNumber;
use App\Services\UserService;

class RaffleBlockedNumberController extends Controller
{
    public function index($raffle)
    {
        $user_id = (new UserService)->getUserId();

        return response()->json([
            'data' => BlockedNumber::query()
                ->where('user_id', $user_id)
                ->where('raffle_id', $raffle)
                ->pluck('number'),
        ]);
    }

    public function store(RaffleBlockedNumberRequest $request, $raffle)
    {
        BlockedNumber::updateOrCreate([
            'number' => $request->number,
            'user_id' => auth()->id(),
            'raffle_id' => $raffle,
        ], []);

        return self::index($raffle);
    }

    public function destroy($raffle, $blockedNumber)
    {
        BlockedNumber::where('id', $blockedNumber)->delete();

        return self::index($raffle);
    }
}
