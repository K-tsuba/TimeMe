<head>
    <style>
        .parent{
            border: 1px solid;
            width: 90%;
            margin: auto;
        }
        .times_list{
            border: 1px solid;
            width: 63%;
            float:left;
            min-width: 675px;
            /*padding: 20px;*/
        }
        .times_list_box{
            border: solid 3px black;
            border-radius: 10px;
            margin: 3%;
            padding: 10px;
        }
        .time_list_box{
            border: 3px solid;
            border-radius: 10px;
            width: 80%;
            margin: auto;
            margin-bottom: 10px;
            padding: 20px 20px 0 20px;
        }
        .clearfix::after {
            content: "";
            display: block;
            clear: both;
        }
        .user_name{
            font-size: 18px;
            height: 40px;
            /*width: 200px;*/
        }
        .user_name, .study_site, .date{
            float: left;
            margin-right: 5%;
            /*font-size: 15px;*/
        }
        .study_site, .date{
            font-size: 15px;
        }
        .time{
            font-size: 30px;
            /*width: 30%;*/
            clear: both;
        }
        .delete{
            text-align: right;
            /*margin-right: 50px;*/
        }
        .edit{
            text-align: center;
            float: right;
            border: 2px solid;
            width: 56.5px;
            height: 28px;
            margin-left: 2%;
            /*display:block;*/
        }
        .edit_button{
            display:block;
            
        }
        .links{
            margin: auto;
            width: 360px;
            
        }
        
        
        
        .ranking{
            border: 1px solid;
            width: 37%;
            float: left;
            min-width: 480px;
        }
        .last_week{
            
        }
        .last_week, .last_month{
            border: solid 3px black;
            border-radius: 10px;
            margin: 5%;
            padding: 10px;
        }
        th, td{
            padding: 10px;
        }
        table{
            width: 90%;
            margin-left: 10px;
            margin-bottom: 10px;
        }
        table,tr,td,th {
            border: 1px solid black;
        }
        
        
        h1, h2{
            border-bottom: solid 2px orange;
        }
        
    </style>
</head>

@extends('layouts.app')
@section('content')

<div class="parent clearfix">
    <div class="times_list">
        <div class="times_list_box">
            <h1>～学習時間一覧～</h1>
            @foreach ($times as $time)
                <div class="time_list_box">
                    <div class="user_name">
                        <p>User Name : {{ $time->user->name }}</p>
                    </div>
                    <div class="study_site">
                        <p>Study Site : {{ $time->study_site->study_title }}</p>
                    </div>
                    <div class="date">
                        <p>Date : {{ $time->updated_at }}</p>
                    </div>
                    
                    <div class="edit">
                        <a href="/times/{{ $time->id }}/edit" class="edit_button">edit</a>
                    </div>
                    <div class="delete">
                        <form action="/times/{{ $time->id }}" id="form_{{ $time->id }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="">delete</button> 
                        </form>
                    </div>
                    <div class="time">
                        <p>Time : {{ $time->time }}</p>
                    </div>
                </div>
            @endforeach
            <div class="links">
                <div>{{ $times->links() }}</div>
            </div>
        </div>
    </div>
    
    <div class="ranking">
        <div class="last_week">
            <h2>～先週の学習時間ランキング～</h2>
            <table>
                <tr>
                    <th>順位</th>
                    <th>名前</th>
                    <th>Time</th>
                </tr>
                @foreach($week_ranking as $time)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $time['user_name'] }}</td>
                    <td>{{ $time['sum'] }}</td>
                </tr>
                @endforeach
            </table>    
        </div>
        
        <div class="last_month">
            <h2>～先月の学習時間ランキング～</h2>
            <table>
                <tr>
                    <th>順位</th>
                    <th>名前</th>
                    <th>Time</th>
                </tr>
                @foreach($month_ranking as $time)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $time['user_name'] }}</td>
                    <td>{{ $time['sum'] }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
