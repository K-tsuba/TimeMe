@extends('layouts.app')
@section('content')

<div>
    {{Auth::user()->name}}
</div>
<div>
    <h2>Comment</h2>
    <small>User name   {{ $comment->user->name }}</small>
    <p>{{ $comment->comment }}</p>
</div>

<div>
    <form action="/comments/reply/store/{{ $comment->id }}" method="post">
        @csrf
        <div>
            <h2>返信</h2>
            <textarea name="reply_body" placeholder="返信記入">{{ old('reply_body') }}</textarea>
            <p>{{ $errors->first('reply_body') }}</p>
        </div>
        <input type="submit" value="返信">
    </form>
</div>
<div class="back"><a href="/">back</a></div>

@endsection