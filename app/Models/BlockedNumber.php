<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'settings',
        'user_id',
        'raffle_id',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }
}
