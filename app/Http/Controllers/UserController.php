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
    public function index(Time $time, User $user, StudySite $study_site, Request $request, $study_site_id)
    {
        //今週1週間のtimesを取得
        $this_week_time_all = $time->this_week_all($study_site_id);
        //表示する学習サイトを取得
        $study_site = $study_site->getStudySitefirst($study_site_id);
        //今週1週間の時間だけを取得
        $sum_this_week = $time->sum_times($time->this_week_times($study_site_id));
        //第1,2,3,4,5週目の日付取得
        $first_week = Carbon::today()->startOfMonth()->toDateString();
        $second_week = Carbon::today()->startOfMonth()->addWeek()->toDateString();
        $third_week = Carbon::today()->startOfMonth()->addWeek(2)->toDateString();
        $fourth_week = Carbon::today()->startOfMonth()->addWeek(3)->toDateString();
        $fifth_week = Carbon::today()->startOfMonth()->addWeek(4)->toDateString();
        $six_week = Carbon::today()->startOfMonth()->addMonth()->toDateString();
        //第1週目
        $first_week_sum = $time->sum_times($time->week_of_times($study_site_id, $first_week, $second_week));
        //第2週目
        $second_week_sum = $time->sum_times($time->week_of_times($study_site_id, $second_week, $third_week));
        //第3週目
        $third_week_sum = $time->sum_times($time->week_of_times($study_site_id, $third_week, $fourth_week));
        //第4週目
        $fourth_week_sum = $time->sum_times($time->week_of_times($study_site_id, $fourth_week, $fifth_week));
        //第5週目
        $fifth_week_sum = $time->sum_times($time->week_of_times($study_site_id, $fifth_week, $six_week));
        //全部の合計時間
        $all_times = Time::where('study_site_id', $study_site_id)->get(['time']);
        $all_sum = $time->sum_times($all_times);
        //今月の合計時間
        $this_month_times = Time::whereMonth('updated_at', Carbon::today()->month)->where('study_site_id', $study_site_id)->get(['time']);
        $this_month_sum = $time->sum_times($this_month_times);
        
        //過去のデータ表示
        $Times = $time->times_of_one_site($study_site_id);
        
        $year = $request->input('year');
        $month = $request->input('month');
        
        if ($year !== null){
            $past_times = $Times->whereYear('updated_at', $year);
            if ($month !== null){
                $past_times = $Times->whereMonth('updated_at', $month);
            }
        }

        // $past_times = $time->past_time_search($Times, $year, $month);

        if (!empty($request['year']) && !empty($request['month'])){
            $past_month_sum = $time->sum_times($past_times->get());
        } else {
            $past_month_sum = null;
        }
        
        $today = Carbon::today();
        $week = [ '日', '月', '火', '水', '木', '金', '土' ];

        return view('User/index')->with([
            'own_study_sites' => $this_week_time_all,
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
            'month_sum' => $past_month_sum,
            'year' => $year,
            'month' => $month
        ]);
    }
}
