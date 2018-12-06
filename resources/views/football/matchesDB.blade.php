@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($matches as $match)
            <div class="row" style="max-height: 70px">
                <div class="col">
                    <img class="img-fluid" style="max-height: 100%" src="{{$match->homeTeam->logoURL}}">
                </div>
                <div class="col" style="text-align: center">
                    <h5>{{$match->homeTeam->name}}</h5>
                </div>
                <div class="col" style="text-align: center">
                    @foreach($match->results as $result)
                        <span>{{$result->stage}} {{$result->homeScore}}:{{$result->awayScore}}</span>
                    @endforeach
                </div>
                <div class="col" style="text-align: center">
                    <h5>{{$match->awayTeam->name}}</h5>
                </div>
                <div class="col">
                    <img class="img-fluid" style="max-height: 100%" src="{{$match->awayTeam->logoURL}}">
                </div>
            </div>
        @endforeach
    </div>
@endsection