@extends('layouts.app')
@section('content')
    <h2>
        {{ $team->name }}
    </h2>
    @foreach($team->players as $player)
        <h4>{{$player->name}}, {{$player->position}}, {{$player->birth}}</h4>
    @endforeach
@endsection