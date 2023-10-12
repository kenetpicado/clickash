<?php

namespace App\Services;

use App\Enums\RoleEnum;

class UserService
{
    public function getOwnerId(): int
    {
        return self::isOwner()
            ? auth()->id()
            : auth()->user()->user_id;
    }

    public function isOwner(): bool
    {
        return auth()->user()->role == RoleEnum::OWNER->value;
    }
}
