<?php

namespace App\Domain\Store\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name',
        'address',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
