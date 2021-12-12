<head>
    <link href="/css/button.css" rel="stylesheet">
</head>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mx-auto p-3 border rounded bg-primary" style="width: 100%;">
        <div class="mx-auto p-3 border rounded bg-secondary" style="width: 80%;">
            <form action="/posts/store" method="post">
                @csrf
                <div>
                    <h2 class="ml-5">Post/Question</h2>
                    <div class="ml-5">
                        <label>
                            <input type="checkbox" name="post[content]" value="post">
                            Post
                        </label>
                        <label>
                            <input type="checkbox" name="post[content]" value="question">
                            Question
                        </label>
                    </div>
                    <p class="ml-5">{{ $errors->first('post.content') }}</p>
                </div>
                <div>
                    <h2 class="ml-5">Title</h2>
                    <div class="text-center">
                        <input type="text" style="width: 90%;" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                    </div>
                    <p class="ml-5">{{ $errors->first('post.title') }}</p>
                </div>
                <div class="body">
                    <h2 class="ml-5">Body</h2>
                    <div class="text-center">
                        <textarea name="post[body]" placeholder="内容記入" style="width: 90%; height: 100px;">{{ old('post.body') }}</textarea>
                    </div>
                    <p class="ml-5">{{ $errors->first('post.body') }}</p>
                </div>
                <div class="text-right">
                    <input type="submit" value="&#xf303; Post" class="fas fa-lg border-secondary rounded-pill p-2 button">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
