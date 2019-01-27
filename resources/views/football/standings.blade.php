@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <select class="form-control" style="margin-left: 80%" onchange="filterStandings(this.value)">
                <option value="TOTAL">Total</option>
                <option value="HOME">Home</option>
                <option value="AWAY">Away</option>
            </select>
        </div>
    @foreach($standings as $standing)
        <table class="table table-striped {{$standing->type}}" style="font-weight: 600; display: <?php echo $standing->type === 'TOTAL'? 'block': 'none'?>">
            <thead>
            <tr>
                <th scope="col">Position</th>
                <th scope="col"></th>
                <th scope="col">Team</th>
                <th scope="col">Points</th>
                <th scope="col" class="secondary">Won</th>
                <th scope="col" class="secondary">Draw</th>
                <th scope="col" class="secondary">Lost</th>
                <th scope="col" class="secondary">Goals for</th>
                <th scope="col" class="secondary">Goals against</th>
            </tr>
            </thead>
            <tbody>
            @foreach($standing->teams as $team)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><img height="30px" style="min-width: 30px" src="{{$team->logoURL}}"></td>
                    <td>
                        <a href="/football/team/{{$team->id}}">
                            {{$team->name}}
                        </a>
                    </td>
                    <td>{{$team->pivot->points}}</td>
                    <td class="secondary">{{$team->pivot->won}}</td>
                    <td class="secondary">{{$team->pivot->draw}}</td>
                    <td class="secondary">{{$team->pivot->lost}}</td>
                    <td class="text-success secondary">{{$team->pivot->goalsFor}}</td>
                    <td class="text-danger secondary">{{$team->pivot->goalsAgainst}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach
    </div>
@endsection

@section('script')
    <script>
        let standings = Array.from(document.getElementsByClassName('table'));
        function filterStandings(type) {
            standings.forEach(table => {table.style.display = 'none'});
            standings.filter(x => x.classList.contains(type)).forEach(table => {table.style.display = 'block'});
        }
    </script>
@endsection