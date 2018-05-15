@extends('layouts.app')
@section('content')
    <div class="auth-form">
        <div class="form-label">Let me know</div>
        <form action="/contact" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <input class="form-control" type="text" placeholder="who are you" name="contactAuthor" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="what do you want" name="contactMessage" required></textarea>
            </div>
            <div class="form-group">
                <input class="form-control" type="email" placeholder="feedback" name="contactFeedback">
            </div>
            <div class="form-group">
                <input placeholder="advanced" class="form-control advanced" type="text" name="contactAdvanced">
            </div>
            <div class="form-group">
                <input class="form-control btn" type="submit" value="send message">
            </div>
        </form>
    </div>
@endsection