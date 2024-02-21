<?php

namespace App\Repositories;

use App\Models\Raffle;
use App\Models\User;
use Carbon\Carbon;

class RaffleRepository
{
    public function getRafflesWithAvailability($user_id)
    {
        return User::find($user_id)
            ->raffles()
            ->with([
                'availability' => fn ($query) => $query->where('user_id', $user_id)->select('raffle_id', 'user_id', 'blocked_hours')
            ])
            ->get(['raffles.id', 'name']);
    }

    public function getRaffleNames()
    {
        return Raffle::query()
            ->whereHas('users', fn ($query) => $query->where('users.id', auth()->user()->getOwnerId()))
            ->get(['raffles.id', 'name']);
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

    public function getRaffleResults($user_id, array $request)
    {
        return User::find($user_id)
            ->raffles()
            ->with([
                'winningNumbers' => fn ($query) => $query->where('user_id', $user_id)->when(
                    isset($request['date']),
                    fn ($query) => $query->where('date', Carbon::parse($request['date'])->format('Y-m-d')),
                    fn ($query) => $query->where('date', Carbon::today())
                )
                    ->orderBy('hour')
            ])
            ->get(['raffles.id', 'name', 'image']);
    }
}
