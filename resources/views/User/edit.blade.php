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
        .button{
            background: #ADC2A9;
            color: #D3E4CD;
            <!--border:none;-->
            cursor:pointer;
        }
        .button:hover{
            background: #D3E4CD;
            color: #ADC2A9;
        }
    </style>
</head>

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mx-auto p-3 border rounded bg-primary" style="width: 100%;">
        <div class="mx-auto p-3 border rounded bg-secondary" style="width: 80%;">
            <h1 class="mx-auto" style="width: 83%;">Edit Time</h1>
            <form action="/user/{{ $time->id }}" method="post">
                @csrf
                @method('put')
                <div class="time_box">
                    <input type='time' class="time"　name='time' value="{{ $time->time }}">
                </div>
                <div class="text-right mt-3" style="width: 83%;">
                    <input type="submit" value="&#xf00c; save" class="fas fa-lg p-2 border-secondary rounded-pill button">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection