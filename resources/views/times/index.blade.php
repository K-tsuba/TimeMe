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
        .parent{
            border: 1px solid;
            margin: auto;
            width: 90%;
        }
        
        
        .time{
            float: left;
            width: 60%;
            border: 1px solid;
            max-width: 100%;
            min-width: 675px;
        }
        .register_study_site{
            border: solid 3px black;
            /*background-color: powderblue;*/
            border-radius: 10px;
            margin: 4%;
            padding: 10px;
        }
        .clearfix::after {
            content: "";
            display: block;
            clear: both;
        }
        .title_register{
        }
        .study_title{
            float:left;
        }
        .study_site{
            float:left;
            margin-left: 10px;
        }
        .save_button{
            float:left;
            width: 50px;
            margin-left: 10px;
            margin-top: 38px;
        }
        
        
        .measure_box{
            border: solid 3px black;
            border-radius: 10px;
            margin: 4%;
            padding: 10px;
        }
        .select_study_site{
            /*margin-top: 30px;*/
            /*margin-left: 10%;*/
            clear: both;
        }
        select{
            width: 300px;
            height: 30px;
            text-align: center;
        }
        .display{
            font-size: 200px;
            text-align: center;
            margin: 0;
        }
        .buttons{
            text-align: center;
        }
        .start,.stop,.reset{
            padding: 5px 20px;
            font-size: 40px;
            /*margin-left: 9%;*/
            border-radius: 50px;
        }
        .stop{
            margin: 0 10%;
        }
        
        
        
        .tweet{
            float: right;
            width: 40%;
            border: 1px solid;
            min-width: 337px;
        }
        .tweet_box{
            border: solid 3px black;
            border-radius: 10px;
            margin: 5%;
            padding: 10px;
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
        
        
        .own_study_site{
            float: right;
            width: 40%;
            border: 1px solid;
            min-width: 337px;
        }
        .site_list_box{
            border: solid 3px black;
            border-radius: 10px;
            margin: 5%;
            padding: 10px;
        }
        
        
        .youtubelist{
            float: right;
            width: 40%;
            border: 1px solid;
            min-width: 337px;
        }
        .youtube_box{
            border: solid 3px black;
            border-radius: 10px;
            margin: 5%;
            padding: 10px;
        }
        
        
        h2{
            border-bottom: solid 2px orange;
        }
        
        
        
        
    </style>
</head>
@extends('layouts.app')
@section('content')

<!--<div>-->
<!--    {{--Auth::user()->name--}}-->
<!--</div>-->

<div class="">
    <div class="parent">
        <div class="time">
            
            <div class="register_study_site clearfix">
                <h2 class="title_register">～勉強するサイトの登録～</h2>
                <!--<div class="">-->
                    <form action="/study_sites/store" method="post">
                        @csrf
                        <!--<div class="">-->
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
                        <!--</div>-->
                    </form>
                <!--</div>-->
            </div>
            
            <div class="measure_box">
                <div class="select_study_site">
                    <h2>～学習するサイトを選択～</h2>
                    <select id="select_study_site">
                        <option selected>学習するサイトを選択</option>
                        @foreach($study_sites as $study_site)
                        <option value="{{ $study_site->id }}" >{{ $study_site->study_title }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <p id="display" class="display">0:0:0</p>
                </div>
                <div class="buttons">
                    <button id="start" class="start">start</button>
                    <button id="stop" class="stop" disabled>stop</button>
                    <button id="reset" class="reset" disabled>reset</button>
                </div>
                
            </div>
            
        </div>
        
        
        <div class="tweet">
            <div class="tweet_box">
                <h2>～今日の目標をツイートしよう～</h2>
                <form action="/tweets/store" method="post">
                    @csrf
                    <div class="tweet_body">
                        <textarea name="goal" placeholder="ツイート">{{ old('goal', $latest_goal->goal ?? '') }}</textarea>
                    </div>
                    <p class="title__error" style="color:red">{{ $errors->first('goal') }}</p>
                    <div class="tweet_button">
                        <input type="submit" value="tweet">
                    </div>
                    <input type="hidden" name="status" value="1">
                </form>
            </div>
        </div>
        
        
        <div class="own_study_site">
            <div class="site_list_box">
                <h2>～Own Study Site～</h2>
                <div>
                    @foreach($study_sites as $study_site)
                        <ul>
                            <li>{{ $study_site->study_title }}</li>
                            <p><a href="{{ $study_site->study_site }}" target="_blank">{{ $study_site->study_site }}</a></p>
                        </ul>
                        
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="youtubelist">
            <div class="youtube_box">
                <h2>～Refresh～</h2>
                <div id="youtubeList" class=""></div>
            </div>
        </div>
        
        
        
    </div>
    
    
    
</div>

@endsection
