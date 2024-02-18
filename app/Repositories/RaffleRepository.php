<?php

namespace App\Repositories;

use App\Models\Raffle;
use App\Models\User;

class RaffleRepository
{
    public function getRafflesWithAvailability($user_id)
    {
        return User::find($user_id)
            ->raffles()
            ->with([
                'availability' => fn ($query) => $query->where('user_id', $user_id)
            ])
            ->get(['raffles.id', 'name']);
    }

    public function getRafflesNames()
    {
        return Raffle::hasUser(auth()->user()->getOwnerId())->get(['id', 'name']);
    }

    public function getUnassignedRaffles($user_id)
    {
        return Raffle::query()
            ->whereDoesntHave('users', fn ($query) => $query->where('users.id', $user_id))
            ->get(['raffles.id', 'name', 'image']);
    }

    public function getAssignedRaffles($user_id)
    {
        return User::find($user_id)->raffles()->get(['raffles.id', 'name', 'image']);
    }

    public function getAssignedRafflesWithAvailability($user_id)
    {
        return User::find($user_id)
            ->raffles()
            ->with([
                'currentAvailability' => fn ($query) => $query->where('user_id', $user_id)
            ])
            ->get(['raffles.id', 'name', 'image']);
    }

    public function getRaffle($raffle_id, $user_id)
    {
        return User::find($user_id)
            ->raffles()
            ->with([
                'currentAvailability' => fn ($query) => $query->where('user_id', $user_id)
            ])
            ->find($raffle_id, ['raffles.id', 'name', 'image']);
    }
}
