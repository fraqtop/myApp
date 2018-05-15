@extends('layouts.app')

@section('content')
    <div class="auth-form">
        <div class="form-label">Log in to use more features</div>
        <form action="{{ route('login') }}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <input class="form-control" type="email" placeholder="email" name="email" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" placeholder="password" name="password" required>
            </div>
            @if ($errors->count() > 0)
                <div class="alert alert-danger">
                    {{$errors->first()}}
                </div>
            @endif
            <div class="form-group">
                <input class="form-control btn" type="submit" value="login">
            </div>
        </form>
    </div>
@endsection
