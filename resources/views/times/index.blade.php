<head>
    <script>
        
        
        
    
        var interval_id;
        var start_click=false;
        var time=0;
        var hour=0;
        var min=0;
        var sec=0;
        function start_timer(){
            
            var selectBox = document.getElementById('select_study_site');
            var start_button = document.getElementById('start');
            
            if (selectBox.options[0].selected === false){
                start_button.disabled = false;
                
                if (start_click === false){
                    
                    interval_id=setInterval(count_down, 1000);
                    start_click=true;
                    
                    document.getElementById("start").disabled = true;
                    document.getElementById("stop").disabled = false;
                    document.getElementById("reset").disabled = false;
                    
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
                        console.log(start_click);
                    };
                    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    
                    request.send("status=start");
                }
                
            } else {
                alert("学習するサイトを選択してください。");
                start_click=false;
            }
            
            
        }
        
        function hoge(event) {
            if (start_click === true) {
                event = event || window.event;
                return event.returnValue = '表示させたいメッセージ';
            }
        }
        
        if (window.addEventListener) {
            window.addEventListener('beforeunload', hoge, false);
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
            
            document.getElementById("stop").disabled = true;
        }
        function reset_timer(){
            time=0;
            var hour=0;
            var min=0;
            var sec=0;
            var reset=document.getElementById('display');
            reset.innerHTML='0:0:0';
            document.getElementById("start").disabled = false;
            document.getElementById("stop").disabled = true;
            document.getElementById("reset").disabled = true;
        }
        window.onload=function(){
            var start=document.getElementById('start');
            start.addEventListener('click', start_timer, false);
            var stop=document.getElementById('stop');
            stop.addEventListener('click', stop_timer, false);
            var reset=document.getElementById('reset');
            reset.addEventListener('click', reset_timer, false);
        }
        
        
        var apikey = 'AIzaSyCRj1tsmPrdQa7NC3TWwrVlDdpwUzQntSw';
        var channelid = 'UCHrjqpLwUNY4BV017sq21Tw';
        var maxresults = '0';
        var url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId='+channelid+'&maxResults='+maxresults+'&order=date&type=video&key='+apikey;
        var xhr = new XMLHttpRequest();
        xhr.open('get', url);
        xhr.send();
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                var json = JSON.parse(xhr.responseText);
                var html = "";
                var thumnail = "";
                var videoid = "";
                var title = "";
                for (var i=0; i<json.items.length; i++){
                    thumbnail = json.items[i].snippet.thumbnails.default.url;
                    videoid = json.items[i].id.videoId;
                    title = json.items[i].snippet.title;
                    html += '<div class="youtube_box"><a href="https://www.youtube.com/watch?v='+videoid+'" target="_blank"><img src="'+thumbnail+'"><br>'+title+'<br></div>';
                }
                document.getElementById('youtubeList').innerHTML = html;
            }
        }
        
        
        
    </script>
    <style>
        .min-w{
            min-width: 713px;
        }
        .display{
            font-size: 200px;
            text-align: center;
            margin: 0;
        }
        .start,.stop,.reset{
            padding: 5px 20px;
            font-size: 40px;
            border-radius: 50px;
            background-color: #ADC2A9;
        }
        .stop{
            margin: 0 10%;
        }
        .right_side{
            border: 0px solid;
            width: 35%;
            float: left;
            min-width: 380px;
        }
        h2{
            border-bottom: solid 2px black;
        }
    </style>
</head>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="float-left min-w" style="width: 65%;">
        <div class="border rounded mr-4 mb-4 p-2 bg-primary clearfix" style="">
            <h2 class="title_register">～勉強するサイトの登録～</h2>
                <form action="/study_sites/store" method="post">
                    @csrf
                        <div class="float-left mt-2">
                            <h3>Study title</h3>
                            <input type="text" name="study_title" placeholder="タイトル" class="" style="width: 200px; height: 38px;">
                        </div>
                        <div class="float-left ml-3 mt-2">
                            <h3>Study site</h3>
                            <input type="text" name="study_site" placeholder="urlを記入" class="" style="width: 200px; height: 38px;">
                        </div>
                        <div class="float-left ml-3 mt-5" style="width: 50px">
                            <input type="submit" value="&#xf00c; save" class="fas fa-2x bg-secondary">
                        </div>
                </form>
        </div>
        
        <div class="border rounded mb-4 mr-4 p-2 bg-primary">
            <div class="">
                <h2 class="">～学習するサイトを選択～</h2>
                <select id="select_study_site" class="text-center mt-2" style="width: 300px; height: 30px;">
                    <option selected>学習するサイトを選択</option>
                    @foreach($study_sites as $study_site)
                    <option value="{{ $study_site->id }}" >{{ $study_site->study_title }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <p id="display" class="display">0:0:0</p>
            </div>
            <div class="text-center mb-2">
                <button id="start" class="start">start</button>
                <button id="stop" class="stop" disabled>stop</button>
                <button id="reset" class="reset" disabled>reset</button>
            </div>
            
        </div>
        
    </div>
    
    <div class="right_side">
        <div style="width: 100%;">
            <div class="border rounded mb-4 p-2 bg-primary">
                <h2>～今日の目標をツイート～</h2>
                <form action="/tweets/goal_store" method="post">
                    @csrf
                    <div class="text-center mt-4">
                        <textarea name="goal" placeholder="今日の目標は？" style="width: 80%; height: 20%;">{{ old('goal', $latest_goal->goal ?? '') }}</textarea>
                    </div>
                    <p class="title__error" style="color:red">{{ $errors->first('goal') }}</p>
                    <div class="text-right mr-2">
                        <input type="submit" value="&#xf099; Tweet" class="fab fa-2x rounded-pill p-2 bg-secondary" value="&#xf099;">
                    </div>
                    <input type="hidden" name="status" value="1">
                </form>
            </div>
        </div>
        
        
        <div style="width: 100%;">
            <div class="border rounded mb-4 p-2 bg-primary">
                <h2>～Own Study Site～</h2>
                <div>
                    @foreach($study_sites as $study_site)
                        <ul>
                            <li>{{ $study_site->study_title }}</li>
                            <p><a href="{{ $study_site->study_site }}" target="_blank" class="text-white">{{ $study_site->study_site }}</a></p>
                        </ul>
                        
                    @endforeach
                </div>
            </div>
        </div>
        
        <div style="width: 100%;">
            <div class="border rounded mb-4 p-2 bg-primary">
                <h2>～Refresh～</h2>
                <div id="youtubeList" class=""></div>
            </div>
        </div>
    </div>
</div>
@endsection
