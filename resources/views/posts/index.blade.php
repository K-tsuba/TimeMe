<head>
    <style>
        .parent{
            width: 70%;
            border: 1px solid;
            margin: auto;
        }
        h1{
            float: left;
        }
        .post_question{
            float: right;
        }
        .post_content{
            clear: both;
        }
        .posts{
            border: 1px solid;
            width: 90%;
            margin: auto;
            padding: 20px;
        }
        .user_name{
            float: left;
            margin-right: 20%;
        }
        .title{
            float: left;
            margin-right: 20%;
            /*margin: auto;*/
            /*text-align: center;*/
            /*width: 200px;*/
            /*margin-left: 20px;*/
        }
        .post{
            /*clear: both;*/
        }
        .body{
            margin-left: 20px;
        }
        /*.post{*/
            /*text-align: center;*/
        /*}*/
        /*.user_name{*/
        /*    float: left;*/
    </style>
</head>
@extends('layouts.app')
@section('content')
<div class="parent">
    <h1>アウトプット投稿/質問</h1>
    <div class="post_question">
        <a href="/posts/create">投稿・質問する</a>
    </div>
    <div class="post_content">
        @foreach($posts as $post)
            <div class="posts" style="">
                <div class="">
                    <div class="user_name">
                        <p class="">Uesr Name : {{ $post->user->name }}</p>
                    </div>
                    <div class="title">
                        <p class="">Title : {{ $post->title }}</p>
                    </div>
                    <div class="date">
                        <p class="">Date : {{ $post->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
                <div>
                    <p class="post">Post</p>
                    <p class="body">{{ $post->body }}</p>
                </div>
                <div class="edit">
                    <p>[<a href="/posts/{{ $post->id }}/edit">edit</a>]</p>
                </div>
                <div class="delete">
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="">delete</button> 
                    </form>
                </div>
                <div>
                    <p><a href="/comments/{{ $post->id }}">コメント</a></p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

