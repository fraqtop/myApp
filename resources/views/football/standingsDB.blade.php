@extends('layouts.app')
@section('content')
    <div class="container">
    @foreach($standings as $standing)
        <table class="table table-striped" style="font-weight: 600">
            <thead>
            <tr>
                <th scope="col">Position</th>
                <th scope="col"></th>
                <th scope="col">Team</th>
                <th scope="col">Points</th>
                <th scope="col">Won</th>
                <th scope="col">Draw</th>
                <th scope="col">Lost</th>
                <th scope="col">Goals for</th>
                <th scope="col">Goals against</th>
            </tr>
            </thead>
            <tbody>
            @foreach($standing->teams as $team)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><img height="30px" width="30px" src="{{$team->logoURL}}"></td>
                    <td>
                        <a href="/football/team/{{$team->id}}">
                            {{$team->name}}
                        </a>
                    </td>
                    <td>{{$team->pivot->points}}</td>
                    <td>{{$team->pivot->won}}</td>
                    <td>{{$team->pivot->draw}}</td>
                    <td>{{$team->pivot->lost}}</td>
                    <td class="text-success">{{$team->pivot->goalsFor}}</td>
                    <td class="text-danger">{{$team->pivot->goalsAgainst}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach
    </div>
@endsection