<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'raffle_id',
        'day',
        'start_time',
        'end_time',
        'blocked_hours',
        'order'
    ];

    protected $casts = [
        'blocked_hours' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }
}
