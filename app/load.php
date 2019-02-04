<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class load extends Model
{
    protected $fillable = [
        'active', 'code', 'tradeName','paking','focus','pPrice','ppPrice','drugStore','user_id','companyName'
    ];
}
