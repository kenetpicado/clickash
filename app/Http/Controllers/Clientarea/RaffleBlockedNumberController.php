<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleBlockedNumberRequest;
use App\Models\BlockedNumber;
use App\Services\BlockedNumberService;
use Illuminate\Http\Request;

class RaffleBlockedNumberController extends Controller
{
    public function store(RaffleBlockedNumberRequest $request, $raffle)
    {
        (new BlockedNumberService)->set($request->validated(), $raffle);

        return back();
    }

    public function destroy($raffle, $blockedNumber)
    {
        BlockedNumber::where('id', $blockedNumber)->delete();

        return back();
    }
}
