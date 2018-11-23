@extends('layouts.app')
@section('content')
    <div class="container" style="max-width: 80%">
        <div class="row justify-content-between h-50">
            @foreach($topLeagues as $topLeague)
                <div class="col">
                    <a href="{{URL::current()}}/{{$topLeague->id}}">
                        <img class="img-fluid" style="min-width: 100px" src="{{$topLeague->logo}}">
                    </a>
                </div>
            @endforeach
        </div>
    @foreach($leagues->chunk(3) as $chunk)
        <div class="row justify-content-between">
            @foreach($chunk as $league)
                <div class="col">
                    <a href="{{URL::current()}}/{{$league->id}}">
                        <img class="img-fluid" src="{{$league->logo}}" style="min-width: 100px">
                    </a>
                </div>
            @endforeach
        </div>
    @endforeach
    </div>
@endsection