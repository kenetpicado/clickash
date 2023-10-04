<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WinningNumber extends Model
{
    use HasFactory;

    protected $fillable = ['raffle_id', 'user_id', 'number', 'hour', 'date'];

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }
}
