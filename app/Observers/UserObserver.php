<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        if ($user->role == 'owner') {
            $user->raffles()->attach([1, 2, 3]);
        }
    }
}
