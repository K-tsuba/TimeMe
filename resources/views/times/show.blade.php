@extends('layouts.app')
@section('content')
<h1>学習時間一覧</h1>
<div>
    @foreach ($times as $time)
        <div>
            <small>{{ $time->user->name }}</small>
            <small>{{ $time->user()->first()['name'] }}</small>
        </div>
        <div>
            <p>{{ $time->study_site->study_title }}</p>
            <p>{{ $time->created_at }}</p>
            <p>{{ $time->time }}</p>
            <p>[<a href="/times/{{ $time->id }}/edit">edit</a>]</p>
        </div>
        <form action="/times/{{ $time->id }}" id="form_{{ $time->id }}" method="post" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">delete</button> 
        </form>
    @endforeach
</div>
<div class="back">{<a href="/">back</a>}</div>
@endsection
