<head>
    <style>
        .parent{
            width: 90%;
            /*height: 100%;*/
            border: 1px solid;
            margin: auto;
        }
        .clearfix::after {
            content: "";
            display: block;
            clear: both;
        }
        
        
        .this_week_time{
            width: 65%;
            border: 1px solid;
            float: left;
            min-width: 675px;
        }
        .this_week_time_box{
            border: 3px solid black;
            border-radius: 10px;
            padding: 10px;
            margin: 3%;
            
        }
        .time_box{
            width: 80%;
            border: 3px solid black;
            border-radius: 10px;
            margin: auto;
            margin-bottom: 10px;
            padding: 10px;
        }
        .date{
            float: left;
            margin-left: 2%;
            font-size: 20px;
        }
        .day_of_week{
            float: left;
            /*clear: both;*/
            margin-left: 1%;
            margin-right: 5%;
            font-size: 20px;
        }
        .time{
            float: left;
            /*margin-left: 30px;*/
            font-size: 30px;
        }
        .edit{
            float: right;
            text-align: center;
            float: right;
            border: 2px solid;
            width: 56.5px;
            height: 28px;
            margin-left: 2%;
        }
        .edit_button{
            display: block;
        }
        .delete{
            text-align: right;
            /*float: left;*/
            /*margin-left: 20px;*/
            /*clear: both;*/
        }
        
        
        
        .side{
            border: 5px solid;
            width: 35%;
            float: left;
            min-width: 470px;
        }
        
        
        
        .total_time{
            /*float: left;*/
            border: 1px solid;
            width: 100%;
            min-width: 337px;
        }
        .total_time_box{
            border: 3px solid black;
            border-radius: 10px;
            padding: 10px;
            margin: 5%;
        }
        .all_sum{
            font-size: 50px;
            text-align: center;
        }
        
        
        
        .tweet{
            /*float: left;*/
            border: 1px solid;
            width: 100%;
            min-width: 337px;
        }
        .tweet_box{
            border: 3px solid black;
            border-radius: 10px;
            padding: 10px;
            margin: 5%;
        }
        .tweet_body{
            text-align: center;
            /*margin: auto;*/
        }
        textarea{
            width: 80%;
            height: 20%;
        }
        .tweet_button{
            text-align: right;
            margin-right: 3%;
        }
        
        
        
        
        .times_list{
            /*float: left;*/
            border: 1px solid;
            width: 100%;
            min-width: 337px;
        }
        .times_list_box{
            border: 3px solid black;
            border-radius: 10px;
            padding: 10px;
            margin: 5%;
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
            /*float: left;*/
            border: 1px solid;
            width: 100%;
            min-width: 337px;
        }
        .past_time_box{
            border: 3px solid black;
            border-radius: 10px;
            padding: 10px;
            margin: 5%;
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
        
        
        h2{
            border-bottom: solid 2px orange;
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
        <div class="this_week_time_box">
            <h2>～今週の学習時間～</h2>
            @foreach($own_study_sites as $study_site)
                <div class="time_box clearfix">
                    <div class="date">{{ $study_site->updated_at->format('Y-m-d') }}</div>
                    <div class="day_of_week">{{ $week[date('w', strtotime($study_site->updated_at))] }}</div>
                    <div class="time">
                        <p>Time : {{ $study_site->time }}</p>
                    </div>
                    <div class="edit">
                        <a href="/user/{{ $study_site->id }}/edit" class="edit_button">edit</a>
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
    </div>
    
    
    
    <div class="side">
        <div class="total_time">
            <div class="total_time_box">
                <h2>～今までの合計学習時間～</h2>
                <p class="all_sum">{{ $all_sum }}</p>
            </div>
        </div>
        
        <div class="tweet">
            <div class="tweet_box">
                <h2>～今日の振り返りをツイートしよう～</h2>
                <form action="/tweets/review_store" method="post">
                    @csrf
                    <div class="tweet_body">
                        <textarea name="review" placeholder="ツイート">{{ old('review', $latest_review->review ?? '') }}</textarea>
                    </div>
                    <p class="title__error" style="color:red">{{ $errors->first('review') }}</p>
                    <div class="tweet_button">
                        <input type="submit" id="button" value="tweet">
                    </div>
                    <input type="hidden" name="status" value="1">
                </form>
            </div>
        </div>
        
        <div class="times_list">
            <div class="times_list_box">
                <h2>～Time Table～</h2>
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
        </div>
        
        
        <div class="past_time">
            <div class="past_time_box">
                <form method="get" action="/user/{{ $own_study_site->id }}">
                    @csrf
                    <h2>～過去の学習時間の表示～</h2>
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
    </div>
    
    

</div>

@endsection
