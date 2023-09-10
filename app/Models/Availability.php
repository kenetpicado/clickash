<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'availability_id',
        'availability_type',
        'day',
        'start_time',
        'end_time',
        'blocked_hours',
        'order'
    ];

    public function availability()
    {
        return $this->morphTo();
    }

    public function getBlockedHoursAttribute($value)
    {
        return json_decode($value);
    }

    public function setBlockedHoursAttribute($value)
    {
        $this->attributes['blocked_hours'] = json_encode($value);
    }
}
