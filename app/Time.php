<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

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
    
    public function _get_sum_time($source_time, $add_time)
    {
        $source_times = explode(":", $source_time);
        $add_times = explode(":", $add_time);
        return date("H:i:s", mktime($source_times[0] + $add_times[0], $source_times[1] + $add_times[1], $source_times[2] + $add_times[2]));
    }
    
    public function last_week_times()
    {
        return $this->where('user_id', $user->id)->whereBetween('updated_at', [$last_monday, $this_monday])->get();
    }
    // public function lastWeekTimes()
    // {
    //     return $this->where('user_id', $user_id['id'])->whereBetween('updated_at', [$last_monday, $this_monday])->get();
    // }
    public function this_week_all($study_site_id)
    {
        return $this->whereDate('created_at', '>=', Carbon::today()->startOfWeek())->where('study_site_id', $study_site_id)->get();
    }
    
    public function this_week_times($study_site_id)
    {
        return $this->get(['time']);
    }
    
    public function last_week_ranking($Users)
    {
        $last_week_data = array();
        $i = 0;
        // $Users = User::get();
        $last_monday = Carbon::today()->startOfWeek()->subDay(7)->toDateString();
        $this_monday = Carbon::today()->startOfWeek()->toDateString();
        
        foreach ($Users as $user){

            $last_week_times = $time->where('user_id', $user->id)->whereBetween('updated_at', [$last_monday, $this_monday])->get();
            $initial_time = "00:00:00";
            $sum_time_week = "00:00:00";
            
            foreach ($last_week_times as $addend){
                $sum_time_week = _get_sum_time($sum_time_week, _get_sum_time($initial_time, $addend['time']));
            }
            $last_week_data[$i] = array('sum'=>$sum_time_week, 'user_name'=>$user->name);
            $i++;
        };
        $week_data_order = collect($last_week_data)->sortByDesc('sum')->take(10);
        
        return $week_data_order;
    }
}
