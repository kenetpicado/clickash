<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\WinningNumberRequest;
use App\Http\Resources\WinningNumberResource;
use App\Models\WinningNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        WinningNumber::updateOrCreate([
            'raffle_id' => $raffle,
            'user_id' => auth()->id(),
            'number' => $request->number,
            'hour' => $request->hour,
            "date" => Carbon::now()->format('Y-m-d'),
        ], []);

        return self::index($raffle);
    }
}
