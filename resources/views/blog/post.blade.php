@extends('layouts.app')
@section('content')
    <div class="viewport-pic">
        <img src="{{$post->getPicture()}}">
    </div>
    <div class="pillow"></div>
    <div class="text-container">
        <div class="post-title">
            <h1>{{$post->title}}</h1>
        </div>
        <div class="post-content">
            <h3>{{$post->content}}</h3>
        </div>
        @if(Auth::check())
            <form action="storecomment/" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <textarea name="commContent" class="form-control" placeholder="what do you think about it?"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="send">
                </div>
            </form>
        @endif
        <div class="comments">
            @foreach($comments as $comment)
                <div class="comment">
                    <div class="comment-author">{{ $comment->user->name }}</div>
                    <div class="comment-content">{{ $comment->content  }}</div>
                    <div class="comment-time">
                        {{
                            date('d M Y H:i', strtotime($comment->created_at))
                        }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection