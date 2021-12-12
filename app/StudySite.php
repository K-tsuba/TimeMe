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
        return $this->where('user_id', Auth::id())->get();
    }
    public function getOwnTimes()
    {
        return $this->times()->get();
    }
    public function getStudySitefirst($study_site_id)
    {
        return $this->where('id', $study_site_id)->first();
    }
}
