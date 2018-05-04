@extends('layouts.app')

@section('content')
    <div class="auth-form">
        <div class="form-label">Register to use more features</div>
        <form action="{{ route('register') }}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <input class="form-control" type="text" placeholder="your name" name="name" required>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input class="form-control" type="email" placeholder="email" name="email" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input class="form-control" type="password" placeholder="password" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input class="form-control" type="password" placeholder="confirm password" name="password_confirmation" required>
            </div>
            <div class="form-group">
                <input class="form-control btn" type="submit" value="register">
            </div>
        </form>
    </div>
@endsection
