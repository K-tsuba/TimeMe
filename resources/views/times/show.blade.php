<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 
</head>

@extends('layouts.app')
@section('content')
<h1>学習時間一覧</h1>
<div class="container">
    @foreach ($times as $time)
        <div class="row">
            <div class="col-1">
                <p>Name:{{ $time->user->name }}</p>
            </div>
            <div class="col-2">
                <p>Study Site:{{ $time->study_site->study_title }}</p>
            </div>
            <div class="col-3">
                <p>Created date:{{ $time->created_at }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>Time:{{ $time->time }}</p>
            </div>
            <div class="col-1">
                <p>[<a href="/times/{{ $time->id }}/edit">edit</a>]</p>
            </div>
            <div class="col-1">
                <form action="/times/{{ $time->id }}" id="form_{{ $time->id }}" method="post" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-success">delete</button> 
                </form>
            </div>
        </div>
    @endforeach
</div>
<div class="back">{<a href="/">back</a>}</div>
@endsection