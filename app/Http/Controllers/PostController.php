<?php

namespace App\Http\Controllers;

use  App\Post;
use  App\Http\Requests\PostRequest;



class PostController extends Controller
{
    // public function index(Post $post)
    // {
    //     // return view('posts/index')->with(['posts' => $post->get()]);  
        
    //     // return view('posts/index')->with(['own_posts' => $post->getPaginateByLimit()]);
        
    //     $client = new\GuzzleHttp\Client();
        
    //     $url = 'https://teratail.com/api/v1/questions';
        
    //     $response = $client->request(
    //         'GET',
    //         $url,
    //         ['Bearer' => config('services.teratail.token')]
    //     );
        
    //     $questions = json_decode($response->getBody(), true);
        
    //     return view('posts/index')->with([
    //         'posts' => $post->getPaginateByLimit(),
    //         'questions' => $questions['questions'],
    //         'own_posts' => $post->getPaginateByLimit(),
    //     ]);
    // }
    
    // public function show(Post $post)
    // {
    //     return view('posts/show')->with(['post' => $post]);
    // }
    
    // public function create()
    // {
    //     return view('posts/create');
    // }
    
    // public function store(Post $post, PostRequest $request)
    // {
    //     // dd($request->all());
        
    //     $input = $request['post'];
    //     $input += ['user_id' => $request->user()->id];
    //     $post->fill($input)->save();
    //     return redirect('/posts/' . $post->id);
    // }
    
    // public function edit(Post $post)
    // {
    //     return view('posts/edit')->with(['post' => $post]);
    // }
    
    // public function update(PostRequest $request, Post $post)
    // {
    //     $input_post = $request['post'];
    //     $input_post += ['uesr_id' => $request->user()->id];
    //     $post->fill($input_post)->save();
    //     return redirect('/posts/' . $post->id);
    // }
    
    // public function delete(Post $post)
    // {
    //     $post->delete();
    //     return redirect('/');
    // }
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
        // dd($request->all());
        $input = $request['post'];
        $input += ['user_id' => $request->user()->id];
        $post->fill($input)->save();
        return redirect('/posts/');
    }
    
}
