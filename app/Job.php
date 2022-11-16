<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\View;

class Job extends Model
{
    
    protected $fillable = [
        'user_id', 
        'title',
        'company',
        'role',
        'other',
        'apply_url',
        'location',
        'entry',
        'type'
    ];

    protected $casts = [
        'tags' => 'json',
    ];

    public function view()
    {
        return $this->hasMany(View::class, 'job_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function location()
    {
        return $this->hasOne('App\Location', 'id', 'location')->first();
    }

}
