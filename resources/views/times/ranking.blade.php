<head>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    
    <style>
        .border.border-3{
            border-width: 3px !important;
        }
        
        
        .flatbutton{
            border:1px solid #3079ed;
            background-color:#4d90fe;
            <!--width:100px;-->
            <!--height:28px;-->
        }
        
        #buttonImage {
            background-image:url({{ asset('images/edit_button.jpg') }});
            display:inline-block;
            <!--margin-top:2px;-->
            <!--width:16px;-->
            <!--height:16px;-->
        }
        
    </style>
</head>

@extends('layouts.app')
@section('content')
    <div class="border border-3 border-dark">
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
    </div>
    
    <div id="youtubeList"></div>
    
    <div>
        <form action="/ranking/tweet" method="post">
            <input type="text" value="">
            <input type="submit" value="" class="fas fa-edit fa-9x">
        </form>
    </div>
    
    <!--<button class="flatbutton"><span id="buttonImage"></span></button>-->
    <!--<button class="flatbutton"><img src="{{-- asset('images/edit_button.jpg') --}}"></button>-->
    
    
    <i class="fab fa-500px "></i>
    <i class="fas fa-edit fa-9x" ></i>
    
    
    <div class="edit">
        <a href="/times/{{ $time->id }}/edit" class="edit_button"><i class="fas fa-edit fa-9x" ></i></a>
    </div>
    <div class="text-right">
        <form action="/times/{{ $time->id }}" id="form_{{ $time->id }}" method="post" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" onClick="delete_time({{ $time->id}})"><i class="fas fa-edit fa-9x" ></i></button> 
        </form>
    </div>
    <i class="fas fa-trash-alt fa-lg " style="color: blue;"></i>
    <i class="fab fa-twitter fa-2x"></i>
    
    <input type="submit" class="tweet_button fab fa-3x" value="&#xf099; tweet" >
    
    <input type="submit" value="&#xf00c; save" class="fas fa-2x bg-secondary">
    
@endsection