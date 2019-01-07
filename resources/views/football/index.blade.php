@extends('layouts.app')
@section('content')
    <div class="matches-container">
        <div class="aside-pillow"></div>
        <aside class="matches-aside">
            <section>
                <h4>Standings</h4>
                <div class="ribbon">
                @foreach($leagues as $league)
                    <a href="/football/{{$league->id}}">
                        <img class="img-fluid" src="{{$league->logo ?? '/img/nothing.jpg'}}">
                    </a>
                @endforeach
                </div>
            </section>
            <section>
                <h4>Filter</h4>
                <div class="ribbon">
                    <select class="form-control form-group" style="height: 50px" onchange="filterMatches(this.value)">
                        <option value="0" selected>no filter for matches</option>
                        @foreach($leagues as $league)
                            <option value="{{$league->id}}">{{$league->name}} ({{$league->areaName}})</option>
                        @endforeach
                    </select>
                </div>
            </section>
        </aside>
        <div class="matches">
            <div style="display: grid; margin: 0; align-items: center; justify-items: center">
                <h4>
                    <a href="/football/{{$date->copy()->subDay()->format('Y-m-d')}}" style="margin: 0 15px">
                        yesterday
                    </a>
                    Matches for {{$date->format('F l j')}}
                    <a href="/football/{{$date->copy()->addDay()->format('Y-m-d')}}" style="margin: 0 15px">
                        tomorrow
                    </a>
                </h4>
            </div>
            @if($matches->count() === 0)
                <div class="alert-danger">
                    <h4>
                        no matches for this day
                    </h4>
                </div>
            @endif
            @foreach($matches as $match)
                <div class="match {{$match->leagueId}}" style="background: {{$match->thrillRating < 3 ? '#DEA77C': '#ABE3B1'}}">
                    <img class="img-fluid home" src="{{$match->homeTeam->logoURL}}">
                    <div>
                        <h5>{{$match->homeTeam->name}}</h5>
                    </div>
                    <div class="scores" id="{{$match->id}}">
                        @if($match->results->count() > 0)
                            @foreach($match->results as $result)
                                <span class="{{$match->id}}scores" style="display: none">
                                {{$result->stage}} {{$result->homeScore}}:{{$result->awayScore}}
                                </span>
                            @endforeach
                            <button class="btn btn-primary" onclick="showScores(this, {{$match->id}})">
                                {{$match->startAt->setTimeZone('Europe/Moscow')->format('H:i')}}
                            </button>
                        @else
                            <span class="{{$match->startAt < \Carbon\Carbon::now() ? 'alert-success': 'alert-primary'}}">
                                {{$match->startAt->setTimeZone('Europe/Moscow')->format('H:i')}}
                            </span>
                        @endif
                    </div>
                    <div style="display: grid; justify-items: end">
                        <h5>{{$match->awayTeam->name}}</h5>
                    </div>
                    <img class="img-fluid away" src="{{$match->awayTeam->logoURL}}">
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
    <script>
        let matches = Array.from(document.getElementsByClassName('match'));
        function showScores(button, id) {
            button.style.display = 'none';
            let results = Array.from(document.getElementsByClassName(`${id}scores`));
            results.forEach(result => {result.style.display = 'block'});
        }
        function filterMatches(league) {
            if (league == 0){
                console.log(matches);
                matches.forEach(match => {match.hidden = false});
            }
            else {
                matches.forEach(match => {match.hidden = true});
                matches.filter(x => x.classList.contains(league)).forEach(match => {match.hidden = false})
            }
        }
    </script>
@endsection