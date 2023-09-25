<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaffleUser extends Model
{
    use HasFactory;

    protected $table = 'raffle_user';

    protected $fillable = [
        'raffle_id',
        'user_id',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array'
    ];

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
