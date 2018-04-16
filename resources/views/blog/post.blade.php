@extends('layouts.app')
@section('content')
    <div class="viewport-pic">
        <img src="{{$post->getPicture()}}">
    </div>
    <div class="pillow"></div>
    <div class="text-container">
        <div class="post-title">
            <h1>{{$post->title}}</h1>
        </div>
        <div class="post-content">
            <h3>{{$post->content}}</h3>
        </div>
    </div>
@endsection