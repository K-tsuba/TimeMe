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
            html += '<div class="text-center"><iframe width="150" height="100" src="https://www.youtube.com/embed/' +videoid+ '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><a href="https://www.youtube.com/watch?v='+videoid+'" target="_blank" class="text-white"><br>'+title+'<br></div>';
        }
        document.getElementById('youtubeList').innerHTML = html;
    }
}