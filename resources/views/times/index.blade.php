<head>
<script>
    var interval_id;
    var start_click=false;
    var time=0;
    var hour=0;
    var min=0;
    var sec=0;
    function start_timer(){
        if (start_click === false){
            interval_id=setInterval(count_down, 1000);
            start_click=true;
            
            var select = document.getElementById('select_study_site');
            var study_site_id = select.value;
            
            var token = document.getElementsByName('csrf-token').item(0).content;
            var request = new XMLHttpRequest();

            request.open('post', '/times/start_store/'+study_site_id, true);
            request.responseType = 'json';
            request.setRequestHeader('X-CSRF-Token', token);
            request.onload = function () {
                var data = this.response;
                console.log(data);
            };
            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            request.send("status=start");
        }
    }
    function count_down(){
        time++;
        hour=Math.floor(time/3600);
        min=Math.floor((time/60)%60);
        sec=time%60;
        var display=document.getElementById('display');
        display.innerHTML=hour+':'+min+':'+sec;
    }
    function stop_timer(){
        clearInterval(interval_id);
        start_click=false;
        
        var token = document.getElementsByName('csrf-token').item(0).content;
        var request = new XMLHttpRequest();
        
        request.open('post', '/times/stop_store', true);
        request.responseType = 'json';
        request.setRequestHeader('X-CSRF-Token', token);
        request.onload = function(){
            var data = this.response;
            console.log(data);
        };
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.send("status=stop");
    }
    function reset_timer(){
        time=0;
        var hour=0;
        var min=0;
        var sec=0;
        var reset=document.getElementById('display');
        reset.innerHTML='00:00:00';
    }
    window.onload=function(){
        var start=document.getElementById('start');
        start.addEventListener('click', start_timer, false);
        var stop=document.getElementById('stop');
        stop.addEventListener('click', stop_timer, false);
        var reset=document.getElementById('reset');
        reset.addEventListener('click', reset_timer, false);
    }
</script>
</head>
@extends('layouts.app')
@section('content')

<div>
    {{Auth::user()->name}}
</div>

<h1>学習を計測する画面</h1>
{{--
@foreach($times as $time)
    <div>
        <p>学習するサイト名</p>
        <p>{{ $time->study_site->study_site_title }}</p>
    </div>
@endforeach
--}}
<!--<form method="get">-->
    <!--@csrf-->
        <select id="select_study_site">
            <option selected>学習するサイトを選択</option>
            @foreach($study_sites as $study_site)
            <option value="{{ $study_site->id }}" >{{ $study_site->study_title }}</option>
            @endforeach
        </select>
<!--</form>-->

<p id="display">00:00:00</p>
<button id="start">start</button>
<button id="stop">stop</button>
<button id="reset">reset</button>
    <!--<button>save</button>-->

    
<!--<form action="/times/store" method="post">-->
<!--    @csrf-->
<!--    <input type="number" name="time">-->
<!--    <input type="submit" value="save">-->
<!--</form>-->


<!--<form action="/times/store" method="post">-->
    
<!--    <button type="submit" name="start_time">start</button>-->
    
<!--</form>-->

<a href="/times/show">学習時間一覧</a>
<a href="/user">自分の学習時間</a>
<h2>勉強するサイトの登録</h2>
<form action="/study_sites/store" method="post">
    @csrf
    <div>
        <h3>Study title</h3>
        <input type="text" name="study_title" placeholder="タイトル">
    </div>
    <div>
        <h3>Study site</h3>
        <input type="text" name="study_site" placeholder="urlを記入">
    </div>
    <input type="submit" value="save">
</form>
<div>
    @foreach($study_sites as $study_site)
        <div>
            <p>{{ $study_site->study_title }}</p>
            <p>{{ $study_site->study_site }}</p>
        </div>
        {{--
        <form action="/study_site/study_site_store/{{ $study_site->id }}" method="post">
            @csrf
            <input type="submit" value="勉強する">
        </form>
        --}}
    @endforeach
</div>
<div class="back"><a href="/">back</a></div>
@endsection
