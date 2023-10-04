<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\WinningNumberRequest;
use App\Models\WinningNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RaffleWinningNumberController extends Controller
{
    public function store(WinningNumberRequest $request, $raffle)
    {
        $now = Carbon::now()->format('H:i:s');

        if ($request->hour > $now) {
            return back()->withErrors(['message' => "No puedes registrar una turno que no ha pasado"]);
        }

        WinningNumber::create([
            'raffle_id' => $raffle,
            'user_id' => auth()->id(),
            'number' => $request->number,
            'hour' => $request->hour,
            "date" => Carbon::now()->format('Y-m-d'),
        ]);

        return back();
    }
}
