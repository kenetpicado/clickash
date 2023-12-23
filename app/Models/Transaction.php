<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'raffle_id',
        'digit',
        'amount',
        'client',
        'hour',
        'user_id',
        'created_at',
        'prize',
        'status',
        'super_x',
        'invoice_number'
    ];

    protected $hidden = ['updated_at'];

    public function setClientAttribute($value)
    {
        $this->attributes['client'] = mb_strtoupper($value, 'UTF-8');
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
