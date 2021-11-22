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
    public function getTimes()
    {
        return $this->orderBy('updated_at', 'desc')->get();
    }
    

    
}
