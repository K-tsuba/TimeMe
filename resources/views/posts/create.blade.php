<head>
    <style>
        .parent{
            border: 1px solid;
            margin: auto;
            width: 70%;
        }
        .post_form{
            border: 1px solid;
            width: 90%;
            margin: auto;
            padding: 20px;
        }
        h2, .error{
            margin-left: 3%;
        }
        .title_box, .post_box{
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
        .post_button{
            text-align: right;
        }
    </style>
</head>

@extends('layouts.app')
@section('content')

<div class="parent">
    <div class="post_form">
        <h1>投稿する画面</h1>
        <form action="/posts/store" method="post">
            @csrf
            <div>
                <h2>Title</h2>
                <div class="title_box">
                    <input type="text" class="title" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                </div>
                <p class="error">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <div class="post_box">
                    <textarea name="post[body]" placeholder="内容記入">{{ old('post.body') }}</textarea>
                </div>
                <p class="error">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="post_button">
                <input type="submit" value="投稿">
            </div>
        </form>
    </div>
</div>
<div class="back"><a href="/">back</a></div>
@endsection
