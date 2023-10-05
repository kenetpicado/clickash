<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientarea\RaffleAvailabilityRequest;
use App\Http\Resources\AvailabilityResource;
use App\Models\Availability;
use App\Services\AvailabilityService;

class RaffleAvailabilityController extends Controller
{
    public function __construct(
        private readonly AvailabilityService $availabilityService
    ) {
    }

    public function index($raffle)
    {
        return AvailabilityResource::collection((new AvailabilityService)->index($raffle));
    }

    public function store(RaffleAvailabilityRequest $request, $raffle)
    {
        $this->availabilityService->store($request->validated(), $raffle);

        return self::index($raffle);
    }

    public function update(RaffleAvailabilityRequest $request, $raffle, $availability)
    {
        $this->availabilityService->update($request->validated(), $availability);

        return self::index($raffle);
    }

    public function destroy($raffle, $availability)
    {
        Availability::where('id', $availability)->delete();

        return self::index($raffle);
    }
}
