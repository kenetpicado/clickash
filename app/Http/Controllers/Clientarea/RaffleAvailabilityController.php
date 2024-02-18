<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientarea\RaffleAvailabilityRequest;
use App\Http\Resources\AvailabilityResource;
use App\Models\Availability;
use App\Models\Raffle;
use App\Services\AvailabilityService;

class RaffleAvailabilityController extends Controller
{
    public function __construct(
        private readonly AvailabilityService $availabilityService
    ) {
    }

    public function index(Raffle $raffle)
    {
        return inertia('Clientarea/Raffle/Availability', [
            'raffle' => $raffle,
            'availability' => AvailabilityResource::collection($this->availabilityService->getRaffleAvailability($raffle->id))->resolve(),
        ]);
    }

    public function store(RaffleAvailabilityRequest $request, $raffle)
    {
        $this->availabilityService->store($request->validated());

        return back();
    }

    public function update(RaffleAvailabilityRequest $request, $raffle, $availability)
    {
        $this->availabilityService->update($request->validated(), $availability);

        return back();
    }

    public function destroy($raffle, Availability $availability)
    {
        $availability->delete();

        return back();
    }
}
