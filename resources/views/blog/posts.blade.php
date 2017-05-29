@extends('layouts.basicLayout')
@section('content')
    <div class="posts">
        @if(Auth::check())
            <a href="{{url('/posts/create')}}"><div class="button"><h5>add post</h5></div></a>
        @endif
@foreach($posts as $post)
    <div class="post col-md-7 col-md-offset-1">
        <h1>{{$post->title}}</h1>
        <p>{{$post->content}}</p> </br>
        <p>Author: {{$post->user->name}}</p>
    </div>
@endforeach
    </div>
@endsection