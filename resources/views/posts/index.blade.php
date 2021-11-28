<head>
    <style>
        /*.post{*/
            /*text-align: center;*/
        /*}*/
        /*.user_name{*/
        /*    float: left;*/
    </style>
</head>
@extends('layouts.app')
@section('content')
<div class="container-fluid mx-auto">
    <h1>アウトプット投稿・質問</h1>
    <div class="text-center">
        @foreach($posts as $post)
            <div class="border" style="">
                <div class="row">
                    <div class="col-2">
                        <p class="user_name">Uesr Name:{{ $post->user->name }}</p>
                    </div>
                    <div class="col-2">
                        <p class="post_title">Title:{{ $post->title }}</p>
                    </div>
                </div>
                <div>
                    <p class="post_body">Post:{{ $post->body }}</p>
                </div>
                <div>
                    <p><a href="/comments/{{ $post->id }}">コメント</a></p>
                </div>
            </div>
        @endforeach
    </div>
</div>
<a href="/posts/create">投稿・質問画面</a>
<!--<a href="/comments/create">コメントする</a>-->

@endsection

