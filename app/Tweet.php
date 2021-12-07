<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tweet extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'goal',
        'user_id'
    ];
}
