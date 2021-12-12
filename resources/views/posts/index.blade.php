<head>
    <link href="/css/post.css" rel="stylesheet">
    <link href="/css/button.css" rel="stylesheet">
</head>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mx-auto p-3 border rounded bg-primary" style="width: 100%;">
        <h1 class="float-left">～アウトプット投稿/質問～</h1>
        <div class="mb-3 border border-secondary rounded-pill float-right button_post">
            <a href="/posts/create" class="d-block py-2 px-5 text-white fa-2x"><i class="fas fa-pencil-alt"></i> 投稿・質問する</a>
        </div>
        <div class="post_content">
            @foreach($posts as $post)
                <div class="border rounded mx-auto mb-3 p-3 bg-secondary" style="width: 80%;">
                    <div class="float-left mr-3 user_name">
                        <p class="">Uesr Name : {{ $post->user->name }}</p>
                    </div>
                    <div class="float-left mr-3 mt-1 title">
                        <p class="">Title : {{ $post->title }}</p>
                    </div>
                    <div class="float-left mt-1 mr-2 date">
                        <p class="" >Date : {{ $post->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
                    <div class="float-right mt-1">
                        <a href="/posts/{{ $post->id }}/edit" class="d-block"><i class="fas fa-edit fa-lg" ></i></a>
                    </div>
                    <div class="text-right">
                        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onClick="delete_post({{ $post->id}})" class="btn btn-secondary"><i class="fas fa-trash-alt fa-lg"></i></button> 
                        </form>
                    </div>
                    <div>
                        @if($post->content == 'post')
                            <p class="m-0 post">Post</p>
                        @else($post->content == 'question')
                            <p class="m-0 post"><i class="far fa-question-circle"></i> Question</p>
                        @endif
                        <p class="mx-auto my-2 px-3 h5">{{ $post->body }}</p>
                    </div>
                    <div class="border-secondary rounded-pill p-1 button" style="width: 95px; ">
                        <a href="/comments/{{ $post->id }}" class="d-block"><i class="far fa-comment-dots"></i> Comment</a>
                    </div>
                </div>
            @endforeach
            <div class="mx-auto mt-3" style="width: 150px;">
                <div>{{ $posts->links() }}</div>
            </div>
        </div>
    </div>
</div>
<script>
    function delete_post($id){
        if (window.confirm('本当に削除しますか？')){
            document.getElementById('form_'.$id).submit();
        } else {
            window.alert('削除がキャンセルされました。');
            event.preventDefault();
        }
    }
</script>
@endsection

