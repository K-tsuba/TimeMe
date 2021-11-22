@extends('layouts.app')
@section('content')

<h1>投稿する画面</h1>
<form action="/posts/store" method="post">
    @csrf
    <div>
        <h2>Title</h2>
        <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
        <p>{{ $errors->first('post.title') }}</p>
    </div>
    <div>
        <h2>Body</h2>
        <textarea name="post[body]" placeholder="内容記入">{{ old('post.body') }}</textarea>
        <p>{{ $errors->first('post.body') }}</p>
    </div>
    <input type="submit" value="投稿">
</form>
<div class="back"><a href="/">back</a></div>
@endsection
