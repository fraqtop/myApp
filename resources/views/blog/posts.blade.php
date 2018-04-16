@extends('layouts.app')
@section('content')
    <div class="posts-all">
    @foreach($posts as $post)
        <a href="/post/{{$post->id}}/">
            <div class="card post">
                <img class="card card-img-top" src="{{$post->getPicture()}}">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->content}}</p>
                </div>
                <div class="post-overflow">
                    @can('handle', $post)
                        <a href="#">edit</a>
                        <a href="#">delete</a>
                    @endcan
                </div>
            </div>
        </a>
    @endforeach
    </div>
@endsection