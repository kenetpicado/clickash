<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    const STATUS_ENABLED = 'enabled';
    const STATUS_DISABLED = 'disabled';

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
        'last_login' => 'datetime',
    ];

    protected $appends = [
        'online',
    ];

    public function getOnlineAttribute(): string
    {
        if (! $this->last_login) {
            return 'No ha iniciado sesión';
        }

        if ($this->last_login->diffInMinutes() < 4) {
            return 'Activo ahora';
        }

        return 'Activo '.$this->last_login->diffForHumans();
    }

    public function setCompanyNameAttribute($value)
    {
        $this->attributes['company_name'] = strtoupper($value);
    }

    public function sellers()
    {
        return $this->hasMany(User::class, 'user_id')->orderBy('name');
    }

    public function raffles()
    {
        return $this->belongsToMany(Raffle::class, 'raffle_user')
            ->using(RaffleUserPivot::class)
            ->withPivot('id', 'settings');
    }

    public function availability()
    {
        return $this->hasMany(Availability::class);
    }

    public function blockedNumbers()
    {
        return $this->hasMany(BlockedNumber::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function isOwner(): bool
    {
        return $this->role == 'owner';
    }

    public function isSeller(): bool
    {
        return $this->role == 'seller';
    }

    public function getOwnerId()
    {
        if ($this->isOwner()) {
            return $this->id;
        }

        return $this->user_id;
    }

    public function isEnabled()
    {
        return $this->status == 'enabled';
    }

    public function getCompanyName()
    {
        if (!$this->company_name) {
            DB::table('users')->where('id', auth()->user()->getOwnerId())->value('company_name');
        } else {
            return $this->company_name;
        }
    }
}
