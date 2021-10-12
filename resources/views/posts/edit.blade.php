<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blog</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        
    </head>
    <body>
        @extends('layouts.app')
        @section('content')
        <h1 class="title">編集画面</h1>
        <div class="content">
            <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class='content__title'>
                    <h2>タイトル</h2>
                    <input type='text' name='post[title]' value="{{ $post->title }}">
                </div>
                <div class='content__body'>
                    <h2>本文</h2>
                    <input type='text' name='post[body]' value="{{ $post->body }}">
                </div>
                <input type="submit" value="保存">
            </form>
            <div class="back">{<a href="/">back</a>}</div>
        </div>
        @endsection
        
        
        <!--<h1>Blog Name</h1>-->
        <!--<form action="/posts" method="POST">-->
        <!--    @csrf-->
        <!--    <div class="title">-->
        <!--        <h2>Title</h2>-->
        <!--        <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>-->
        <!--        <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>-->
        <!--    </div>-->
        <!--    <div class="body">-->
        <!--        <h2>Body</h2>-->
        <!--        <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>-->
        <!--        <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>-->
        <!--    </div>-->
        <!--    <input type="submit" value="保存"/>-->
        <!--</form>-->
        <!--<div class="back">[<a href="/">back</a>]</div>-->
    </body>
</html>
