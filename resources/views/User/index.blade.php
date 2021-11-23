<head>
    <style>
        
    </style>
</head>

@extends('layouts.app')
@section('content')
<div>
    <h1>Study Site : {{ $own_study_site->study_title }}</h1>
</div>
<div>
    <h2>今週の学習時間</h2>
    @foreach($own_study_sites as $study_site)
        <div>{{ $week[date('w', strtotime($study_site->updated_at))] }}</div>
        <div>
            <p>Time : {{ $study_site->time }}</p>
        </div>
        <p><a href="/user/{{ $study_site->id }}/edit">edit</a></p>
        <form action="/user/{{ $study_site->id }}" id="form_{{ $study_site->id }}" method="post" style="display:inline">
            @csrf
            @method('delete')
            <button type="submit">delete</button>
        </form>
    @endforeach
</div>
<div>
    今週の合計時間{{ $sum_this_week }}
</div>
<div>
    今月の合計時間{{ $this_month_sum }}
</div>
<div>
    今までの合計時間{{ $all_sum }}
</div>
<div>
    {{ $today->startOfMonth()->month }}月の第{{ $today->startOfMonth()->weekOfMonth }}週の学習時間の合計:{{ $first_week_sum }}
</div>
<div>
    {{ $today->startOfMonth()->month }}月の第{{ $today->startOfMonth()->addWeek()->weekOfMonth }}週の学習時間の合計:{{ $second_week_sum }}
</div>
<div>
    {{ $today->startOfMonth()->month }}月の第{{ $today->startOfMonth()->addWeek(2)->weekOfMonth }}週の学習時間の合計:{{ $third_week_sum }}
</div>
<div>
    {{ $today->startOfMonth()->month }}月の第{{ $today->startOfMonth()->addWeek(3)->weekOfMonth }}週の学習時間の合計:{{ $fourth_week_sum }}
</div>
<div>
    {{ $today->startOfMonth()->month }}月の第{{ $today->startOfMonth()->addWeek(4)->weekOfMonth }}週の学習時間の合計:{{ $fifth_week_sum }}
</div>

<form method="get" action="/search">
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
            @for($i=0; $i<13; $i++)
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
    @if(!empty($data))
        @foreach($data as $time)
            <p>{{ $time }}</p>
        @endforeach
    @endif
</div>

<!--<p>{{ $data }}</p>-->

<div>
    先月の学習時間を合計で表示
</div>
<div>
    先々月の合計を表示
</div>
<div>
    3か月の合計を表示
</div>
<div>
    半年の合計
</div>
<div>
    1年間の合計を表示
</div>
<div class="back"><a href="/">back</a></div>
@endsection
