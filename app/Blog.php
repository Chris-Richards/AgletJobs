<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'tags',
    ];

    protected $casts = [
        'tags' => 'json',
    ];
}
