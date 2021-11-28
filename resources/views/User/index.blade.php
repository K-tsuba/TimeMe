<head>
    <style>
        .day_of_week{
            float: left;
            clear: both;
            margin-left: 10%;
        }
        .time{
            float: left;
            margin-left: 20px;
        }
        .edit{
            float: left;
            margin-left: 20px;
        }
        .delete{
            float: left;
            margin-left: 20px;
            /*clear: both;*/
        }
        .table{
            /*clear: both;*/
            float: right;
            /*margin-left: 20px;*/
        }
    </style>
</head>

@extends('layouts.app')
@section('content')
<div>
    <h1>Study Site : {{ $own_study_site->study_title }}</h1>
</div>

<div>
    <h2>今までの合計時間{{ $all_sum }}</h2>
</div>

<div>
    <h2>今週の学習時間</h2>
    @foreach($own_study_sites as $study_site)
        <div class="day_of_week">{{ $week[date('w', strtotime($study_site->updated_at))] }}</div>
        <div class="time">
            <p>Time : {{ $study_site->time }}</p>
        </div>
        <div class="edit"><a href="/user/{{ $study_site->id }}/edit">edit</a></div>
        <div class="delete">
            <form action="/user/{{ $study_site->id }}" id="form_{{ $study_site->id }}" method="post" style="display:inline">
                @csrf
                @method('delete')
                <button type="submit">delete</button>
            </form>
        </div>
    @endforeach
</div>

<div class="table">
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
            <th>{{ $today->startOfMonth()->month }}月の第{{ $today->startOfMonth()->weekOfMonth }}週の学習時間の合計</th>
            <th>{{ $first_week_sum }}</th>
        </tr>
        <tr>
            <th>{{ $today->startOfMonth()->month }}月の第{{ $today->startOfMonth()->addWeek()->weekOfMonth }}週の学習時間の合計</th>
            <th>{{ $second_week_sum }}</th>
        </tr>
        <tr>
            <th>{{ $today->startOfMonth()->month }}月の第{{ $today->startOfMonth()->addWeek(2)->weekOfMonth }}週の学習時間の合計</th>
            <th>{{ $third_week_sum }}</th>
        </tr>
        <tr>
            <th>{{ $today->startOfMonth()->month }}月の第{{ $today->startOfMonth()->addWeek(3)->weekOfMonth }}週の学習時間の合計</th>
            <th>{{ $fourth_week_sum }}</th>
        </tr>
        <tr>
            <th>{{ $today->startOfMonth()->month }}月の第{{ $today->startOfMonth()->addWeek(4)->weekOfMonth }}週の学習時間の合計</th>
            <th>{{ $fifth_week_sum }}</th>
        </tr>
    </table>
</div>



<form method="get" action="/user/{{ $own_study_site->id }}">
    @csrf
    <div>
        <p>過去の学習時間の表示</p>
        <select name="year">
            @for($i=2021; $i<2025; $i++)
                <option value="{{ $i }}">{{ $i }}年</option>
                <!--<option></option>-->
            @endfor
        </select>
    </div>
    <div>
        <select name="month">
            @for($i=1; $i<13; $i++)
                <option value="{{ $i }}">{{ $i }}月</option>
                <!--<option></option>-->
            @endfor
        </select>
    </div>
    <div>
        <input type="submit" value="表示">
    </div>
</form>

<div>
    @if(!empty($datas))
        @foreach($datas as $time)
            <p>{{ $time }}</p>
        @endforeach
    @endif
</div>

<!--<p>{{-- $data --}}</p>-->


<div class="back"><a href="/">back</a></div>
@endsection
