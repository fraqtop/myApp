@extends('layouts.basicLayout')
@section('content')
    <div class="post">
        <h1>{{ $post->title }}</h1>
        <h3>{{$post->content}}</h3>
        <h5>Author: {{$post->user->name}}</h5>
    </div>
    @include('blog.comments', ['comments' => $post->comments->load('user')])
    @if(Auth::check())
    <div class="col-md-6 col-md-offset-4">
        <div class="panel-body">
            <form class="form-horizontal" action="addcomment" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <textarea name="commContent" class="col-md-6" rows="5" placeholder="what do you think about it?"></textarea>
                </div>
                <div class="form-group">
                    <input class="col-md-3" type="submit" value="send">
                </div>
            </form>
        </div>
    </div>
    @endif
@endsection