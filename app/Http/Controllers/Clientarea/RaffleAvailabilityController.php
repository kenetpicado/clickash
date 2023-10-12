<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientarea\RaffleAvailabilityRequest;
use App\Models\Availability;
use App\Repositories\AvailabilityRepository;

class RaffleAvailabilityController extends Controller
{
    public function __construct(
        private readonly AvailabilityRepository $availabilityRepository
    ) {
    }

    public function store(RaffleAvailabilityRequest $request, $raffle)
    {
        $this->availabilityRepository->updateOrCreate($request->validated(), $raffle);

        return back();
    }

    public function update(RaffleAvailabilityRequest $request, $raffle, $availability)
    {
        $this->availabilityRepository->update($request->validated(), $availability);

        return back();
    }

    public function destroy($raffle, $availability)
    {
        Availability::where('id', $availability)->delete();

        return back();
    }
}
