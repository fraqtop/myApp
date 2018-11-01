@extends('layouts.admin')
@section('content')
    <h1>{{$league->name}} ({{$league->areaName}})</h1>
    @if($league->logo)
        <img src="{{$league->logo}}">
    @else
        <img src="/img/code.jpg">
    @endif
    <form action="" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('PATCH')}}
        <input type="file" name="newLogo" required>
        <input class="btn btn-dark" type="submit" value="save logo">
    </form>
@endsection