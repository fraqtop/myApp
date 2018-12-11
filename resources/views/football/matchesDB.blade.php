@extends('layouts.app')
@section('content')
    <div class="container matches">
        @foreach($matches as $match)
            <div class="match" style="background: {{$match->thrillRating < 3 ? '#DEA77C': '#ABE3B1'}}">
                <img class="img-fluid home" src="{{$match->homeTeam->logoURL}}">
                <div>
                    <h5>{{$match->homeTeam->name}}</h5>
                </div>
                <div class="scores" id="{{$match->id}}">
                    @foreach($match->results as $result)
                        <span class="{{$match->id}}scores" style="display: none">
                            {{$result->stage}} {{$result->homeScore}}:{{$result->awayScore}}
                        </span>
                    @endforeach
                    <button class="btn btn-primary" onclick="showScores(this, {{$match->id}})">show scores</button>
                </div>
                <div style="display: grid; justify-items: end">
                    <h5>{{$match->awayTeam->name}}</h5>
                </div>
                <img class="img-fluid away" src="{{$match->awayTeam->logoURL}}">
            </div>
        @endforeach
    </div>
    @section('script')
        <script>
            function showScores(button, id) {
                button.style.display = 'none';
                let results = document.getElementsByClassName(`${id}scores`);
                Array.from(results).forEach(function (result) {
                    result.style.display = 'block';
                });
            }
        </script>
    @endsection
@endsection