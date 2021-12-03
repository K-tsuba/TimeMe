<head>
    <style>
        .parent{
            width: 90%;
            border: 1px solid;
            margin: auto;
        }
        .clearfix::after {
            content: "";
            display: block;
            clear: both;
        }
        
        .this_week_time{
            width: 70%;
            border: 1px solid;
            float: left;
            min-width: 600px;
        }
        .time_box{
            width: 80%;
            border: 1px solid;
            margin: auto;
        }
        .day_of_week{
            float: left;
            clear: both;
            margin-left: 20%;
            font-size: 20px;
        }
        .time{
            float: left;
            margin-left: 30px;
            font-size: 30px;
        }
        .edit{
            float: right;
            /*margin-left: 20px;*/
            /*margin-right: 20px;*/
        }
        .delete{
            text-align: right;
            /*float: left;*/
            /*margin-left: 20px;*/
            /*clear: both;*/
        }
        
        .total_time{
            float: left;
            border: 1px solid;
            width: 30%;
        }
        .all_sum{
            font-size: 50px;
            text-align: center;
        }
        
        .times_list{
            float: left;
            border: 1px solid;
            width: 30%;
        }
        table{
            width: 90%;
            /*height: 10%;*/
            margin: auto;
            /*margin-left: 10px;*/
            /*margin-bottom: 10px ;*/
            /*border-collapse: collapse;*/
            /*border: 1px solid;*/
        }
        tr,td,th{
            
        }
        table,tr,td,th {
            border: 1px solid black;
            padding: 10px;
        }
        
        .past_time{
            float: left;
            border: 1px solid;
            width: 30%;
        }
        .year{
            margin-bottom: 10px;
        }
        .year, .month{
            text-align: center;
        }
        .button{
            text-align: right;
            margin-right: 20%;
            margin-top: 10px;
        }
        .year_month{
            margin-left: 10%;
            font-size: 20px;
        }
        .past_month_sum{
            font-size: 30px;
            text-align: center;
        }
        
    </style>
</head>

@extends('layouts.app')
@section('content')
<div class="parent clearfix">
    <div>
        <h1>Study Site : {{ $own_study_site->study_title }}</h1>
    </div>
    
    
    
    <div class="this_week_time">
        <h2>今週の学習時間</h2>
        @foreach($own_study_sites as $study_site)
            <div class="time_box clearfix">
                <div class="day_of_week">{{ $week[date('w', strtotime($study_site->updated_at))] }}</div>
                <div class="time">
                    <p>Time : {{ $study_site->time }}</p>
                </div>
                <div class="edit">
                    <p>[<a href="/times/{{ $study_site->id }}/edit">edit</a>]</p>
                </div>
                <div class="delete">
                    <form action="/times/{{ $study_site->id }}" id="form_{{ $study_site->id }}" method="post" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="">delete</button> 
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="total_time">
        <h2>今までの合計時間</h2>
        <p class="all_sum">{{ $all_sum }}</p>
    </div>
    
    <div class="times_list">
        <table>
            <tr>
                <th>今週の合計時間</th>
                <th>{{ $sum_this_week }}</th>
            </tr>
            <tr>
                <th>今月の合計時間</th>
                <th>{{ $this_month_sum }}</th>
            </tr>
            <tr>
                <th>{{ $today->startOfMonth()->month }}月/第{{ $today->startOfMonth()->weekOfMonth }}週/学習時間合計</th>
                <th>{{ $first_week_sum }}</th>
            </tr>
            <tr>
                <th>{{ $today->startOfMonth()->month }}月/第{{ $today->startOfMonth()->addWeek()->weekOfMonth }}週/学習時間合計</th>
                <th>{{ $second_week_sum }}</th>
            </tr>
            <tr>
                <th>{{ $today->startOfMonth()->month }}月/第{{ $today->startOfMonth()->addWeek(2)->weekOfMonth }}週/学習時間合計</th>
                <th>{{ $third_week_sum }}</th>
            </tr>
            <tr>
                <th>{{ $today->startOfMonth()->month }}月/第{{ $today->startOfMonth()->addWeek(3)->weekOfMonth }}週/学習時間合計</th>
                <th>{{ $fourth_week_sum }}</th>
            </tr>
            <tr>
                <th>{{ $today->startOfMonth()->month }}月/第{{ $today->startOfMonth()->addWeek(4)->weekOfMonth }}週/学習時間合計</th>
                <th>{{ $fifth_week_sum }}</th>
            </tr>
        </table>
    </div>
    
    
    <div class="past_time">
        <form method="get" action="/user/{{ $own_study_site->id }}">
            @csrf
            <h3>過去の学習時間の表示</h3>
            <div class="year">
                <select name="year">
                    <option value="" selected>「年」を選択してください</option>
                    @for($i=2021; $i<2025; $i++)
                    <option value="{{ $i }}" @if(!empty($year) && $i == $year) selected @endif>{{ $i }}年</option>
                    @endfor
                </select>
            </div>
            <div class="month">
                <select name="month">
                    <option value="" selected>「月」を選択してください</option>
                    @for($i=1; $i<13; $i++)
                    <option value="{{ $i }}" @if(!empty($month) && $i == $month) selected @endif>{{ $i }}月</option>
                    @endfor
                </select>
            </div>
            <div class="button">
                <input type="submit" value="表示">
            </div>
        </form>
        
        <div>
            @if(!empty($month_sum))
                <p class="year_month">{{ $year }}年/{{ $month }}月</p>
                <p class="past_month_sum">{{ $month_sum }}</p>
            @endif
        </div>
    </div>

</div>

<div class="back"><a href="/">back</a></div>
@endsection
