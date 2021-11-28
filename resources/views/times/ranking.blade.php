<head>
    <script>
        var apikey = 'AIzaSyCRj1tsmPrdQa7NC3TWwrVlDdpwUzQntSw';
        var channelid = 'UCHrjqpLwUNY4BV017sq21Tw';
        var maxresults = '5';
        var url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId='+channelid+'&maxResults='+maxresults+'&order=date&type=video&key='+apikey;
        var xhr = new XMLHttpRequest();
        xhr.open('get', url);
        xhr.send();
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                var json = JSON.parse(xhr.responseText);
                var html = "";
                var thumbnail = "";
                var videoid = "";
                var title = "";
                for (var i=0; i<json.items.length; i++){
                    thumbnail = json.items[i].snippet.thumbnails.default.url;
                    videoid = json.items[i].id.videoId;
                    title = json.items[i].snippet.title;
                    html += '<a href="https://www.youtube.com/watch?v='+videoid+'" target="_blank"><img src="'+thumbnail+'"><br>'+title+'<br>';
                }
                document.getElementById('youtubeList').innerHTML = html;
            }
        }
         
    </script>
</head>

@extends('layouts.app')
@section('content')
    <table>
        <tr>
            <th>順位</th>
            <th>名前</th>
            <th>Time</th>
        </tr>
        @foreach($times as $time)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $time->user->name }}</td>
            <td>{{ $time->time }}</td>
        </tr>
        @endforeach
    </table>
    
    <div id="youtubeList"></div>
    
@endsection