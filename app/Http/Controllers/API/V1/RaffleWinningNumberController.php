<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\WinningNumberRequest;
use App\Http\Resources\WinningNumberResource;
use App\Models\WinningNumber;
use Carbon\Carbon;

class RaffleWinningNumberController extends Controller
{
    public function index($raffle)
    {
        return WinningNumberResource::collection(
            WinningNumber::where('raffle_id', $raffle)
                ->where('user_id', auth()->id())
                ->with('raffle:id,name')
                ->where('date', Carbon::now()->format('Y-m-d'))
                ->orderBy('hour')
                ->get()
        );
    }

    public function store(WinningNumberRequest $request, $raffle)
    {
        $now = Carbon::now()->format('H:i:s');

        if ($request->hour > $now) {
            return back()->withErrors(['message' => 'No puedes registrar una turno que no ha pasado']);
        }

        WinningNumber::create([
            'raffle_id' => $raffle,
            'user_id' => auth()->id(),
            'number' => $request->number,
            'hour' => $request->hour,
            'date' => Carbon::now()->format('Y-m-d'),
        ]);

        return self::index($raffle);
    }
}
