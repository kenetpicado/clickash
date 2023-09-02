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
        'fields',
        'image'
    ];

    public function getFieldsAttribute($value)
    {
        return json_decode($value);
    }
}
