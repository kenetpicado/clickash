<?php

namespace App\Models;

use Carbon\Carbon;
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
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
        'custom_settings' => 'array',
    ];

    public function availability()
    {
        return $this->hasMany(Availability::class);
    }

    public function currentAvailability()
    {
        return $this->hasOne(Availability::class)->where('order', Carbon::now()->dayOfWeek);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('settings')
            ->withTimestamps();
    }

    public function raffle_user()
    {
        return $this->hasOne(RaffleUser::class);
    }

    public function blockedNumbers()
    {
        return $this->hasMany(BlockedNumber::class);
    }

    public function winningNumbers()
    {
        return $this->hasMany(WinningNumber::class);
    }

    public function scopeHasUser($query, $user_id)
    {
        return $query->whereHas('users', function ($query) use ($user_id) {
            $query->where('raffle_user.user_id', $user_id);
        });
    }
}
