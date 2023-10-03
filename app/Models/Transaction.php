<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['raffle_id', 'digit', 'amount', 'client', 'hour', 'user_id', 'created_at'];

    protected $hidden = ['updated_at'];

    public function setClientAttribute($value)
    {
        $this->attributes['client'] = strtoupper($value);
    }

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
