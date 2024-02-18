<?php

namespace App\Services;

use App\Repositories\RaffleRepository;
use Carbon\Carbon;

class RaffleService
{
    public function __construct(
        private readonly RaffleRepository $raffleRepository,
    ) {
    }

    public function getRafflesWithHours()
    {
        $raffles = (new RaffleRepository)->getRafflesWithAvailability();

        $raffles->transform(function ($raffle) {
            $raffle->hours = $raffle->availability
                ->pluck('blocked_hours')
                ->flatten()
                ->unique()
                ->sort()
                ->values()
                ->map(function ($hour) {
                    return [
                        'value' => $hour,
                        'label' => Carbon::parse($hour)->format('g:i A'),
                    ];
                });

            unset($raffle->availability);

            return $raffle;
        });

        return $raffles;
    }

    public function getAssignedRaffles()
    {
        if (auth()->user()->isEnabled())
            return $this->raffleRepository->getAssignedRaffles(auth()->user()->getOwnerId());

        return [];
    }

    public function getUnassignedRaffles($user_id)
    {
        return $this->raffleRepository->getUnassignedRaffles($user_id);
    }

    public function getAssignedRafflesWithAvailability($user_id)
    {
        if (auth()->user()->isEnabled())
            return $this->raffleRepository->getAssignedRafflesWithAvailability($user_id);

        return [];
    }
}
