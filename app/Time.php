<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Support\Facades\Auth;

use Auth;

class Time extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'time',
        'start_time',
        'stop_time',
        'user_id'
    ];
    
    public function latestId(){
        return $this->latest('updated_at')->first();
    }
    public function diff(){
        // return 
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function study_site()
    {
        return $this->belongsTo('App\StudySite');
    }
    public function getTimes(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'desc')->limit($limit_count)->get();
    }
    public function getLatestTime()
    {
        return $this->where('user_id', Auth::user()->id)->latest('updated_at')->first();
    }
    // public function _get_sum_time($source_time, $add_time)
    // {
    //     $source_times = explode(":", $source_time);
    //     $add_times = explode(":", $add_time);
    //     return date("H:i:s", mktime($source_times[0] + $add_times[0], $source_times[1] + $add_times[1], $source_times[2] + $add_times[2]));
    // }
    // public function lastWeekTimes()
    // {
    //     return $this->where('user_id', $user_id['id'])->whereBetween('updated_at', [$last_monday, $this_monday])->get();
    // }
}
