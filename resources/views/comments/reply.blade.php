<head>
    <link href="/css/comment.css" rel="stylesheet">
    <link href="/css/button.css" rel="stylesheet">
</head>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mb-4 border rounded bg-primary">
        <h1>～Reply～</h1>
        <div class="mx-auto my-3" style="width: 80%;">
            <div class="border rounded bg-secondary p-3 mb-3">
                <h2 class="float-left mr-5">Comment</h2>
                <div class="float-left mr-3 user_name">
                    <p class="">Uesr Name : {{ $comment->user->name }}</p>
                </div>
                <div class="float-left mt-1 date">
                    <p class="">Date : {{ $comment->updated_at->format('Y-m-d H:i') }}</p>
                </div>
                <div class="body">
                    <p class="mx-auto" style="width: 95%;">{{ $comment->comment }}</p>
                </div>
            </div>
        </div>
        <div class="mx-auto my-3" style="width: 80%;">
            <div class="border rounded bg-secondary p-3 mb-3">
                <form action="/comments/reply/store/{{ $comment->id }}/{{ $comment->post_id }}" method="post">
                    @csrf
                    <div>
                        <h2 class="float-left mr-5">Reply</h2>
                        <div class="text-center">
                            <textarea name="reply_body" placeholder="返信記入" style="width: 90%; height: 200px;">{{ old('reply_body') }}</textarea>
                        </div>
                        <p class="ml-5">{{ $errors->first('reply_body') }}</p>
                    </div>
                    <div class="text-right">
                        <input type="submit" value="&#xf3e5; reply" class="fas border-secondary rounded-pill p-2 button">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection