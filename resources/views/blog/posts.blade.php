@extends('layouts.app')
@section('content')
    <div class="posts-all">
    <?php $current = url()->current() ?>
    @foreach($posts as $post)
        <a href="{{$current.'/'.$post->id}}">
            <div class="card post">
                <img class="card card-img-top" src="{{$post->getPicture()}}">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->content}}</p>
                </div>
                <div class="post-overflow">
                    @can('handle', $post)
                        <a href="{{$current.'/'.$post->id}}/edit">edit</a>
                        <form action="{{$current.'/'.$post->id}}" method="post">
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