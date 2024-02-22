<?php

namespace App\Services;

use App\Repositories\RaffleRepository;
use App\Repositories\RaffleUserRepository;
use Carbon\Carbon;

class RaffleService
{
    private RaffleRepository $raffleRepository;

    public function __construct()
    {
        $this->raffleRepository = new RaffleRepository;
    }

    public function getRafflesWithAvailability()
    {
        if (!auth()->user()->isEnabled())
            return [];

        return $this->raffleRepository->getRafflesWithAvailability(auth()->user()->getOwnerId());
    }

    public function getRaffleWithAvailability($raffle_id)
    {
        if (!auth()->user()->isEnabled())
            return [];

        return $this->raffleRepository->getRaffleWithAvailability(auth()->user()->getOwnerId(), $raffle_id);
    }

    public function getAssignedRaffles()
    {
        if (!auth()->user()->isEnabled())
            return [];

        return $this->raffleRepository->getAssignedRaffles(auth()->user()->getOwnerId());
    }

    public function getUnassignedRaffles($user_id)
    {
        return $this->raffleRepository->getUnassignedRaffles($user_id);
    }

    public function getAssignedRafflesWithAvailability($user_id)
    {
        if (!auth()->user()->isEnabled())
            return [];

        return $this->raffleRepository->getAssignedRafflesWithAvailability($user_id);
    }

    public function updateUserSettings($raffle, $settings): void
    {
        (new RaffleUserRepository)->updateSettings($raffle, $settings);
    }

    public function getRaffle($raffle_id)
    {
        return $this->raffleRepository->getRaffle($raffle_id, auth()->user()->getOwnerId());
    }

    public function getRaffleNames()
    {
        return $this->raffleRepository->getRaffleNames();
    }

    public function getResults(array $request)
    {
        return [
            'message' => isset($request['date']) ? 'Resultados del ' . Carbon::parse($request['date'])->format('m/d/y') : 'Resultados de hoy',
            'results' => $this->raffleRepository->getRaffleResults(auth()->user()->getOwnerId(), $request),
        ];
    }
}
