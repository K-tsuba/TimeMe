@extends('layouts.app')
@section('content')

<div>
    {{Auth::user()->name}}
</div>
<div>
    <h2>Post</h2>
    <small>User name   {{ $post->user->name }}</small>
    <p>Title   {{ $post->title }}</p>
    <p>Post   {{ $post->body }}</p>
</div>

<div>
    @foreach($comments as $comment)
        <div>
            <p>User name   {{ $comment->user->name }}</p>
            <p>Comment   {{ $comment->comment }}</p>
        </div>
        
        <!--<form action="/comments/reply/store/{{-- $comment->id --}}" method="post">-->
        <!--    <input type="submit" value="返信">-->
        <!--</form>-->
        
        <p><a href="/comments/reply/{{ $comment->id }}">返信</a></p>
        
        @if(!is_null($comment->replies))
        
            @foreach($comment->replies as $reply)
                <div>
                    <p>返信内容</p>
                    <p>{{ $reply->reply }}</p>
                </div>
            @endforeach
        @endif
    @endforeach 
</div>
<!--<div>-->
<!--        <div>-->
<!--            <p>Reply</p>-->
<!--            <p>User name   {{-- $reply->user->name --}}</p>-->
<!--            <p>Reply   {{-- $reply->reply --}}</p>-->
<!--        </div>-->
<!--</div>-->


<div>
    <form action="/comments/store/{{ $post->id }}" method="post">
        @csrf
        <div>
            <input type="hidden" name="post_id" value="{{-- $post->id --}}">
        </div>
        <div>
            <h2>コメント</h2>
            <textarea name="comment_body" placeholder="コメント記入">{{ old('comment_body') }}</textarea>
            <p>{{ $errors->first('comment_body') }}</p>
        </div>
        <input type="submit" value="コメント">
    </form>
</div>
<a href="/posts">投稿・質問画面</a>
<div class="back"><a href="/">back</a></div>

@endsection