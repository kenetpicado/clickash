<?php

namespace App\Services;

use App\Repositories\RaffleRepository;
use App\Repositories\RaffleUserRepository;

class RaffleService
{
    public function __construct(
        private readonly RaffleRepository $raffleRepository,
    ) {
    }

    public function getRafflesWithAvailability()
    {
        if (!auth()->user()->isEnabled())
            return [];

        return $this->raffleRepository->getRafflesWithAvailability(auth()->user()->getOwnerId());
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
}
