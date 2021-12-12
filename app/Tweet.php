<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Auth;
use Carbon\Carbon;

class Tweet extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'goal',
        'user_id'
    ];
    
    public function latest_goal()
    {
        return $this->where('user_id', Auth::user()->id)->whereDate('updated_at', Carbon::today())->latest('updated_at')->first(['goal']);
    }
    public function latest_review()
    {
        return $this->where('user_id', Auth::user()->id)->whereDate('updated_at', Carbon::today())->latest('updated_at')->first(['review']);
    }
}
