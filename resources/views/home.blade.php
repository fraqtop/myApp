@extends('layouts.app')

@section('content')
        <div class="dashboard-container">
            <h2>Hello, {{ Auth::user()->name }}</h2>
            @if(!Auth::user()->isVerified())
                <h3>Sorry, but you are not verified yet by admin to use more features</h3>
            @endif
        </div>
@endsection
