@extends('layouts.app')
@section('content')
    $rank = 1;
    <table>
        <tr>
            <th>順位</th>
            <th>名前</th>
            <th>Time</th>
        </tr>
        @foreach($times as $time)
        <tr>
            <td>$rank</td>
            <td>{{ $time->user->name }}</td>
            <td>{{ $time->time }}</td>
        </tr>
        $rank++;
        @endforeach
    </table>
@endsection