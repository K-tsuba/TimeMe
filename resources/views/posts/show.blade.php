{{--
@extends('layouts.app')
@section('content')
<h1>Blog Name</h1>
<p class="edit">[<a href="/posts/{{ $post->id }}/edit">edit</a>]</p>
<form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit">[<span onclick="return deletePost(this);">delete</span>]</button>
</form>
<div class='post'>
    <h2 class='title'>{{ $post->title }}</h2>
    <small>{{ $post->user->name }}</small>
    <p class='body'>{{ $post->body }}</p>
    <p class='updated_at'>{{ $post->updated_at }}</p>
</div>
<div class="back">{<a href="/">back</a>}</div>
<script>
   function deletePost(e){
       'use strict';
       if (confirm('復元することはできません。\n本当に削除しますか？')){
           document.getElementbyld('form_delete').submit();
       }
   }
</script>
@endsection
--}}
@extends('layouts.app')
@section('content')



@endsection
