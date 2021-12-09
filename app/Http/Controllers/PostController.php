<?php

namespace App\Http\Controllers;

use  App\Post;
use  App\Http\Requests\PostRequest;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Pagination\Paginator;



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
        return redirect('/posts');
    }
}
