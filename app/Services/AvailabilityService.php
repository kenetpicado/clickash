<?php

namespace App\Services;

use App\Repositories\AvailabilityRepository;
use Carbon\Carbon;

class AvailabilityService
{
    private $days = [
        'Domingo',
        'Lunes',
        'Martes',
        'Miercoles',
        'Jueves',
        'Viernes',
        'Sabado',
    ];

    private AvailabilityRepository $availabilityRepository;

    public function __construct()
    {
        $this->availabilityRepository = new AvailabilityRepository();
    }

    public function getRaffleAvailability($raffle_id)
    {
        return $this->availabilityRepository->getRaffleAvailability($raffle_id);
    }

    public function store(array $request)
    {
        $request['order'] = array_search($request['day'], $this->days);
        $request['user_id'] = auth()->id();

        $request = $this->formatRequestHours($request);

        return $this->availabilityRepository->store($request);
    }

    public function update(array $request, $id)
    {
        $request['order'] = array_search($request['day'], $this->days);
        $request = $this->formatRequestHours($request);

        return $this->availabilityRepository->update($request, $id);
    }

    public function getAllRaffleHours($raffle_id)
    {
        return $this->availabilityRepository->getAllRaffleHours($raffle_id);
    }

    private function formatRequestHours(array $request)
    {
        $temporalBlockedHours = collect([]);

        $request['start_time'] = $this->formatThisHour($request['start_time']);
        $request['end_time'] = $this->formatThisHour($request['end_time']);

        foreach ($request['blocked_hours'] as $hour) {
            $temporalBlockedHours->push($this->formatThisHour($hour));
        }

        $request['blocked_hours'] = $temporalBlockedHours->unique()->sort();

        return $request;
    }

    private function formatThisHour($hour)
    {
        return Carbon::parse($hour)->format('H:i:s');
    }
}
