<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arching extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'amount',
        'seller_id',
        'user_id',
        'current_balance',
        'created_at'
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
