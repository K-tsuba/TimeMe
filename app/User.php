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
    public function getOwnTimes()
    {
        // dd($this->times()->get());
        return $this->times()->get();
    }
    public function day_of_week($date)
    {
        // $date = Time::whereDate('created_at', '>=', $week)->where('study_site_id', $study_site_id)->get(['updated_at']);
        
        // dd($date[0]);
        $day_week = date('w', strtotime($date));
        // dd($day_week);
        $week = [ '日', '月', '火', '水', '木', '金', '土' ];
        // dd($week[$day_week]);
        return $week[$day_week];
    }
    
}
