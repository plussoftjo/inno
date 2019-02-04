<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class active extends Model
{
    protected $fillable = [
        'active', 'couns', 'warn','count'
    ];
}
