@extends('layouts.app')
@section('external_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                @foreach($standing->table as $row)
                    <tr>
                        <th scope="row">{{$row->position}}</th>
                        <td><img height="30px" width="30px" src="{{$row->team->crestUrl}}"></td>
                        <td>
                            <a href="/football/team/{{$row->team->id}}">
                                {{$row->team->name}}
                            </a>
                        </td>
                        <td>{{$row->points}}</td>
                        <td>{{$row->won}}</td>
                        <td>{{$row->draw}}</td>
                        <td>{{$row->lost}}</td>
                        <td class="text-success">{{$row->goalsFor}}</td>
                        <td class="text-danger">{{$row->goalsAgainst}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
@endsection
@section('script')
    <script>
        let loadData = async () => {
            let data = new FormData();
            data.append('_token', "{{csrf_token()}}");
            data.append('_method', 'PATCH');
            let result = await fetch(document.location.href, {
                credentials: "same-origin",
                method: 'post',
                body: data
            });
            console.log(await result.text());
        };
        loadData();
    </script>
@endsection