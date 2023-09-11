<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleUserBlockedNumberRequest;
use App\Http\Resources\BlockedNumberResource;
use App\Models\BlockedNumber;
use App\Models\RaffleUser;
use Illuminate\Http\Request;

class RaffleUserBlockedNumberController extends Controller
{
    public function index($raffle)
    {
        return BlockedNumberResource::collection(
            BlockedNumber::query()
                ->where('blockable_type', RaffleUser::class)
                ->where('blockable_id', $raffle)
                ->get()
        );
    }

    public function store(RaffleUserBlockedNumberRequest $request, $raffle)
    {
        BlockedNumber::create([
            'number' => $request->number,
            'blockable_id' => $raffle,
            'blockable_type' => RaffleUser::class
        ]);

        return self::index($raffle);
    }

    public function destroy($raffle, $blockedNumber)
    {
        BlockedNumber::where('id', $blockedNumber)->delete();

        return self::index($raffle);
    }
}
