<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login',
        'sellers_limit',
        'company_name',
        'role',
        'status',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime'
    ];

    protected $appends = [
        'online'
    ];

    public function getOnlineAttribute(): string
    {
        if (!$this->last_login)
            return 'Not logged in';

        if ($this->last_login->diffInMinutes() < 4)
            return 'Now';

        return $this->last_login->diffForHumans();
    }

    public function sellers()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function raffles()
    {
        return $this->belongsToMany(Raffle::class, 'raffle_user')
            ->using(RaffleUser::class)
            ->withTimestamps();
    }

    public function parentRaffles()
    {
        return $this->belongsToMany(Raffle::class, 'raffle_user', parentKey: 'user_id');
    }
}
