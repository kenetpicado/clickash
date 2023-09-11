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
    public function index($raffle_user)
    {
        return BlockedNumberResource::collection(
            BlockedNumber::query()
                ->where('blockable_type', RaffleUser::class)
                ->where('blockable_id', $raffle_user)
                ->get()
        );
    }

    public function store(RaffleUserBlockedNumberRequest $request, $raffle_user)
    {
        BlockedNumber::create([
            'number' => $request->number,
            'blockable_id' => $raffle_user,
            'blockable_type' => RaffleUser::class
        ]);

        return self::index($raffle_user);
    }

    public function destroy($raffle_user, $blockedNumber)
    {
        BlockedNumber::where('id', $blockedNumber)->delete();

        return self::index($raffle_user);
    }
}
