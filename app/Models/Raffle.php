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

    public function blockedNumbers()
    {
        return $this->morphMany(BlockedNumber::class, 'blockable');
    }

    public function availability()
    {
        return $this->morphMany(Availability::class, 'availability');
    }
}
