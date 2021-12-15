<head>
    <script type="text/javascript" src="/js/time.js"></script>
    <link href="/css/home.css" rel="stylesheet">
    <link href="/css/button.css" rel="stylesheet">
</head>

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="float-left min-w" style="width: 65%;">
        <div class="border rounded mr-4 mb-4 p-2 bg-primary clearfix" style="">
            <h2 class="title_register">～学習するサイトの登録～</h2>
            <form action="/study_sites/store" method="post">
                @csrf
                <div class="float-left mt-2">
                    <h3>Study title</h3>
                    <input type="text" name="study_title" placeholder="タイトル" class="" style="width: 200px; height: 38px;">
                    <p class="m-0">{{ $errors->first('study_title') }}</p>
                </div>
                <div class="float-left ml-3 mt-2">
                    <h3>Study site</h3>
                    <input type="text" name="study_site" placeholder="urlを記入" class="" style="width: 200px; height: 38px;">
                    <p class="m-0">{{ $errors->first('study_site') }}</p>
                </div>
                <div class="float-left ml-3 mt-5" style="width: 50px">
                    <input type="submit" value="&#xf00c; save" class="fas fa-2x border-secondary button">
                </div>
            </form>
        </div>
        <div class="border rounded mb-4 mr-4 p-2 bg-primary">
            <div class="">
                <h2 class="">～学習するサイトを選択 / 計測～</h2>
                <select id="select_study_site" class="text-center mt-2" style="width: 300px; height: 30px;">
                    <option selected>学習するサイトを選択</option>
                    @foreach($study_sites as $study_site)
                    <option value="{{ $study_site->id }}" >{{ $study_site->study_title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <p id="display" class="text-center display">0:0:0</p>
            </div>
            <div class="text-center mb-2">
                <button id="start" class="rounded-pill bg-secondary px-3 py-2 size">start</button>
                <button id="stop" class="rounded-pill bg-secondary px-3 py-2 mx-5 size" disabled>stop</button>
                <button id="reset" class="rounded-pill bg-secondary px-3 py-2 size" disabled>reset</button>
            </div>
        </div>
    </div>
    <div class="float-left min-wr" style="width: 35%;">
        <div style="width: 100%;">
            <div class="border rounded mb-4 p-2 bg-primary">
                <h2>～今日の目標をツイート～</h2>
                <form action="/tweets/goal_store" method="post">
                    @csrf
                    <div class="text-center mt-4">
                        <textarea name="goal" placeholder="今日の目標は？" style="width: 80%; height: 20%;">{{ old('goal', $latest_goal->goal ?? '') }}</textarea>
                    </div>
                    <p class="ml-5 mt-1">{{ $errors->first('goal') }}</p>
                    <div class="text-right mt-3 mr-2">
                        <input type="submit" value="&#xf099; Tweet" class="fab fa-2x border-secondary rounded-pill px-2 button" value="&#xf099;">
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
                            <p class="float-left"><a href="{{ $study_site->study_site }}" target="_blank" class="text-white">{{ $study_site->study_site }}</a></p>
                            <div class="text-right">
                                <form action="/study_sites/{{ $study_site->id }}" id="form_{{ $study_site->id }}" method="post" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onClick="delete_time({{ $study_site->id}})" class="btn btn-primary"><span title="delete"><i class="fas fa-trash-alt fa-lg"></i></span></button> 
                                </form>
                            </div>
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
<script type="text/javascript" src="/js/delete_alert.js"></script>
@endsection
