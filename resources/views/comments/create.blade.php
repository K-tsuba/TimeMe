@extends('layouts.app')
@section('content')
<h1>コメント画面</h1>
<div>
    <form action="/comments/store" method="post">
        <!--<div>-->
        <!--    <input type="hidden" name="post_id" value="{{-- $post->id --}}">-->
        <!--</div>-->
        <div>
            <h2>Body</h2>
            <textarea name="comment" placeholder="コメント記入">{{ old('comment.body') }}</textarea>
            <p>{{ $errors->first('comment.body') }}</p>
        </div>
        <input type="submit" value="コメント">
    </form>
</div>
<div class="back"><a href="/">back</a></div>
@endsection