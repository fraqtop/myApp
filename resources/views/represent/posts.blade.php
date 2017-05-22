@extends('layouts.r_layout')
@section('content')
@foreach($posts as $post)
<div class="content">
    <div class="post col-md-8 col-md-offset-1">
        <h1>{{$post->title}}</h1>
        <p>{{$post->content}}</p>
    </div>
</div>
@endforeach
@endsection