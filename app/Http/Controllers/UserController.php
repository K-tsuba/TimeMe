<?php

namespace App\Http\Controllers;

use App\User;
use App\StudySite;
use App\Time;

use Carbon\Carbon;

use Auth;

class UserController extends Controller
{
    public function index(User $user,  $study_site_id)
    {
        $week = Carbon::today()->subDay(7);
        
        $time = Time::whereDate('created_at', '>=', $week)->where('study_site_id', $study_site_id)->get();
        // dd($time);
        $study_site = StudySite::where('id', $study_site_id)->first();
        
        
        // $a = Time::where('id', 14)->first();
        // $b = $a->time;
        // // $strtotime = strtotime($b);
        // $c = Time::where('id', 15)->first();
        // $d = $c->time;
        // // $strtotime_2 = strtotime($d, $strtotime);
        // // $add = $strtotime_2 - $strtotime;
        // // $e = strtotime($add);
        // // $sum = gmdate('H:i:s', $add);

        function _get_sum_time($source_time, $add_time) {
            $source_times = explode(":", $source_time);
            $add_times = explode(":", $add_time);
            return date("H:i:s", mktime($source_times[0] + $add_times[0], $source_times[1] + $add_times[1], $source_times[2] + $add_times[2]));
        }
        
        // $sum = _get_sum_time($b, $d);
        
        // $source_times = explode(":", $b);
        // // dd($source_times);
        
        $sum_week = Time::whereDate('created_at', '>=', $week)->where('study_site_id', $study_site_id)->get(['time']);
        $arrPregSplit = preg_split("/[,]/", $sum_week);
        $a = implode($arrPregSplit);
        $b = preg_match_all('/([01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]/', $a, $m);
        // dd($m[0]);
        $c = implode(':', $m[0]);
        // dd($d);
        // $v = explode(":", $d);
        $d = explode(":", $c);
        dd($d);
        // $V = explode(":", $m[0][1]);
        // dd($V);
        
        return view('User/index')->with([
            'own_study_sites' => $time,
            'own_study_site' => $study_site
        ]);
        // dd(user());
    }
}
