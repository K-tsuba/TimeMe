<head>
    <style>
        .parent{
            border: 1px solid;
            width: 70%;
            margin: auto;
        }
        .edit_form{
            border: 1px solid;
            width: 90%;
            margin: auto;
            padding: 20px;
        }
        h2, .error{
            margin-left: 3%;
        }
        .title_box, .body_box{
            text-align: center;
        }
        .title{
            width: 90%;
        }
        textarea {
            resize: vertical;
            width: 90%;
            height: 100px;
            /*text-align: center;*/
            /*display: block;*/
            /*margin: auto;*/
        }
        .save_button{
            text-align: right;
        }
    </style>
</head>

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mx-auto p-3 border rounded bg-primary" style="width: 100%;">
        <div class="mx-auto p-3 border rounded bg-secondary" style="width: 80%;">
            <!--<h1 class="title">編集画面</h1>-->
            <!--<div class="content">-->
                <form action="/posts/{{ $post->id }}" method="post">
                    @csrf
                    @method('put')
                    <div>
                        <h2 class="ml-5">Post/Question</h2>
                        <div class="ml-5">
                            <label>
                                <input type="checkbox" name="post[content]" value="{{ $post->content }}" @if (!empty($post->content == 'post')) checked @endif>
                                Post
                            </label>
                            <label>
                                <input type="checkbox" name="post[content]" value="{{ $post->content }}" @if (!empty($post->content == 'question')) checked @endif>
                                Question
                            </label>
                        </div>
                    </div>
                    <div>
                        <h2 class="ml-5">Title</h2>
                        <div class='title_box'>
                            <input type='text' class="title" name='post[title]' value="{{ $post->title }}">
                        </div>
                    </div>
                    <div>
                        <h2 class="ml-5">Body</h2>
                        <div class='body_box'>
                            <textarea name="post[body]" placeholder="">{{ $post->body }}</textarea>
                        </div>
                    </div>
                    <div class="text-right mt-3" style="width: 100%;">
                        <input type="submit" value="&#xf00c; save" class="fas fa-lg p-2 rounded-pill bg-secondary">
                    </div>
                </form>
            <!--</div>-->
        </div>
    </div>
</div>
@endsection

