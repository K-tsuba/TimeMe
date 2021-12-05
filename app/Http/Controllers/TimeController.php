<?php

namespace App\Http\Controllers;

use App\Time;
use App\StudySite;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuth;


class TimeController extends Controller
{
    public function index(StudySite $study_site, Time $time)
    {
        return view('/times/index')->with([
            'study_sites' => $study_site->getOwnStudySites() //Timeモデルじゃない所から関数を呼べるのか？
        ]);
    }
    
    
    public function app(StudySite $study_site, Time $time)
    {
        return view('/times/index')->with([
            'study_sites' => $study_site->getOwnStudySites() //Timeモデルじゃない所から関数を呼べるのか？
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
            // 'sum_this_weeks' => $sum_this_week
        ]);
    }
    public function tweet(Request $request){
        $twitter = new TwitterOAuth(
            env('TWITTER_CLIENT_ID'),
            env('TWITTER_CLIENT_SECRET'),
            env('TWITTER_CLIENT_ID_ACCESS_TOKEN'),
            env('TWITTER_CLIENT_ID_ACCESS_TOKEN_SECRET')
            );
            
        $twitter->post("statuses/update", [
            "status" =>
                'New Photo Post!' . PHP_EOL .
                '新しい聖地の写真が投稿されました!' . PHP_EOL 
                // 'タイトル「' . $title . '」' . PHP_EOL .
                // '#photo #anime #photography #アニメ #聖地 #写真 #HolyPlacePhoto' . PHP_EOL .
                // 'https://www.holy-place-photo.com/photos/' . $id
        ]);
        // $res = self::tweet($twitter);
        // return $res;
        return redirect('/ranking');

    }
}
