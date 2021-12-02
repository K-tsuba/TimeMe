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
<div class="parent">
    <div class="edit_form">
        <h1 class="title">編集画面</h1>
        <div class="content">
            <form action="/posts/{{ $post->id }}" method="post">
                @csrf
                @method('put')
                <div>
                    <h2>Title</h2>
                    <div class='title_box'>
                        <input type='text' class="title" name='post[title]' value="{{ $post->title }}">
                    </div>
                </div>
                <h2>Body</h2>
                <div class='body_box'>
                    <textarea name="post[body]" placeholder="">{{ $post->body }}</textarea>
                </div>
                <div class="save_button">
                    <input type="submit" value="保存">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="back">{<a href="/">back</a>}</div>
@endsection

