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
    <style>
        .register{
            float: right;
            margin-right: 600px;
            /*margin: auto;*/
            width: 400px;
        }
        .study_title{
            float: left;
        }
        .study_site{
            float: left;
        }
        .own_study_site{
            margin-left: 300px;
        }
        .select_study_site{
            margin-top: 10px;
        }
        .display{
            font-size: 100px;
        }
        .start,.stop,.reset{
            padding: 10px 30px;
            font-size: 20px;
            margin-left: 20px;
        }
    </style>
</head>
@extends('layouts.app')
@section('content')

<!--<div>-->
<!--    {{--Auth::user()->name--}}-->
<!--</div>-->
<div>
    
    <div class="own_study_site">
        <h2>Own Study Site</h2>
        <div>
            @foreach($study_sites as $study_site)
                <div>
                    <p>{{ $study_site->study_title }}</p>
                    <p>{{ $study_site->study_site }}</p>
                </div>
                
            @endforeach
        </div>
        <select onChange="location.href=value;">
            <option selected>自分の学習時間の表示</option>
            @foreach($study_sites as $study_site)
            <option value="/user/{{ $study_site->id }}" >{{ $study_site->study_title }}</option>
            @endforeach
        </select>
    </div>
    
    
    <div class="register">
        <h2 class="">勉強するサイトの登録</h2>
        <div class="">
            <form action="/study_sites/store" method="post">
                @csrf
                <div class="study_title">
                    <h3>Study title</h3>
                    <input type="text" name="study_title" placeholder="タイトル">
                </div>
                <div class="study_site">
                    <h3>Study site</h3>
                    <input type="text" name="study_site" placeholder="urlを記入">
                </div>
                <div class="save_button">
                    <input type="submit" value="save">
                </div>
            </form>
        </div>
        
        <select id="select_study_site" class="select_study_site">
            <option selected>学習するサイトを選択</option>
            @foreach($study_sites as $study_site)
            <option value="{{ $study_site->id }}" >{{ $study_site->study_title }}</option>
            @endforeach
        </select>
        
        <p id="display" class="display">00:00:00</p>
        <button id="start" class="start">start</button>
        <button id="stop" class="stop">stop</button>
        <button id="reset" class="reset">reset</button>
        
    </div>
    
</div>


<a href="/times/show">学習時間一覧</a>
<!--<a href="/user">自分の学習時間</a>-->
<a href="/posts">投稿・質問画面</a>

<div class="back"><a href="/">back</a></div>
@endsection