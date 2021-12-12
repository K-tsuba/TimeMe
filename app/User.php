<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function times()   
    {
        return $this->hasMany('App\Time', 'user_id');  
    }
    public function study_sites()
    {
        return $this->belongsToMany('App\StudySite');
    }
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
    public function getOwnTimes()
    {
        return $this->times()->get();
    }
    public function day_of_week($date)
    {
        $day_week = date('w', strtotime($date));
        $week = [ '日', '月', '火', '水', '木', '金', '土' ];
        return $week[$day_week];
    }
    public function this_week_times($study_site_id)
    {
        return $this->whereDate('created_at', '>=', Carbon::today()->startOfWeek())->where('study_site_id', $study_site_id)->get();
    }
}
