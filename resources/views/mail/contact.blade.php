<div>
    Hello, admin, you have a new message from {{$contactAuthor}}
    <br>
    {{$contactMessage}}
    <br>
    @if($contactFeedback)
        {{$contactFeedback}}
    @endif
</div>