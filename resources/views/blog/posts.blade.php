@extends('layouts.app')
@section('content')
    <div class="posts-all">
        @can('create', \App\Post::class)
            <a href="/posts/create/"><div class="btn btn-dark" style="width: 100%">add new</div></a>
        @endcan
    @foreach($posts as $post)
        <a href="/posts/{{$post->id}}">
            <div class="card post">
                <img class="card card-img-top" src="{{$post->getPicture()}}">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->content}}</p>
                </div>
                <div class="post-overflow">
                    @can('handle', $post)
                        {{date('d M Y H:i', strtotime($post->updated_at))}}
                        <a href="posts/{{$post->id}}/edit">edit</a>
                        <form action="posts/{{$post->id}}" method="post">
                            {{csrf_field()}}
                            {{method_field('delete')}}
                            <a href='#'><input type="submit" value="delete"></a>
                        </form>
                    @endcan
                </div>
            </div>
        </a>
    @endforeach
    </div>
@endsection