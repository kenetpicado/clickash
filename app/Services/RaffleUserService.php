<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Models\Raffle;
use App\Models\RaffleUser;

class RaffleUserService
{
    public function getRafflesWithAvailability()
    {
        $isOwner = auth()->user()->role == RoleEnum::OWNER->value;

        $user_id = $isOwner
            ? auth()->id()
            : auth()->user()->user_id;

        return RaffleUser::query()
            ->when($isOwner, function ($query) {
                $query->whereHas("availability", function ($query) {
                    $query->where('order', now()->dayOfWeek)
                        ->where('start_time', '<=', now()->format('H:i:s'))
                        ->where('end_time', '>=', now()->format('H:i:s'));
                });
            })
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
