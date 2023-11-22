<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use Illuminate\Http\Request;

class RaffleHourController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $raffle)
    {
        return Availability::where('raffle_id', $raffle)
            ->where('user_id', auth()->id())
            ->pluck('blocked_hours')
            ->flatten()
            ->unique()
            ->sort()
            ->values();
    }
}
