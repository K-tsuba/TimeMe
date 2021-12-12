@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mx-auto p-3 border rounded bg-primary" style="width: 100%;">
        <div class="mx-auto p-3 border rounded bg-secondary" style="width: 80%;">
            <div class="content">
                <form action="/comments/{{ $comment->id }}" method="post">
                    @csrf
                    @method('put')
                    <h2 class="mb-3">Comment</h2>
                    <div class='text-center'>
                        <textarea name="comment" placeholder="" style="width: 90%; height: 100px;">{{ $comment->comment }}</textarea>
                    </div>
                    <p class="ml-5">{{ $errors->first('comment_body') }}</p>
                    <div class="text-right mt-3" style="width: 100%;">
                        <input type="submit" value="&#xf00c; save" class="fas fa-lg p-2 rounded-pill bg-secondary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection