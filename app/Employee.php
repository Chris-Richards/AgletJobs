<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'location',
        'resume_url',
        'visible',
    ];

    protected $casts = [
        'skills' => 'json',
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function location()
    {
        return $this->hasOne('App\Location', 'id', 'location')->first();
    }
}
