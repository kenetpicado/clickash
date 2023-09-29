<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ["raffle_id", "digit", "amount", "client", "hour", "user_id", "created_at"];

    //hide updated at
    protected $hidden = ["updated_at"];

    // public function getCreatedAtAttribute($value)
    // {
    //     return Carbon::parse($value)->timezone("America/Managua")->format('d/m/y g:i A');
    // }
}
