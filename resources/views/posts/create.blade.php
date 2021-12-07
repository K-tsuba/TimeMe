<head>
    <script>
        var token = document.getElementsByName('csrf-token').item(0).content;
        var request = new XMLHttpRequest();
        
        request.open('post', '/posts/create', true);
        request.responseType = 'json';
        request.setRequestHeader('X-CSRF-Token', token);
        request.onload = function(){
            var data = this.response;
            console.log(data);
        };
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.send("status=stop");
    
    
        // var xhr = new XMLHttpRequest();
        // xhr.open("post", "/posts/create");
        // xhr.responseType = 'json';
        // xhr.onreadystatechange  = function (e) {
        //   if (xhr.readyState === 4) {
        //     if (xhr.status === 200) {
        //         console.log(request.responseText);
        //     } else {
        //         console.error(request.statusText);
        //     }
        //   }
        // };
        /*
        xhr.send("status");
        */

        /*
        var request = new XMLHttpRequest();

        request.open('post', '/posts/create', true);
        request.responseType = 'json';
        request.onload = function () {
            
            if (request.readyState === 4) {
                if (request.status === 200) {
                    console.log(request.responseText);
                } else {
                    console.error(request.statusText);
                }
            }
        };
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        
        request.send("status=1");
        console.log(request.send("status=1"));
        */
        
        
    </script>
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
@endsection
