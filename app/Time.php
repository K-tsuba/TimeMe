<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

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
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function study_site()
    {
        return $this->belongsTo('App\StudySite');
    }
    
    public function getTimes()
    {
        return $this->orderBy('updated_at', 'desc')->paginate(10);
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
    
    public function this_week_all($study_site_id)
    {
        return $this->whereDate('created_at', '>=', Carbon::today()->startOfWeek())->where('study_site_id', $study_site_id)->get();
    }
    
    public function this_week_times($study_site_id)
    {
        return $this->whereDate('created_at', '>=', Carbon::today()->startOfWeek())->where('study_site_id', $study_site_id)->get(['time']);
    }
    
    public function ranking($Users, $start, $end)
    {
        $last_data = array();
        $i = 0;
        foreach ($Users as $user){
            $last_times = $this->where('user_id', $user->id)->whereBetween('updated_at', [$start, $end])->get();
            $initial_time = "00:00:00";
            $sum_time = "00:00:00";
            foreach ($last_times as $addend){
                $sum_time = $this->_get_sum_time($sum_time, $this->_get_sum_time($initial_time, $addend['time']));
            }
            $last_data[$i] = array('sum'=>$sum_time, 'user_name'=>$user->name);
            $i++;
        };
        $data_order = collect($last_data)->sortByDesc('sum')->take(10);
        return $data_order;
    }
    public function sum_times($times)
    {
        $initial_time = "00:00:00";
        $sum_times = "00:00:00";
        foreach ($times as $addend){
            $sum_times = $this->_get_sum_time($sum_times, $this->_get_sum_time($initial_time, $addend['time']));
        };
        return $sum_times;
    }
    public function week_of_times($study_site_id, $start_week, $next_week)
    {
        return $this->whereBetween('updated_at', [$start_week, $next_week])->where('study_site_id', $study_site_id)->get(['time']);
    }
    public function times_of_one_site($study_site_id)
    {
        return $this->orderBy('updated_at', 'desc')->where('study_site_id', $study_site_id);
    }
    // public function past_time_search($Times, $year, $month)
    // {
    //     if ($year !== null){
    //         $past_times = $Times->whereYear('updated_at', $year);
    //         if ($month !== null){
    //             $past_times = $Times->whereMonth('updated_at', $month);
    //         }
    //     }
    //     return $past_times;
    // }
    
    
}
