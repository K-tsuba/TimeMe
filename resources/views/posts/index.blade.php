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
        <div>
            {{Auth::user()->name}}
        </div>
        <h1>Blog Name</h1>
        [<a href='/posts/create'>create</a>]
        <div class='posts'>
            @foreach ($posts as $post)
            <div class='post'>
                <a href='/posts/{{ $post->id }}'><h2 class='title'>{{ $post->title }}</h2></a>
                <small>{{ $post->user->name }}</small>
                <p class='body'>{{ $post->body }}</p>
            </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        @endsection
    </body>
</html>
