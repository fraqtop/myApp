@extends('layouts.app')
@section('content')
    @foreach($standings as $standing)
        {{$standing->stage}}
    @endforeach
@endsection