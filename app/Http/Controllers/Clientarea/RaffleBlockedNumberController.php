<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Models\BlockedNumber;
use Illuminate\Http\Request;

class RaffleBlockedNumberController extends Controller
{
    public function store(Request $request, $raffle)
    {
        BlockedNumber::updateOrCreate([
            'number' => $request->number,
            'user_id' => auth()->id(),
            'raffle_id' => $raffle,
        ], []);

        return back();
    }

    public function destroy($raffle, $blockedNumber)
    {
        BlockedNumber::where('id', $blockedNumber)->delete();

        return back();
    }
}
