@extends('layouts.basicLayout')
@section('content')
<div class="my-container">
    <div class="posts">
        @if(Auth::check())
            <a href="{{url('/posts/create')}}"><div class="button"><h5>add post</h5></div></a>
        @endif
@foreach($posts as $post)
    <a href="/post/{{$post->id}}/">
        <div class="post">
            <h1>{{$post->title}}</h1>
            <p>{{$post->content}}</p> </br>
            <p>Author: {{$post->user->name}}</p>
        </div>
    </a>
@endforeach
    </div>
</div>
@endsection