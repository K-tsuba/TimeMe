<head>
    <style>
        .min-wl{
            min-width: 713px;
        }
        .date{
            font-size: 20px;
        }
        .day_of_week{
            font-size: 20px;
        }
        .time{
            font-size: 30px;
        }
        .min-wr{
            min-width: 380px;
        }
        .all_sum{
            font-size: 50px;
        }
        .year_month{
            font-size: 20px;
        }
        .past_month_sum{
            font-size: 30px;
        }
        h2{
            border-bottom: solid 2px black;
        }
    </style>
</head>

@extends('layouts.app')
@section('content')
<div class="container">
    <div>
        <h1 class="text-center mb-3">Study Site : {{ $own_study_site->study_title }}</h1>
    </div>
    
    
    
    <div class="float-left min-wl" style="width: 65%;">
        <div class="border rounded mb-4 mr-4 p-2 bg-primary">
            <h2 class="mb-3">～今週の学習時間～</h2>
            @foreach($own_study_sites as $study_site)
                <div class="border rounded mx-auto mb-3 px-3 pt-3 bg-secondary clearfix" style="width: 80%;">
                    <div class="float-left ml-2 date">{{ $study_site->updated_at->format('Y/m/d') }}</div>
                    <div class="float-left ml-1 mr-4 day_of_week">({{ $week[date('w', strtotime($study_site->updated_at))] }})</div>
                    <div class="float-left time">
                        <p>Time : {{ $study_site->time }}</p>
                    </div>
                    <div class="float-right mt-2">
                        <a href="/user/{{ $study_site->id }}/edit" class="d-block"><i class="fas fa-edit fa-lg" ></i></a>
                    </div>
                    <div class="text-right">
                        <form action="/user/{{ $study_site->id }}" id="form_{{ $study_site->id }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onClick="delete_time({{ $study_site->id}})" class="btn btn-secondary mt-1"><i class="fas fa-trash-alt fa-lg"></i></button> 
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    
    
    <div class="float-left min-wr" style="width: 35%;">
        <!--<div class="right">-->
            <div class="border rounded mb-4 p-2 bg-primary">
                <h2>～今までの合計学習時間～</h2>
                <p class="text-center all_sum">{{ $all_sum }}</p>
            </div>
        <!--</div>-->
        
        <!--<div class="right">-->
            <div class="border rounded mb-4 p-2 bg-primary">
                <h2>～今日の振り返りをツイートしよう～</h2>
                <form action="/tweets/{{ $study_site_id }}/review_store" method="post">
                    @csrf
                    <div class="text-center mt-4">
                        <textarea name="review" placeholder="ツイート" style="width: 80%; height: 20%;">{{ old('review', $latest_review->review ?? '') }}</textarea>
                    </div>
                    <p class="ml-5" style="color:red">{{ $errors->first('review') }}</p>
                    <div class="text-right mr-2">
                        <input type="submit" value="&#xf099; Tweet" class="fab fa-2x rounded-pill p-2 bg-secondary" value="&#xf099;">
                    </div>
                    <input type="hidden" name="status" value="1">
                </form>
            </div>
        <!--</div>-->
        
        <!--<div class="right">-->
            <div class="border rounded mb-4 p-2 bg-primary">
                <h2>～Time Table～</h2>
                <table class="table table-hover">
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
        <!--</div>-->
        
        
        <!--<div class="right">-->
            <div class="border rounded mb-4 p-2 bg-primary">
                <form method="get" action="/user/{{ $own_study_site->id }}">
                    @csrf
                    <h2>～過去の学習時間の表示～</h2>
                    <div class="my-3 text-center">
                        <select name="year">
                            <option value="" selected>「年」を選択してください</option>
                            @for($i=2021; $i<2025; $i++)
                            <option value="{{ $i }}" @if(!empty($year) && $i == $year) selected @endif>{{ $i }}年</option>
                            @endfor
                        </select>
                    </div>
                    <div class="text-center">
                        <select name="month">
                            <option value="" selected>「月」を選択してください</option>
                            @for($i=1; $i<13; $i++)
                            <option value="{{ $i }}" @if(!empty($month) && $i == $month) selected @endif>{{ $i }}月</option>
                            @endfor
                        </select>
                    </div>
                    <div class="text-right mr-5 mt-3">
                        <input type="submit" value="表示" class="rounded-pill bg-secondary">
                    </div>
                </form>
                
                <div>
                    @if(!empty($month_sum))
                        <p class="ml-5 year_month">{{ $year }}年/{{ $month }}月</p>
                        <p class="text-center past_month_sum">{{ $month_sum }}</p>
                    @endif
                </div>
            </div>
        <!--</div>-->
    </div>
</div>
<script>
    function delete_time($id){
        if (window.confirm('本当に削除しますか？')){
            document.getElementById('form_'.$id).submit();
        } else {
            window.alert('削除がキャンセルされました。');
            event.preventDefault();
        }
    }
</script>
@endsection
