@extends('layouts.app')
@section('content')
    <div class="posts-all">
    @foreach($posts as $post)
        <a href="/post/{{$post->id}}/">
            <div class="card post">
                <img class="card-img-top" src="{{asset($post->picture)}}">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->content}}</p>
                </div>
            </div>
        </a>
    @endforeach
    </div>
@endsection