<?php

namespace App\Http\Controllers;

use App\Time;
use App\StudySite;
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
        
        return view('times/ranking')->with(['times' => $ranking]);
    }
}
