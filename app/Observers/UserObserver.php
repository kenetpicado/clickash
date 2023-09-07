<?php

namespace App\Observers;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    public function created(User $user)
    {
        if ($user->role == RoleEnum::OWNER->value) {
            $user->raffles()->attach([1, 2, 3, 4, 5, 6]);
        }
    }
}
