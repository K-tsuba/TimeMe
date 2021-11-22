@extends('layouts.app')
@section('content')
<h1>自分の学習時間一覧</h1>
<div>
    サイト
    <h2>{{ $own_study_site->study_title }}</h2>
</div>
<div>
    <h3>今週の学習時間</h3>
    @foreach($own_study_sites as $study_site)
        <div>
            Time
            <p>{{ $study_site->time }}</p>
        </div>
        <p><a href="/user/{{ $study_site->id }}/edit">edit</a></p>
        <form action="/user/{{ $study_site->id }}" id="form_{{ $study_site->id }}" method="post" style="display:inline">
            @csrf
            @method('delete')
            <button type="submit">delete</button>
        </form>
    @endforeach
</div>
<div>
    今週の学習時間の合計
</div>
<div>
    今月の学習時間を週単位で表示
</div>
<div>
    先月の学習時間を合計で表示
</div>
<div>
    先々月の合計を表示
</div>
<div>
    3か月の合計を表示
</div>
<div>
    半年の合計
</div>
<div>
    1年間の合計を表示
</div>
<div class="back"><a href="/">back</a></div>
@endsection
