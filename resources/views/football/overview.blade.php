@extends('layouts.app')
@section('content')
    @foreach($standings as $standing)
        <table>
            <tr>
                <th>{{$standing->stage}}, {{$standing->type}}, {{$standing->group}}</th>
            </tr>
            <tr>
                <th>place</th>
                <th>name</th>
                <th>points</th>
            </tr>
            @foreach($standing->stats as $teamStats)
            <tr>
                <td>{{$teamStats->position}}</td>
                <td>{{$teamStats->team->name}}</td>
                <td>{{$teamStats->points}}</td>
            </tr>
            @endforeach
        </table>
    @endforeach
@endsection