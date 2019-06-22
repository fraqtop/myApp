@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>
            This season of competition is not started yet or was not tracked by system,
            so I haven't got any standings now. Anyway you can still see
            previous season standings
            <a href="{{Request::url()}}?season={{\Carbon\Carbon::now()->subYear()->year}}">
                here
            </a>.
        </h2>
    </div>
@endsection