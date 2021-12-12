<head>
    <style>
        .post_content{
            clear: both;
        }
        .user_name{
            float: left;
            margin-right: 10%;
        }
        .title{
            float: left;
            margin-right: 10%;
        }
        .date{
            float: left;
        }
        
        .post{
            clear: both;
            margin: 0;
            color: white;
        }
        
    
        h1{
            border-bottom: solid 2px black;
        }
        
        
    </style>
</head>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mx-auto p-3 border rounded bg-primary" style="width: 100%;">
        <h1 class="float-left">～アウトプット投稿/質問～</h1>
        <div class="mb-3 border rounded-pill float-right bg-secondary">
            <a href="/posts/create" class="d-block py-2 px-5 text-white fa-2x"><i class="fas fa-pencil-alt"></i> 投稿・質問する</a>
        </div>
        <div class="post_content">
            @foreach($posts as $post)
                <div class="border rounded mx-auto mb-3 p-3 bg-secondary" style="width: 80%;">
                    <div class="user_name">
                        <p class="">Uesr Name : {{ $post->user->name }}</p>
                    </div>
                    <div class="title">
                        <p class="">Title : {{ $post->title }}</p>
                    </div>
                    <div class="date">
                        <p class="" >Date : {{ $post->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
                    <div class="float-right mt-1">
                        <a href="/posts/{{ $post->id }}/edit" class="d-block"><i class="fas fa-edit fa-lg" ></i></a>
                    </div>
                    <div class="text-right">
                        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary"><i class="fas fa-trash-alt fa-lg"></i></button> 
                        </form>
                    </div>
                    <div>
                        @if($post->content == 'post')
                            <p class="post">Post</p>
                        @else($post->content == 'question')
                            <p class="post"><i class="far fa-question-circle"></i> Question</p>
                        @endif
                        <p class="mx-auto my-2 px-3 h5">{{ $post->body }}</p>
                    </div>
                    <div class="border rounded-pill p-1" style="width: 95px; ">
                        <a href="/comments/{{ $post->id }}" class="d-block"><i class="far fa-comment-dots"></i> Comment</a>
                    </div>
                </div>
            @endforeach
            <div class="mx-auto mt-3" style="width: 150px;">
                <div>{{ $posts->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

