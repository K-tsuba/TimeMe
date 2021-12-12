<head>
    <link href="/css/button.css" rel="stylesheet">
</head>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mx-auto p-3 border rounded bg-primary" style="width: 100%;">
        <div class="mx-auto p-3 border rounded bg-secondary" style="width: 80%;">
            <div class="content">
                <form action="/reply/{{ $post_id }}/{{ $reply->id }}" method="post">
                    @csrf
                    @method('put')
                    <h2 class="mb-3">Reply</h2>
                    <div class='text-center'>
                        <textarea name="reply" placeholder="" style="width: 90%; height: 100px;">{{ $reply->reply }}</textarea>
                    </div>
                    <p class="ml-5">{{ $errors->first('reply_body') }}</p>
                    <div class="text-right mt-3" style="width: 100%;">
                        <input type="submit" value="&#xf00c; save" class="fas fa-lg p-2 border-secondary rounded-pill button">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection