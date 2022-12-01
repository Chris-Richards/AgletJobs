<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'employee_id',
        'cover_letter',
        'job_id'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id')->first();
    }

    public function employee()
    {
        return $this->hasOne('App\Employee', 'user_id', 'user_id')->first();
    }
}
