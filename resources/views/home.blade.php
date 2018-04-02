@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Dashboard</div>
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        You are logged in as {{Auth::user()->name}}
        @if (Gate::allows('view-admin-panel'))
            <h1>Congrats, you are admin</h1>
        @endif
    </div>
</div>
@endsection
