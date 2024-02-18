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

    public function getRaffles()
    {
        $raffles = [];
        $isOwner = auth()->user()->isOwner();

        if (auth()->user()->isEnabled()) {

            $raffles = $this->raffleRepository->getRaffles();

            $raffles->transform(function ($raffle) use ($isOwner) {
                $raffle->blocked_hours = collect($raffle->currentAvailability->blocked_hours ?? [])
                    ->filter(fn ($value) => $isOwner ? $value : Carbon::parse($value)->isFuture())
                    ->values();

                unset($raffle->currentAvailability);

                return $raffle;
            });
        }

        return $raffles;
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

    public function getUnassignedRaffles($user_id)
    {
        return $this->raffleRepository->getUnassignedRaffles($user_id);
    }
}
