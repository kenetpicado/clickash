<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientarea\RaffleAvailabilityRequest;
use App\Models\Availability;
use Illuminate\Http\Request;

class RaffleAvailabilityController extends Controller
{
    public function store(RaffleAvailabilityRequest $request, $raffle)
    {
        Availability::create($request->validated());

        return back();
    }

    public function destroy($raffle, $availability)
    {
        Availability::where('id', $availability)->delete();

        return back();
    }
}
