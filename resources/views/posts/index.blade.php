<head>
    <style>
        .parent{
            width: 70%;
            border: 3px solid black;
            margin: auto;
            border-radius: 10px;
            /*margin: 5%;*/
            padding: 10px;
            
        }
        .clearfix::after {
            content: "";
            display: block;
            clear: both;
        }
        
        
        h1{
            float: left;
        }
        
        
        .post_question{
            float: right;
            border: 1px solid black;
            border-radius: 10px;
            font-size: 25px;
            /*padding: 5px 40px;*/
            margin-bottom: 10px;
        }
        .post_button{
            display:block;
            padding: 5px 40px;
        }
        
        
        .post_content{
            clear: both;
            /*border: solid 3px black;*/
            /*border-radius: 10px;*/
            /*margin: 5%;*/
            /*padding: 10px;*/
        }
        .posts{
            border: 3px solid black;
            border-radius: 10px;
            width: 90%;
            margin: auto;
            padding: 20px;
            margin-bottom: 10px;
            /*clear: both;*/
        }
        .user_name{
            float: left;
            margin-right: 10%;
            /*clear: both;*/
        }
        .title{
            float: left;
            margin-right: 10%;
            /*margin: auto;*/
            /*text-align: center;*/
            /*width: 200px;*/
            /*margin-left: 20px;*/
        }
        .date{
            float: left;
        }
        .edit{
            text-align: center;
            float: right;
            border: 2px solid;
            width: 56.5px;
            height: 28px;
            margin-left: 2%;
        }
        .edit_button{
            display:block;
            
        }
        .delete{
            text-align: right;
        }
        .post{
            clear: both;
            margin: 0;
        }
        .body{
            /*text-align: center;*/
            /*margin-left: 20px;*/
            margin: auto;
            padding: 0 2%;
        }
        .comment{
            margin-top: 10px;
            /*display: block;*/
            text-align: center;
            /*float: right;*/
            border: 2px solid;
            width: 70px;
            height: 28px;
        }
        .comment_button{
            display:block;
        }
        
        .links{
            margin: auto;
            width: 150px;
            
        }
        
        
        h1{
            border-bottom: solid 2px orange;
        }
        
        
    </style>
</head>
@extends('layouts.app')
@section('content')
<div class="parent clearfix">
    <h1>～アウトプット投稿/質問～</h1>
    <div class="post_question">
        <a href="/posts/create" class="post_button">投稿・質問する</a>
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
                <div class="edit">
                    <a href="/posts/{{ $post->id }}/edit" class="edit_button">edit</a>
                </div>
                <div class="delete">
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="">delete</button> 
                    </form>
                </div>
                <div>
                    <p class="post">{{ $post->content }}</p>
                    <p class="body">{{ $post->body }}</p>
                </div>
                <div class="comment">
                    <a href="/comments/{{ $post->id }}" class="comment_button">コメント</a>
                </div>
            </div>
        @endforeach
        <div class="links">
            <div>{{ $posts->links() }}</div>
        </div>
    </div>
</div>

@endsection

