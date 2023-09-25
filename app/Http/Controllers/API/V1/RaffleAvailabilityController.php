<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleAvailabilityRequest;
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
        $alreadyExists = $this->availabilityService->check($request->day, $raffle);

        if ($alreadyExists) {
            throw new \Exception("El día {$request->day} ya esta registrado");
        }

        $this->availabilityService->store($request->validated(), $raffle);

        return self::index($raffle);
    }

    public function update(RaffleAvailabilityRequest $request, $raffle, $availability)
    {
        $alreadyExists = $this->availabilityService->check($request->day, $raffle, $availability);

        if ($alreadyExists) {
            throw new \Exception("El día {$request->day} ya esta registrado");
        }

        $this->availabilityService->update($request->validated(), $availability);

        return self::index($raffle);
    }

    public function destroy($raffle, $availability)
    {
        Availability::where('id', $availability)->delete();

        return self::index($raffle);
    }
}
