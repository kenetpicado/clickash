<?php

namespace App\Http\Controllers\API\V1;

use App\Enums\DayEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleUserAvailabilityRequest;
use App\Http\Resources\AvailabilityResource;
use App\Models\Availability;
use App\Models\RaffleUser;
use Illuminate\Http\Request;

class RaffleUserAvailabilityController extends Controller
{
    public function index($raffle)
    {
        return AvailabilityResource::collection(
            Availability::query()
                ->where('availability_type', RaffleUser::class)
                ->where('availability_id', $raffle)
                ->orderBy('order')
                ->get()
        );
    }

    public function store(RaffleUserAvailabilityRequest $request, $raffle)
    {
        $dayNumber = DayEnum::getDayNumber($request->day);

        $alreadyExists = Availability::query()
            ->where('availability_type', RaffleUser::class)
            ->where('availability_id', $raffle)
            ->where('order', $dayNumber)
            ->exists();

        if ($alreadyExists) {
            throw new \Exception("El día {$request->day} ya esta registrado");
        }

        Availability::create([
            'day' => $request->day,
            'order' => $dayNumber,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'blocked_hours' => $request->blocked_hours,
            'availability_id' => $raffle,
            'availability_type' => RaffleUser::class
        ]);

        return self::index($raffle);
    }

    public function update(RaffleUserAvailabilityRequest $request, $raffle, $availability)
    {
        $alreadyExists = Availability::query()
            ->where('availability_type', RaffleUser::class)
            ->where('availability_id', $raffle)
            ->where('order', DayEnum::getDayNumber($request->day))
            ->where('id', '!=', $availability)
            ->exists();

        if ($alreadyExists) {
            throw new \Exception("El día {$request->day} ya esta registrado");
        }

        Availability::query()
            ->where('id', $availability)
            ->update([
                'day' => $request->day,
                'order' => DayEnum::getDayNumber($request->day),
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'blocked_hours' => $request->blocked_hours,
            ]);

        return self::index($raffle);
    }

    public function destroy($raffle, $availability)
    {
        Availability::where('id', $availability)->delete();

        return self::index($raffle);
    }
}
