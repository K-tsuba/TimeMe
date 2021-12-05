<?php

namespace App\Http\Controllers;

use  App\Post;
use  App\Http\Requests\PostRequest;

use Abraham\TwitterOAuth\TwitterOAuth;



class PostController extends Controller
{
    
    public function index(Post $post)
    {
        return view('/posts/index')->with(['posts' => $post->getUser()]);
    }
    public function create()
    {
        return view('posts/create');
    }
    public function store(Post $post, PostRequest $request)
    {
        $input = $request['post'];
        $input += ['user_id' => $request->user()->id];
        $post->fill($input)->save();
        
        
        // $twitter = new TwitterOAuth(
        //     env('TWITTER_CLIENT_ID'),
        //     env('TWITTER_CLIENT_SECRET'),
        //     env('TWITTER_CLIENT_ID_ACCESS_TOKEN'),
        //     env('TWITTER_CLIENT_ID_ACCESS_TOKEN_SECRET')
        //     );
            
        // $twitter->post("statuses/update", [
        //     "status" =>
        //         'New Photo Post!' . PHP_EOL .
        //         '新しい聖地の写真が投稿されました!' . PHP_EOL 
        //         // 'タイトル「' . $title . '」' . PHP_EOL .
        //         // '#photo #anime #photography #アニメ #聖地 #写真 #HolyPlacePhoto' . PHP_EOL .
        //         // 'https://www.holy-place-photo.com/photos/' . $id
        // ]);
        // dd($twitter);
        
        $status = '1';
        
        if ($status == 1) { //$statusは投稿の公開ステータス 0：保留、1：公開
            $twitter = new TwitterOAuth(
                env('TWITTER_CLIENT_ID'),
                env('TWITTER_CLIENT_SECRET'),
                env('TWITTER_CLIENT_ID_ACCESS_TOKEN'),
                env('TWITTER_CLIENT_ID_ACCESS_TOKEN_SECRET')
            );
            
            $twitter->post("statuses/update", [
                "status" =>
                    'test' . PHP_EOL .
                    '' . PHP_EOL .
                    // '✋' .$title. '✨' . PHP_EOL .
                    // '' . PHP_EOL .
                    // '💻https://pokotech.me/' .$name. '/' . PHP_EOL .
                    // '' . PHP_EOL .
                    '#プログラミング #プログラミング初心者 #プログラミング学習'
            ]);
        }
        
        
        return redirect('/posts/');
    }
    public function edit(Post $post)
    {
        return view('posts/edit')->with(['post' => $post]);
    }
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $input_post += ['uesr_id' => $request->user()->id];
        $post->fill($input_post)->save();
        return redirect('/posts/');
    }
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
