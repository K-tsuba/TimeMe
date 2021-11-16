<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Support\Facades\Auth;

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
    public function getOwnPaginateByLimit()
    {
        // dd($this->orderBy('updated_at', 'desc')->get());
        return $this->orderBy('updated_at', 'desc')->get();
        // dd($this::with('study_site')->where('user_id', Auth::id()));
    }
    // public function getSiteNames(Time $time)
    // {
    //     // return $this::with('study_sites')->where('user_id', Auth::id())->where('updated_at', 'desc')->first();
    //     $record = $time->where('user_id', $user_id)->latest('updated_at')->first();
    //     $sutdy_site_id = $record->id();
    //     return $this::with('study_site')->where('id', $sutdy_site_id)->paginate(1);
    // }
    // public function getrank()
    // {
    //     return $this::('user')->orderBy()
    // }
}
