<head>
    <link href="/css/button.css" rel="stylesheet">
</head>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mx-auto p-3 border rounded bg-primary" style="width: 100%;">
        <div class="mx-auto p-3 border rounded bg-secondary" style="width: 80%;">
            <form action="/posts/{{ $post->id }}" method="post">
                @csrf
                @method('put')
                <div>
                    <h2 class="ml-5">Post/Question</h2>
                    <div class="ml-5">
                        <label>
                            <input type="checkbox" name="post[content]" value="{{ $post->content }}" @if (!empty($post->content == 'post')) checked @endif>
                            Post
                        </label>
                        <label>
                            <input type="checkbox" name="post[content]" value="{{ $post->content }}" @if (!empty($post->content == 'question')) checked @endif>
                            Question
                        </label>
                    </div>
                    <p class="ml-5">{{ $errors->first('post.content') }}</p>
                </div>
                <div>
                    <h2 class="ml-5">Title</h2>
                    <div class='text-center'>
                        <input type='text' style="width: 90%;" name='post[title]' value="{{ $post->title }}">
                    </div>
                    <p class="ml-5">{{ $errors->first('post.title') }}</p>
                </div>
                <div>
                    <h2 class="ml-5">Body</h2>
                    <div class='text-center'>
                        <textarea name="post[body]" placeholder="" style="width: 90%; height: 100px;">{{ $post->body }}</textarea>
                    </div>
                    <p class="ml-5">{{ $errors->first('post.body') }}</p>
                </div>
                <div class="text-right mt-3" style="width: 100%;">
                    <input type="submit" value="&#xf00c; save" class="fas fa-lg p-2 border-secondary rounded-pill button">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

