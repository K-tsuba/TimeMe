<?php

namespace App\Http\Controllers;

use App\Tweet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Requests\TweetGoalRequest;
use App\Http\Requests\TweetReviewRequest;

class TweetController extends Controller
{
    public function goal_store(TweetGoalRequest $request, Tweet $tweet)
    {
        $status = $request['status'];
        $tweet->user_id = Auth::user()->id;
        $tweet->goal = $request['goal'];
        $tweet->save();
        if ($status == 1) { //$statusは投稿の公開ステータス 0：保留、1：公開
            $twitter = new TwitterOAuth(
                config('services.twitter.consumer_key'),
                config('services.twitter.consumer_secret'),
                config('services.twitter.access_token'),
                config('services.twitter.access_secret')
            );
            $twitter->post("statuses/update", [
                "status" => $tweet->goal 
            ]);
        }
        return redirect('/');
    }
    public function review_store(TweetReviewRequest $request, Tweet $tweet, $study_site_id)
    {
        $status = $request['status'];
        $tweet->user_id = Auth::user()->id;
        $tweet->review = $request['review'];
        $tweet->save();
        if ($status == 1) { //$statusは投稿の公開ステータス 0：保留、1：公開
            $twitter = new TwitterOAuth(
                config('services.twitter.consumer_key'),
                config('services.twitter.consumer_secret'),
                config('services.twitter.access_token'),
                config('services.twitter.access_secret')
            );
            $twitter->post("statuses/update", [
                "status" => $tweet->review 
            ]);
        }
        return redirect('/user/'.$study_site_id);
    }
}
