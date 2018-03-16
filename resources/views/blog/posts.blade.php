@extends('layouts.basicLayout')
@section('content')
<div class="pillow">
    <header>
        <div class="posts">
            @for($i=0; $i<3; $i++)
                <a href="/post/{{$posts[$i]->id}}/">
                    <div class="post">
                        <h1>{{$posts[$i]->title}}</h1>
                        <p>{{$posts[$i]->content}}</p> </br>
                        <p>Author: {{$posts[$i]->user->name}}</p>
                    </div>
                </a>
            @endfor
        </div>
    </header>
</div>
<div class="my-container">
</div>
@endsection