<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Draw extends Model
{
    protected $casts = [
        'coordinates' => 'array'
    ];
}
