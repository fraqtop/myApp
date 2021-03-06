@extends('layouts.app')
@section('content')
    <div class="auth-form">
        <div class="form-label">Let me know</div>
        <form id="contactForm" action="/contact" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <input class="form-control" type="text" placeholder="who are you" name="contactAuthor" required>
            </div>
            <div class="form-group">
                <textarea id="contactArea" class="form-control" placeholder="what do you want" name="contactMessage" required></textarea>
            </div>
            <div class="form-group">
                <input class="form-control" type="email" placeholder="feedback (optional)" name="contactFeedback">
            </div>
            <input type="hidden" name="contactTime" value="{{(new DateTime())->getTimestamp()}}">
            <div class="form-group">
                <input class="form-control btn" type="submit" value="send message">
            </div>
            @if($errors->count() > 0)
                <div class="alert alert-danger">
                    {{$errors->first()}}
                </div>
            @endif
        </form>
    </div>
@endsection
@section('script')
    <script>
        if (document.getElementById('contactForm'))
        {
            let counter = document.createElement('input');
            counter.name = "contactCounter";
            counter.id = "contactCounter";
            counter.value = 0;
            counter.type = "hidden";
            contactForm.appendChild(counter);
            contactArea.oninput = function () {
                contactCounter.value = parseInt(contactCounter.value) + 1;
            };
        }
    </script>
@endsection