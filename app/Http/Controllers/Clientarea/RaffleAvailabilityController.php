<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientarea\RaffleAvailabilityRequest;
use App\Models\Availability;
use App\Services\AvailabilityService;

class RaffleAvailabilityController extends Controller
{
    public function store(RaffleAvailabilityRequest $request, $raffle)
    {
        (new AvailabilityService)->store($request->validated(), $raffle);

        return back();
    }

    public function update(RaffleAvailabilityRequest $request, $raffle, $availability)
    {
        (new AvailabilityService)->update($request->validated(), $availability);

        return back();
    }

    public function destroy($raffle, $availability)
    {
        Availability::where('id', $availability)->delete();

        return back();
    }
}
