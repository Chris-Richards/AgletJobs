<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $fillable = [
        'user_id',
        'business_name',
        'business_abn',
        'about',
        'active',
        'expiry'
    ];
}
