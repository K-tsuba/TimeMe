<head>
    <link href="/css/time_edit.css" rel="stylesheet">
    <link href="/css/button.css" rel="stylesheet">
</head>

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mx-auto p-3 border rounded bg-primary" style="width: 100%;">
        <div class="mx-auto p-3 border rounded bg-secondary" style="width: 80%;">
            <h1 class="mx-auto" style="width: 83%;">Edit Time</h1>
            <form action="/user/{{ $time->id }}" method="post">
                @csrf
                @method('put')
                <div class="text-center">
                    <input type='time' class="text-center time" style="width: 60%; height: 20%;"　name='time' value="{{ $time->time }}">
                </div>
                <div class="text-right mt-3" style="width: 83%;">
                    <input type="submit" value="&#xf00c; save" class="fas fa-lg p-2 border-secondary rounded-pill button">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection