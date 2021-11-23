<?php

namespace App\Http\Controllers;

use App\Time;
use App\StudySite;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class TimeController extends Controller
{
    public function index(StudySite $study_site, Time $time)
    {
        return view('/times/index')->with([
            'study_sites' => $study_site->getOwnStudySites()]);
    }
    
    
    public function start_store(Request $request, Time $time, StudySite $study_site)
    {
        $input = $request['status'];
        if ($input === 'start'){
            $time->user_id = Auth::user()->id;

            $time->start_time = new Carbon('now');
            
            $time->study_site_id = $study_site->id;
            
            $time->save();
            return redirect('/');
        } 

    }
    
    public function stop_store(Request $request, Time $time){
        $input = $request['status'];
        if ($input === 'stop'){
            $user_id = Auth::user()->id;
            $record = $time->where('user_id', $user_id)->latest('updated_at')->first();
            $id = $record->id;
            $time = Time::find($id);
            $time->stop_time = new Carbon('now');
            $start_time = $record->start_time;
            $start = strtotime($start_time);
            $stop = strtotime('now');
            $diff = $stop - $start;
            $diff_time = gmdate('H:i:s', $diff);
            $time->time = $diff_time;
            $time->save();
            return redirect('/');
        }
        // dd($request->all());
    }

    public function show(Time $time)
    {
        $Users = User::get(['id']);
        // dd($Users);
        
        // dd($User[0]['id']);
        // $Time = Time::where('user_id', $User[0]['id'])->get(['time']);
        // dd($Time);
        $initial_time = "00:00:00";
        $User_0_sum = "00:00:00";
        // foreach ($Time as $addend){
        //     $User_0_sum = _get_sum_time($User_0_sum, _get_sum_time($initial_time, $addend['time']));
        // };
        // $Times = $Time['time'];
        // dd($User_0_sum);
        foreach ($Users as $user_id){
            $Time = Time::where('user_id', $user_id['id'])->get();
        };
        dd($Time);
        
        return view('times/show')->with(['times' => $time->getTimes()]);
    }
    public function edit(Time $time)
    {
        return view('times/edit')->with(['time' => $time ]);
    }
    public function update(Request $request, Time $time)
    {
        $edit_time = $request['time'];
        $strtotime = strtotime($edit_time);
        $time->time = date('H:i:s', $strtotime);
        $time->save();
        return redirect('/');
    }
    public function delete(Time $time)
    {
        $time->delete();
        return redirect('times/show');
    }
    public function ranking(Time $time)
    {
        $week = Carbon::today()->subDay(7);
        $time_rank = $time->orderby('time', 'desc')->whereDate('created_at', '>=', $week);
        $ranking = $time_rank->with('user')->paginate(10);
        
        // function _get_sum_time($source_time, $add_time) {
        //     $source_times = explode(":", $source_time);
        //     $add_times = explode(":", $add_time);
        //     return date("H:i:s", mktime($source_times[0] + $add_times[0], $source_times[1] + $add_times[1], $source_times[2] + $add_times[2]));
        // };
        // //今週1週間の時間だけを取得
        // $this_week_times = Time::whereDate('created_at', '>=', Carbon::today()->startOfWeek())->get();
        // $initial_time = "00:00:00";
        // $sum_this_week = "00:00:00";
        // foreach ($this_week_times as $addend){
        //     $sum_this_week = _get_sum_time($sum_this_week, _get_sum_time($initial_time, $addend['time']));
        // };
        
        
        return view('times/ranking')->with([
            'times' => $ranking,
            'sum_this_weeks' => $sum_this_week
        ]);
    }
}
