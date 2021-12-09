<head>
    <style>
        .parent{
            border: 1px solid;
            width: 70%;
            margin: auto;
        }
        .post{
            border: 3px solid black;
            border-radius: 10px;
            width: 90%;
            margin: auto;
            padding: 20px;
            margin-bottom: 10px;
        }
        h2,h3{
            float: left;
            margin-right: 10%;
        }
        
        .user_name{
            float: left;
            margin-right: 10%;
            margin-top: 10px;
        }
        .date{
            margin-top: 10px;
        }
        .title{
            clear: both;
            /*float: left;*/
            /*margin-right: 20%;*/
        }
        .body{
            clear: both;
            width: 95%;     
            margin: auto;
        }
        
        
        
        
        .comment{
            border: 3px solid black;
            border-radius: 10px;
            width: 100%;
            margin: auto;
            margin-top: 10px;
            padding: 10px;
        }
        
        .comment_body{
            /*width: 95%;     */
            /*margin: auto;*/
        }
        
        
        .reply{
            border: 3px solid black;
            border-radius: 10px;
            width: 100%;
            margin: auto;
            margin-bottom: 10px;
            padding: 20px;
        }
        
        
        
        
        .comment_box{
            text-align: center;
            /*margin: auto;*/
            /*border: 1px solid;*/
            /*display: block;*/
        }
        
        textarea {
            resize: vertical;
            width: 90%;
            height: 100px;
            /*text-align: center;*/
            /*display: block;*/
            /*margin: auto;*/
        }
        .comment_form{
            border: 3px solid black;
            border-radius: 10px;
            width: 90%;
            margin: auto;
            padding: 20px;
        }
        .error{
            margin-left: 3%;
        }
    </style>
</head>

@extends('layouts.app')
@section('content')

<div class="parent">
    <div class="post">
        <h2>～Post～</h2>
        <div class="user_name">
            <p class="">Uesr Name : {{ $post->user->name }}</p>
        </div>
        <div class="date">
            <p class="">Date : {{ $post->updated_at->format('Y-m-d H:i') }}</p>
        </div>
        <div class="title">
            <p class="">Title : {{ $post->title }}</p>
        </div>
        <div class="">
            <p class="body">{{ $post->body }}</p>
        </div>
        
        
        @if(!empty($comments))
            <div class="comment">
                @foreach($comments as $comment)
                    <h2>～Comment～</h2>
                    <div class="user_name">
                        <p class="">Uesr Name : {{ $comment->user->name }}</p>
                    </div>
                    <div class="date">
                        <p class="">Date : {{ $comment->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
                    <div class="">
                        <p class="body">{{ $comment->comment }}</p>
                    </div>
                    
                    
                    <p><a href="/comments/reply/{{ $comment->id }}">Reply</a></p>
                    
                    @if(!is_null($comment->replies))
                    
                        @foreach($comment->replies as $reply)
                            <div class="reply">
                                <h3>～Reply～</h3>
                                <div class="user_name">
                                    <p class="">Uesr Name : {{ $reply->user->name }}</p>
                                </div>
                                <div class="date">
                                    <p class="">Date : {{ $reply->updated_at->format('Y-m-d H:i') }}</p>
                                </div>
                                <div class="">
                                    <p class="body">{{ $reply->reply }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach 
            </div>
        
            
        @endif
        
        
    </div>
    
    
    
    
    
    
    <div class="comment_form">
        <form action="/comments/store/{{ $post->id }}" method="post">
            @csrf
            <div>
                <h2>～Comment Form～</h2>
                <div class="comment_box">
                    <textarea name="comment_body" placeholder="コメント記入">{{ old('comment_body') }}</textarea>
                </div>
                <p class="error">{{ $errors->first('comment_body') }}</p>
            </div>
            <input type="submit" value="コメント">
        </form>
    </div>
</div>

@endsection