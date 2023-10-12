<?php

namespace App\Http\Controllers\Clientarea;

use App\Models\Availability;
use App\Http\Controllers\Controller;
use App\Repositories\AvailabilityRepository;
use App\Http\Requests\Clientarea\RaffleAvailabilityRequest;

class RaffleAvailabilityController extends Controller
{
    public function __construct(
        private readonly AvailabilityRepository $availabilityRepository
    ) {
    }

    public function store(RaffleAvailabilityRequest $request, $raffle)
    {
        $this->availabilityRepository->store($request->validated(), $raffle);

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
