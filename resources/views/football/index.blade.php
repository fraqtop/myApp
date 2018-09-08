@extends('layouts.app')
@section('content')
    @foreach($leagues as $league)
        <h1>{{$league->name}}</h1>
    @endforeach
@endsection