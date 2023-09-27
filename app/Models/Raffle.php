<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Raffle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array'
    ];

    public function availability()
    {
        return $this->hasMany(Availability::class);
    }

    public function currentAvailability()
    {
        return $this->hasOne(Availability::class)->where('order', now()->dayOfWeek);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function raffle_user()
    {
        return $this->hasOne(RaffleUser::class);
    }

    public function blockedNumbers()
    {
        return $this->hasMany(BlockedNumber::class);
    }
}
