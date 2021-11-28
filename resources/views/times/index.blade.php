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
        
        
        var apikey = 'AIzaSyCRj1tsmPrdQa7NC3TWwrVlDdpwUzQntSw';
        //AIzaSyCRj1tsmPrdQa7NC3TWwrVlDdpwUzQntSw
        var channelid = 'UCHrjqpLwUNY4BV017sq21Tw';
        //UCHrjqpLwUNY4BV017sq21Tw
        var maxresults = '1';
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
            /*overflow:hidden;*/
            /*height:100%;*/
            /*background-color: gray;*/
            /*border: 1px;*/
            /*min-width: 500px;*/
            /*background-color: blue;*/
            /*text-align: center;*/
            margin: auto;
            /*display: block;*/
            width: 90%;
            /*margin-left: 100px;*/
        }
        .own_study_site{
            float: left;
            width: 20%;
            /*margin-left: 20%;*/
        }
        .study_register{
            float: left;
            width: 50%;
            /*margin-left: 1%;*/
            /*margin-right: 600px;*/
            /*margin: auto;*/
            /*width: 400px;*/
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
        .select_study_site{
            margin-top: 50px;
            clear: both;
        }
        .display{
            font-size: 200px;
            /*width: 300px;*/
            margin: 0;
        }
        .start,.stop,.reset{
            padding: 10px 30px;
            font-size: 20px;
            margin-left: 20px;
        }
        .youtubelist{
            float: left;
            /*margin-top: 100px;*/
            width: 20%;
            /*margin-left: 300px;*/
        }
        /*.youtube_box{*/
        /*    float: left;*/
        /*    width: 200px;*/
        /*    clear: both;*/
        /*}*/
        
        
        
        
    </style>
</head>
@extends('layouts.app')
@section('content')

<!--<div>-->
<!--    {{--Auth::user()->name--}}-->
<!--</div>-->

<div class="">
    <div class="parent">
        
        <div class="own_study_site">
            <h2>Own Study Site</h2>
            <div>
                @foreach($study_sites as $study_site)
                    <div>
                        <p>{{ $study_site->study_title }}</p>
                        <p><a href="{{ $study_site->study_site }}" target="_blank">{{ $study_site->study_site }}</a></p>
                    </div>
                    
                @endforeach
            </div>
            <select onChange="location.href=value;">
                <option selected>自分の学習時間の表示</option>
                @foreach($study_sites as $study_site)
                <option value="/user/{{ $study_site->id }}" >{{ $study_site->study_title }}</option>
                @endforeach
            </select>
            <div>
                <a href="/times/show">学習時間一覧</a>
                <a href="/posts">投稿・質問画面</a>
                <div class="back"><a href="/">back</a></div>
            </div>
            
        </div>
        
        
        <div class="study_register">
            <h2 class="">勉強するサイトの登録</h2>
            <div class="">
                <form action="/study_sites/store" method="post">
                    @csrf
                    <div class="">
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
                    </div>
                </form>
            </div>
            <div class="select_study_site">
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
            <button id="start" class="start">start</button>
            <button id="stop" class="stop" disabled>stop</button>
            <button id="reset" class="reset" disabled>reset</button>
            
        </div>
        
        <div class="youtubelist">
            <div id="youtubeList" class=""></div>
        </div>
        
    </div>
</div>

@endsection
