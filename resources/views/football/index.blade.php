@extends('layouts.app')
@section('content')
    @foreach($leagues as $league)
        <a href="/football/{{$league->id}}">{{$league->name}}</a>
    @endforeach
@endsection