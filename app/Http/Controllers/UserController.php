<?php

namespace App\Http\Controllers;

use App\User;
use App\StudySite;
use App\Time;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Auth;

class UserController extends Controller
{
    public function index(User $user, Request $request, $study_site_id)
    {
        $today = Carbon::today();
        //今週1週間のtimesを取得
        $time = Time::whereDate('created_at', '>=', $today->startOfWeek())->where('study_site_id', $study_site_id)->get();
        //表示する学習サイトを取得
        $study_site = StudySite::where('id', $study_site_id)->first();

        function _get_sum_time($source_time, $add_time) {
            $source_times = explode(":", $source_time);
            $add_times = explode(":", $add_time);
            return date("H:i:s", mktime($source_times[0] + $add_times[0], $source_times[1] + $add_times[1], $source_times[2] + $add_times[2]));
        };
        //今週1週間の時間だけを取得
        $this_week_times = Time::whereDate('created_at', '>=', $today->startOfWeek())->where('study_site_id', $study_site_id)->get(['time']);
        // dd($this_week_times);
        $initial_time = "00:00:00";
        $sum_this_week = "00:00:00";
        foreach ($this_week_times as $addend){
            $sum_this_week = _get_sum_time($sum_this_week, _get_sum_time($initial_time, $addend['time']));
        };
        // dd($sum_this_week);
        $week = [ '日', '月', '火', '水', '木', '金', '土' ];

        //第1,2,3,4,5週目の日付取得
        $first_week = Carbon::today()->startOfMonth()->toDateString();
        $second_week = Carbon::today()->startOfMonth()->addWeek()->toDateString();
        $third_week = Carbon::today()->startOfMonth()->addWeek(2)->toDateString();
        $fourth_week = Carbon::today()->startOfMonth()->addWeek(3)->toDateString();
        $fifth_week = Carbon::today()->startOfMonth()->addWeek(4)->toDateString();
        $six_week = Carbon::today()->startOfMonth()->addMonth()->toDateString();
        // dd($six_week);
        
        //第1週目
        $first_week_times = Time::whereBetween('updated_at', [$first_week, $second_week])->where('study_site_id', $study_site_id)->get(['time']);
        $initial_time = "00:00:00";
        $first_week_sum = "00:00:00";
        foreach ($first_week_times as $addend){
            $first_week_sum = _get_sum_time($first_week_sum, _get_sum_time($initial_time, $addend['time']));
        };
        // dd($first_week_sum);
        //第2週目
        $second_week_times = Time::whereBetween('updated_at', [$second_week, $third_week])->where('study_site_id', $study_site_id)->get(['time']);
        $initial_time = "00:00:00";
        $second_week_sum = "00:00:00";
        foreach ($second_week_times as $addend){
            $second_week_sum = _get_sum_time($second_week_sum, _get_sum_time($initial_time, $addend['time']));
        };
        //第3週目
        $third_week_times = Time::whereBetween('updated_at', [$third_week, $fourth_week])->where('study_site_id', $study_site_id)->get(['time']);
        $initial_time = "00:00:00";
        $third_week_sum = "00:00:00";
        foreach ($third_week_times as $addend){
            $third_week_sum = _get_sum_time($third_week_sum, _get_sum_time($initial_time, $addend['time']));
        };
        // dd($third_week_sum);
        //第4週目
        $fourth_week_times = Time::whereBetween('updated_at', [$fourth_week, $fifth_week])->where('study_site_id', $study_site_id)->get(['time']);
        $initial_time = "00:00:00";
        $fourth_week_sum = "00:00:00";
        foreach ($fourth_week_times as $addend){
            $fourth_week_sum = _get_sum_time($fourth_week_sum, _get_sum_time($initial_time, $addend['time']));
        };
        // dd($fourth_week_sum);
        //第5週目
        $fifth_week_times = Time::whereBetween('updated_at', [$fifth_week, $six_week])->where('study_site_id', $study_site_id)->get(['time']);
        $initial_time = "00:00:00";
        $fifth_week_sum = "00:00:00";
        foreach ($fifth_week_times as $addend){
            $fifth_week_sum = _get_sum_time($fifth_week_sum, _get_sum_time($initial_time, $addend['time']));
        };
        
        //全部の合計時間
        $all_times = Time::where('study_site_id', $study_site_id)->get(['time']);
        $initial_time = "00:00:00";
        $all_sum = "00:00:00";
        foreach ($all_times as $addend){
            $all_sum = _get_sum_time($all_sum, _get_sum_time($initial_time, $addend['time']));
        };
        //今月の合計時間
        $this_month_times = Time::whereMonth('updated_at', Carbon::today()->month)->where('study_site_id', $study_site_id)->get(['time']);
        $initial_time = "00:00:00";
        $this_month_sum = "00:00:00";
        foreach ($this_month_times as $addend){
            $this_month_sum = _get_sum_time($this_month_sum, _get_sum_time($initial_time, $addend['time']));
        };
        // dd($this_month_sum);
        
        
        $Time = Time::orderBy('updated_at', 'desc')->get();
        // dd($Time);
        // $query = User::query();
        // dd($query);
        $year = $request->input('year');
        $month = $request->input('month');

        // if($request->has('year') && $year != null){
        //     $query->where('updated_at', $year)->get();
        //     if($request->has('month') && $month != null){
        //         $query->where('updated_at', $month)->get();
        //     }
        // }
        if ($year !== null){
            $Time->whereYear('updated_at', $year)->get();
            if ($month !== null){
                $Time->whereMonth('updated_at', $month)->get();
            }
        }
        
        // $data = $query->whereYear('updated_at', $year)->get();
        
        $data = $Time->get();
        dd($data);
        
        
        
        // $Users = User::get();
        // dd($Users);
        // // dd($User[0]['id']);
        // // $Time = Time::where('user_id', $User[0]['id'])->get(['time']);
        // // dd($Time);
        // // $initial_time = "00:00:00";
        // // $User_0_sum = "00:00:00";
        // // foreach ($Time as $addend){
        // //     $User_0_sum = _get_sum_time($User_0_sum, _get_sum_time($initial_time, $addend['time']));
        // // };
        // // $Times = $Time['time'];
        // // dd($User_0_sum);
        // foreach ($Users as $user_id){
        //     $Time = Time::where('user_id', $user_id['id'])->get(['time']);
        // };
        // dd($Time);
        
        
        
        

        return view('User/index')->with([
            'own_study_sites' => $time,
            'own_study_site' => $study_site,
            'sum_this_week' => $sum_this_week,
            'week' => $week,
            'today' => $today,
            'first_week_sum' => $first_week_sum,
            'second_week_sum' => $second_week_sum,
            'third_week_sum' => $third_week_sum,
            'fourth_week_sum' => $fourth_week_sum,
            'fifth_week_sum' => $fifth_week_sum,
            'this_month_sum' => $this_month_sum,
            'all_sum' => $all_sum,
            'datas' => $data
        ]);
        // dd(user());
    }
}
