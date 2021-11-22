@extends('layouts.app')
@section('content')
<h1>学習時間編集画面</h1>
<form action="/times/{{ $time->id }}" method="post">
    @csrf
    @method('put')
    <input type='time' name='time' value="{{ $time->time }}">
    <input type='submit' value="save">
</form>
<div class="back">{<a href="/">back</a>}</div>
@endsection
