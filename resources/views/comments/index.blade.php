<head>
    <style>
        
        .user_name{
            float: left;
            margin-right: 10%;
            /*margin-right: 10%;*/
            /*margin-top: 10px;*/
        }
        .date{
            float: left;
            /*margin-top: 10px;*/
        }
        .title{
            float: left;
        }
        .body{
            clear: both;
        }
        
        
        /*.comment_box, .reply_box{*/
        /*    border: 1px solid black;*/
        /*    border-radius: 10px;*/
        /*    width: 100%;*/
        /*    margin: auto;*/
        /*    margin-top: 10px;*/
        /*    padding: 10px;*/
        /*}*/
    
        
        .comment_form{
            border: 1px solid black;
            border-radius: 10px;
            width: 100%;
            margin: auto;
            padding: 20px;
        }
    </style>
</head>

@extends('layouts.app')
@section('content')
<div class="container"> 
    <!--<div class="mx-auto" style="width: 70%;">-->
        <div class="mb-4 border rounded bg-primary">
            <h1>～Comment～</h1>
            <div class="mx-auto my-3" style="width: 80%;">
                <h2 class="float-left mr-5">～Post～</h2>
                <div class="user_name">
                    <p class="">Uesr Name : {{ $post->user->name }}</p>
                </div>
                <div class="title">
                    <p class="">Title : {{ $post->title }}</p>
                </div>
                <div class="date">
                    <p class="">Date : {{ $post->updated_at->format('Y-m-d H:i') }}</p>
                </div>
                <div class="body">
                    <p class="mx-auto" style="width: 95%;">{{ $post->body }}</p>
                </div>
                
                
                @if(!is_null($comments))
                        @foreach($comments as $comment)
                            <div class="border rounded bg-secondary p-3 mb-3">
                                <h2 class="float-left mr-5">～Comment～</h2>
                                <div class="user_name">
                                    <p class="">Uesr Name : {{ $comment->user->name }}</p>
                                </div>
                                <div class="date">
                                    <p class="">Date : {{ $comment->updated_at->format('Y-m-d H:i') }}</p>
                                </div>
                                <div class="float-right mt-2">
                                    <a href="/comments/{{ $comment->id }}/edit" class="d-block"><i class="fas fa-edit fa-lg" ></i></a>
                                </div>
                                <div class="text-right">
                                    <form action="/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary mt-1"><i class="fas fa-trash-alt fa-lg"></i></button> 
                                    </form>
                                </div>
                                <div class="body">
                                    <p class="mx-auto" style="width: 95%;">{{ $comment->comment }}</p>
                                </div>
                                <div class="border rounded-pill p-1 mb-3" style="width: 75px; ">
                                    <a href="/comments/reply/{{ $comment->id }}"><i class="fas fa-reply"></i> Reply</a>
                                </div>
                                
                                @if(!is_null($comment->replies))
                                    @foreach($comment->replies as $reply)
                                        <div class="p-3 border rounded bg-primary">
                                            <h3 class="float-left mr-5">～Reply～</h3>
                                            <div class="user_name">
                                                <p class="">Uesr Name : {{ $reply->user->name }}</p>
                                            </div>
                                            <div class="date">
                                                <p class="">Date : {{ $reply->updated_at->format('Y-m-d H:i') }}</p>
                                            </div>
                                            <div class="float-right mt-1 mr-2">
                                                <a href="/reply/{{ $post->id }}/{{ $reply->id }}/edit" class="d-block"><i class="fas fa-edit fa-2x bg-secondary" ></i></a>
                                            </div>
                                            <div class="text-right">
                                                <form action="/reply/{{ $post->id }}/{{ $reply->id }}" id="form_{{ $reply->id }}" method="post" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary mt-1"><i class="fas fa-trash-alt fa-lg"></i></button> 
                                                </form>
                                            </div>
                                            <div class="body">
                                                <p class="mx-auto" style="width: 95%;">{{ $reply->reply }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach 
                    
                @else(empty($comments))
                    <div></div>
                @endif
            </div>
        </div>
        
        <div class="border rounded bg-primary">
            <form action="/comments/store/{{ $post->id }}" method="post">
                @csrf
                <div class="mx-auto pt-2" style="width: 80%;">
                    <h2 class="">～Comment Form～</h2>
                    <div class="text-center">
                        <textarea name="comment_body" placeholder="コメント記入" style="width: 90%; height: 100px;">{{ old('comment_body') }}</textarea>
                    </div>
                    <p class="ml-5">{{ $errors->first('comment_body') }}</p>
                    <div class="text-right">
                        <input type="submit" value="&#xf075; comment" class="fas rounded-pill p-2 bg-secondary">
                    </div>
                </div>
            </form>
        </div>
    <!--</div>-->
</div>
@endsection