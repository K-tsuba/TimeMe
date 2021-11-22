@extends('layouts.app')
@section('content')
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
@endsection