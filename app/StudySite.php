<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class StudySite extends Model
{
    protected $fillable = [
        'study_title',
        'study_site',
        'user_id'
    ];
    public function Users()
    {
        return $this->belongsToMany('App\User');
    }
    public function times()
    {
        return $this->hasMany('App\Time');
    }
    public function getOwnStudySites()
    {
        // return $this::with('times')->find(Auth::id())->times()->orderBy('updated_at', 'desc')->get();                 
        return $this->where('user_id', Auth::id())->get();
    }
    public function getOwnTimes()
    {
        return $this->times()->get();
        // return $this::with('times')->where('user_id', Auth::id())->orderBy('updated_at', 'desc')->get();
        // dd($this::with('times')->where('user_id', Auth::id())->get());
    }
    
}
