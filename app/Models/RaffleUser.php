<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RaffleUser extends Pivot
{
    use HasFactory;

    protected $table = 'raffle_user';

    protected $fillable = [
        'raffle_id',
        'user_id',
        'settings'
    ];
}
