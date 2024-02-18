<?php

namespace App\Repositories;

use App\Models\Raffle;
use App\Models\User;
use Carbon\Carbon;

class RaffleRepository
{
    public function getRafflesWithAvailability()
    {
        return Raffle::hasUser(auth()->user()->getOwnerId())->with('availability')->get(['id', 'name']);
    }

    public function getRafflesNames()
    {
        return Raffle::hasUser(auth()->user()->getOwnerId())->get(['id', 'name']);
    }

    public function getRaffleSettings($raffle_id)
    {
        $ownerId = auth()->user()->getOwnerId();

        $raffle = Raffle::hasUser($ownerId)
            ->with([
                'currentAvailability' => function ($query) use ($ownerId) {
                    $query->where('user_id', $ownerId)->select('id', 'raffle_id', 'user_id', 'blocked_hours');
                },
            ])
            ->select('id', 'name')
            ->addSelect([
                'settings' => function ($query) use ($ownerId) {
                    $query->select('settings')->from('raffle_user')->where('user_id', $ownerId)->whereColumn('raffle_id', 'raffles.id');
                },
            ])
            ->find($raffle_id);

        $raffle->blocked_hours = collect($raffle->currentAvailability?->blocked_hours ?? [])
            ->filter(function ($value) {
                return Carbon::parse($value)->isFuture();
            })
            ->values();

        unset($raffle->currentAvailability);

        return $raffle;
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
}
