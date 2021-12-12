<head>
    <style>
        .comment_box, .reply_box{
            border: solid 3px black;
            border-radius: 10px;
            width: 90%;
            margin: auto;
            padding: 20px;
        }
        .comment_box{
            margin-bottom: 10px;
        }
        
        .user_name{
            float: left;
            margin-right: 10%;
            margin-top: 10px;
        }
        .date{
            margin-top: 10px;
        }
        
    </style>
</head>

@extends('layouts.app')
@section('content')

<div class="mx-auto" style="width: 70%;">
    <div class="comment_box">
        <h2 class="float-left mr-5">Comment</h2>
        <div class="user_name">
            <p class="">Uesr Name : {{ $comment->user->name }}</p>
        </div>
        <div class="date">
            <p class="">Date : {{ $comment->updated_at->format('Y-m-d H:i') }}</p>
        </div>
        <div class="">
            <p class="mx-auto clearfix" style="width: 95%;">{{ $comment->comment }}</p>
        </div>
    </div>
    
    <div class="reply_box">
        <form action="/comments/reply/store/{{ $comment->id }}" method="post">
            @csrf
            <div>
                <h2 class="float-left mr-5">Reply</h2>
                <div class="text-center">
                    <textarea name="reply_body" placeholder="返信記入" style="width: 90%; height: 200px;">{{ old('reply_body') }}</textarea>
                </div>
                <p>{{ $errors->first('reply_body') }}</p>
            </div>
            <div class="text-right">
                <input type="submit" value="返信">
            </div>
        </form>
    </div>
</div>


@endsection