<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\Paginator;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'content',
        'title',
        'body',
        'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function getUser()
    {
        return $this::with('user')->orderBy('updated_at', 'DESC')->paginate(10);
    }

}
