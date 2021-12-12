<?php

namespace App\Http\Controllers;

use App\Time;
use App\StudySite;
use App\User;
use App\Tweet;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

// use App\Http\Controllers\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuth;


class TimeController extends Controller
{
    public function index(StudySite $study_site, Time $time)
    {
        $latest_goal = Tweet::where('user_id', Auth::user()->id)->whereDate('updated_at', Carbon::today())->latest('updated_at')->first(['goal']);
        // $latest_goal = Tweet::where('user_id', Auth::user()->id)->whereDate('updated_at', Carbon::today()->get(['goal']);
        return view('/times/index')->with([
            'study_sites' => $study_site->getOwnStudySites(),
            'latest_goal' => $latest_goal
        ]);
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
            $time = $time->getLatestTime();
            $time->stop_time = new Carbon('now');
            $diff = strtotime('now') - strtotime($time->start_time);
            $time->time = gmdate('H:i:s', $diff);
            $time->save();
            return redirect('/');
        }
    }
    public function show(Time $time)
    {
        //先週のランキング
        $Users = User::get();
        $last_monday = Carbon::today()->startOfWeek()->subDay(7)->toDateString();
        $this_monday = Carbon::today()->startOfWeek()->toDateString();
        $week_ranking = $time->ranking($Users, $last_monday, $this_monday);
        //先月のランキング
        $last_month = Carbon::today()->startOfMonth()->subMonth()->toDateString();
        $this_month = Carbon::today()->startOfMonth()->toDateString();
        $month_ranking = $time->ranking($Users, $last_month, $this_month);
        
        return view('times/show')->with([
            'times' => $time->getTimes(),
            'week_ranking' => $week_ranking,
            'month_ranking' => $month_ranking
        ]);
    }
    public function edit(Time $time)
    {
        return view('times/edit')->with(['time' => $time ]);
    }
    public function update(Request $request, Time $time)
    {
        $edit_time = $request['time'];
        $time->time = date('H:i:s', strtotime($edit_time));
        $time->save();
        return redirect('times/show');
    }
    public function delete(Time $time)
    {
        $time->delete();
        return redirect('times/show');
    }
    
    
    public function ranking()
    {
        return redirect('/ranking');
    }
}
