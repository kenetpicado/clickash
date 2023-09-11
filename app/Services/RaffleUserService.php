<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Models\Raffle;
use App\Models\RaffleUser;

class RaffleUserService
{
    public function getRafflesWithAvailability()
    {
        $user_id = auth()->user()->role == RoleEnum::OWNER->value
            ? auth()->id()
            : auth()->user()->user_id;

        return RaffleUser::query()
            ->with([
                'availability' => fn ($query) => $query->where('order', now()->dayOfWeek)
            ])
            ->addSelect([
                'raffle_name' => Raffle::select('name')
                    ->whereColumn('id', 'raffle_user.raffle_id')
                    ->limit(1),
                'raffle_image' => Raffle::select('image')
                    ->whereColumn('id', 'raffle_user.raffle_id')
                    ->limit(1),
            ])
            ->where('user_id', $user_id)
            ->get();
    }
}
