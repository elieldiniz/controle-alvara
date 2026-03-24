<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'nome',
        'slug',
        'max_users',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}
