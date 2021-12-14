<head>
    <link href="/css/times_list.css" rel="stylesheet">
</head>

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="float-left min-wl" style="width: 65%;">
        <div class="border rounded mr-4 mb-4 p-2 bg-primary">
            <h1>～学習時間一覧～</h1>
            @foreach ($times as $time)
                <div class="border rounded m-4 p-2 bg-secondary">
                    <div class="float-left mr-3 user_name">
                        <p>User Name : {{ $time->user->name }}</p>
                    </div>
                    <div class="float-left mr-3 mt-1 study_site">
                        <p>Study Site : {{ $time->study_site->study_title }}</p>
                    </div>
                    <div class="float-left mt-1 date">
                        <p>Date : {{ $time->updated_at }}</p>
                    </div>
                    
                    <div class="float-right mr-2 mt-1">
                        <a href="/times/{{ $time->id }}/edit" class="d-block"><span title="edit"><i class="fas fa-edit fa-lg" ></i></span></a>
                    </div>
                    <div class="text-right">
                        <form action="/times/{{ $time->id }}" id="form_{{ $time->id }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onClick="delete_time({{ $time->id}})" class="btn btn-secondary"><span title="delete"><i class="fas fa-trash-alt fa-lg"></i></span></button> 
                        </form>
                    </div>
                    <div class="text-center time">
                        <p>Time : {{ $time->time }}</p>
                    </div>
                </div>
            @endforeach
            <div class="mx-auto mt-3" style="width: 360px;">
                <div>{{ $times->links() }}</div>
            </div>
        </div>
    </div>
    <div class="float-left min-wr" style="width: 35%;">
        <div class="border rounded mb-4 p-2 bg-primary">
            <h3 class="mb-3">～先週の学習時間ランキング～</h3>
            <table class="table table-hover">
                <thead>
                    <tr class="table-active">
                        <th>順位</th>
                        <th>名前</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($week_ranking as $time)
                    <tr class="table-secondary">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $time['user_name'] }}</td>
                        <td>{{ $time['sum'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
        <div class="border rounded mb-4 p-2 bg-primary">
            <h3 class="mb-3">～先月の学習時間ランキング～</h3>
            <table class="table table-hover">
                <thead>
                    <tr class="table-active">
                        <th>順位</th>
                        <th>名前</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($month_ranking as $time)
                    <tr class="table-secondary">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $time['user_name'] }}</td>
                        <td>{{ $time['sum'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function delete_time($id){
        if (window.confirm('本当に削除しますか？')){
            document.getElementById('form_'.$id).submit();
        } else {
            window.alert('削除がキャンセルされました。');
            event.preventDefault();
        }
    }
</script>

@endsection
