<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Models\User;

class UserService
{
    public function getUserId(): int
    {
        return self::isOwner()
            ? auth()->id()
            : auth()->user()->user_id;
    }

    public function getTeamIds($user_id): array
    {
        return User::query()
            ->where('id', $user_id)
            ->orWhere('user_id', $user_id)
            ->pluck('id')
            ->toArray();
    }

    public function isOwner(): bool
    {
        return auth()->user()->role == RoleEnum::OWNER->value;
    }
}
