@foreach($comments as $comment)
    <p>{{$comment->content}}</p>
    <h4>{{$comment->user->name}}</h4>
@endforeach