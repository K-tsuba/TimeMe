{{--
@extends('layouts.app')

@section('content')
<div>
    {{Auth::user()->name}}
</div>
<h1>Blog Name</h1>
[<a href='/posts/create'>create</a>]
<div class='own_posts'>
    @foreach ($own_posts as $post)
    <div class='post'>
        <a href='/posts/{{ $post->id }}'><h2 class='title'>{{ $post->title }}</h2></a>
        <small>{{ $post->user->name }}</small>
        <p class='body'>{{ $post->body }}</p>
    </div>
    @endforeach
</div>
<div class='paginate'>
    {{ $own_posts->links() }}
</div>
@endsection

<div>
    @foreach($questions as $question)
        <div>{{ $question['title'] }}</div>
    @endforeach
</div>

<div>
    @foreach($questions as $question)
        <div>
            <a href="https://teratail.com/questions/{{ $question['id'] }}" >
                {{ $question['title'] }}
            </a>
        </div>
    @endforeach
</div>
--}}
@extends('layouts.app')
@section('content')

<h1>アウトプット投稿・質問画面</h1>
<p>ユーザー名</p>
<p>投稿・質問タイトル</p>
<p>詳細画面</p>

@endsection

