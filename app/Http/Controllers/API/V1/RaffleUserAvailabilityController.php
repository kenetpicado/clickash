<?php

namespace App\Http\Controllers\API\V1;

use App\Enums\DayEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleUserAvailabilityRequest;
use App\Http\Resources\AvailabilityResource;
use App\Models\Availability;
use App\Models\RaffleUser;
use App\Services\AvailabilityService;
use Illuminate\Http\Request;

class RaffleUserAvailabilityController extends Controller
{
    public function __construct(
        private readonly AvailabilityService $availabilityService
    ) {
    }

    public function index($raffle_user)
    {
        return AvailabilityResource::collection((new AvailabilityService)->index($raffle_user));
    }

    public function store(RaffleUserAvailabilityRequest $request, $raffle_user)
    {
        $alreadyExists = $this->availabilityService->check($request->day, $raffle_user);

        if ($alreadyExists) {
            throw new \Exception("El día {$request->day} ya esta registrado");
        }

        $this->availabilityService->store($request->validated(), $raffle_user);

        return self::index($raffle_user);
    }

    public function update(RaffleUserAvailabilityRequest $request, $raffle_user, $availability)
    {
        $alreadyExists = $this->availabilityService->check($request->day, $raffle_user, $availability);

        if ($alreadyExists) {
            throw new \Exception("El día {$request->day} ya esta registrado");
        }

        $this->availabilityService->update($request->validated(), $availability);

        return self::index($raffle_user);
    }

    public function destroy($raffle_user, $availability)
    {
        Availability::where('id', $availability)->delete();

        return self::index($raffle_user);
    }
}
