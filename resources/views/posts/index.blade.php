<head>
    <style>
        .post{
            /*text-align: center;*/
        }
        .user_name{
            float: left;
    </style>
</head>
@extends('layouts.app')
@section('content')

<h1>アウトプット投稿・質問画面</h1>
<div class="post">
    @foreach($posts as $post)
        <div >
            <p class="user_name">Uesr Name:{{ $post->user->name }}</p>
            <p class="post_title">Title:{{ $post->title }}</p>
            <p class="post_body">Post:{{ $post->body }}</p>
            <p><a href="/comments/{{ $post->id }}">コメント</a></p>
        </div>
    @endforeach
</div>

<a href="/posts/create">投稿・質問画面</a>
<!--<a href="/comments/create">コメントする</a>-->

@endsection

