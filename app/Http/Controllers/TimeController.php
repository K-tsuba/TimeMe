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
        // $record = $time->where('user_id', Auth::id())->latest('updated_at')->first();
        // $study_site_id = $record->study_site_id();
        return view('/times/index')->with([
            'study_sites' => $study_site->getOwnStudySites(),
            'times' => $time->getOwnPaginateByLimit()]);
            // 'own_study_sites' => $time->getSiteNames()]);
            // 'own_study_sites' => $time->where('user_id', Auth::id())->latest('updated_at')->getSiteNames()]);
            // 'own_study_sites' => $study_site->get($study_site_id)]);
            // 'own_study_sites' => $time->getSiteNames()]);
    }
    
    
    public function start_store(Request $request, Time $time, StudySite $study_site)
    {
        // $input = $request['post'];
        //postをキーにもつリクエストパラメータを取得
        
        $input = $request['status'];
        if ($input === 'start'){
            // $time->user_id = ['user_id' => $request->user()->id];
            $time->user_id = Auth::user()->id;
            
            // $user_id = Auth::user()->id;
            // $record = $time->where('user_id', $user_id)->latest('updated_at')->first();
            // $id = $record->id;
            // $time = Time::find($id);
            
            $time->start_time = new Carbon('now');
            
            $time->study_site_id = $study_site->id;
            
            $time->save();
            return redirect('/');
        } 
        // else if ($input === 'stop'){
        //     $time->stop_time = new Carbon('now');
        //     $time->time = $time->start_time->diffMinutes($time->stop_time);
        // }
        
        // $time->time = $request->time;
        // $time->save();
        
        // // $time->fill($input)->save();
        // // return redirect('/times' . $time->id);
        // return redirect('/times');
        
        // dd($request->all());
        
        // $time = $request->all();
        // $time = new Carbon('now');
        // $time->save();
        // return redirect('/times');
        
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
    // public function study_site_store($study_site, Time $time)
    // {
    //     $time->study_site_id = $study_site;
    //     $time->user_id = Auth::user()->id;
    //     $time->save();
    //     return redirect('/');
    // }
    
    public function show(Time $time)
    {
        return view('times/show')->with(['times' => $time->getOwnPaginateByLimit()]);
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
        $time_rank = $time->orderby('time', 'desc');
        $ranking = $time_rank->with('user')->paginate(10);
        
        return view('times/ranking')->with(['times' => $ranking]);
    }
}
