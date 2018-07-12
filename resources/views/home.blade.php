@extends('layouts.app')

@section('content')
        <div class="dashboard-container">
            <h2>Hello, {{ Auth::user()->name }}</h2>
        </div>
@endsection
