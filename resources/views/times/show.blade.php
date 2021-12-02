<head>
    <style>
        .parent{
            border: 1px solid;
            width: 90%;
            margin: auto;
        }
        .times_list{
            border: 1px solid;
            width: 70%;
            float:left;
        }
        .time_contents{
            border: 1px solid;
            width: 80%;
            margin: auto;
            padding: 20px;
            /*height: 20%;*/
        }
        .clearfix::after {
            content: "";
            display: block;
            clear: both;
        }
        .user_name{
            /*clear: both;*/
        }
        .user_name, .study_site, .date{
            float: left;
            margin-right: 10%;
        }
        .time{
            /*float: left;*/
            width: 30%;
            clear: both;
            /*float: left;*/
        }
        .delete{
            /*width: 50px;*/
            text-align: right;
            /*float: right;*/
            margin-right: 50px;
            /*margin-bottom: 10px;*/
        }
        .edit{
            /*text-align: right;*/
            float: right;
        }
        .ranking{
            border: 1px solid;
            width: 30%;
            float: left;
        }
        th, td{
            padding: 10px;
            /*border: 1px solid;*/
        }
        table{
            width: 90%;
            margin-left: 10px;
            margin-bottom: 10px;
            /*border-collapse: collapse;*/
            /*border: 1px solid;*/
        }
        table,tr,td,th {
          border: 1px solid black;
        }
    </style>
</head>

@extends('layouts.app')
@section('content')

<div class="parent clearfix">
    <div class="times_list">
        <h1>学習時間一覧</h1>
        <div class="">
            @foreach ($times as $time)
                <div class="time_contents">
                    <div class="user_name">
                        <p>User Name : {{ $time->user->name }}</p>
                    </div>
                    <div class="study_site">
                        <p>Study Site : {{ $time->study_site->study_title }}</p>
                    </div>
                    <div class="date">
                        <p>Date : {{ $time->updated_at }}</p>
                    </div>
                    <div class="time">
                        <p>Time : {{ $time->time }}</p>
                    </div>
                    <div class="edit">
                        <p>[<a href="/times/{{ $time->id }}/edit">edit</a>]</p>
                    </div>
                    <div class="delete">
                        <form action="/times/{{ $time->id }}" id="form_{{ $time->id }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="">delete</button> 
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <div class="ranking">
        <h2>先週の学習時間ランキング</h2>
        <table>
            <tr>
                <th>順位</th>
                <th>名前</th>
                <th>Time</th>
            </tr>
            @foreach($week_ranking as $time)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>名前</td>
                <td>{{ $time['sum'] }}</td>
            </tr>
            @endforeach
        </table>
        
        <h2>先月の学習時間ランキング</h2>
        <table>
            <tr>
                <th>順位</th>
                <th>名前</th>
                <th>Time</th>
            </tr>
            @foreach($month_ranking as $time)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>名前</td>
                <td>{{ $time['sum'] }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="back">{<a href="/">back</a>}</div>
@endsection
