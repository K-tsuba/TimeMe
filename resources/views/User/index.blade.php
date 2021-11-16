@extends('layouts.app')
@section('content')
<h1>自分の学習時間一覧</h1>
<div>
    @foreach($own_study_sites as $study_site)
        <div>
            <p>{{ $study_site->time }}</p>
            <p>{{ $study_site->study_title }}</p>
        </div>
    @endforeach
</div>
<div class="back"><a href="/">back</a></div>
@endsection
