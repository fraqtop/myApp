@extends('layouts.app')
@section('content')
    <div class="posts-all">
    @foreach($posts as $post)
        <a href="/post/{{$post->id}}/">
            <div class="card post">
                @if($post->picture)
                    <img class="card card-img-top" src="{{$post->picture}}">
                    @else
                    <img class="card card-img-top" src="{{$post->category->picture}}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->content}}</p>
                    @can('handle', $post)
                        <div class="btn btn-default">edit</div>
                        <div class="btn btn-default">delete</div>
                    @endcan
                </div>
                <div class="post-overflow"></div>
            </div>
        </a>
    @endforeach
    </div>
@endsection