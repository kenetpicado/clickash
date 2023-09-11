<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'blockable_id',
        'blockable_type'
    ];

    public function blockable()
    {
        return $this->morphTo();
    }
}
