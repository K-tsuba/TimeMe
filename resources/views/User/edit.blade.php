<head>
    <style>
        .parent{
            border: 1px solid;
            width: 60%;
            margin: auto;
        }
        .time_box{
            text-align: center;
        }
        .time{
            width: 60%;
            height: 20%;
            text-align: center;
            font-size: 50px;
        }
        .save_button{
            text-align: right;
            margin-right: 20%;
            margin-top: 10px;
        }
    </style>
</head>

@extends('layouts.app')
@section('content')
<div class="parent">
    <h1>学習時間編集画面</h1>
    <form action="/user/{{ $time->id }}" method="post">
        @csrf
        @method('put')
        <div class="time_box">
            <input type='time' class="time"　name='time' value="{{ $time->time }}">
        </div>
        <div class="save_button">
            <input type='submit' value="save">
        </div>
    </form>
</div>
@endsection