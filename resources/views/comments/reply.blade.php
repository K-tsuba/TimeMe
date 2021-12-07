<head>
    <style>
        .parent{
            border: 1px solid;
            width: 70%;
            margin: auto;
        }
        .comment{
            border: 1px solid;
            width: 90%;
            margin: auto;
            padding: 20px;
        }
        h2{
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
        .body{
            clear: both;
            width: 95%;     
            margin: auto;
        }
        .reply{
            border: 1px solid;
            width: 90%;
            margin: auto;
            padding: 20px;
        }
        .reply_box{
            text-align: center;
            /*margin: auto;*/
            /*border: 1px solid;*/
            /*display: block;*/
        }
        textarea {
            resize: vertical;
            width: 90%;
            height: 200px;
            /*text-align: center;*/
            /*display: block;*/
            /*margin: auto;*/
        }
        .reply_button{
            text-align: right;
        }
    </style>
</head>

@extends('layouts.app')
@section('content')

<div class="parent">
    <div class="comment">
        <h2>Comment</h2>
        <div class="user_name">
            <p class="">Uesr Name : {{ $comment->user->name }}</p>
        </div>
        <div class="date">
            <p class="">Date : {{ $comment->updated_at->format('Y-m-d H:i') }}</p>
        </div>
        <div class="">
            <p class="body">{{ $comment->comment }}</p>
        </div>
    </div>
    
    <div class="reply">
        <form action="/comments/reply/store/{{ $comment->id }}" method="post">
            @csrf
            <div>
                <h2>Reply</h2>
                <div class="reply_box">
                    <textarea name="reply_body" placeholder="返信記入">{{ old('reply_body') }}</textarea>
                </div>
                <p>{{ $errors->first('reply_body') }}</p>
            </div>
            <div class="reply_button">
                <input type="submit" value="返信">
            </div>
        </form>
    </div>
</div>


@endsection