<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    
    protected $fillable = [
        'city', 
        'state',
        'postcode'
    ];

}
