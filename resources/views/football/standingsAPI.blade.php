@extends('layouts.app')
@section('external_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    @foreach($standings as $standing)
        {{$standing->stage}}
    @endforeach
@endsection
@section('script')
    <script>
        token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ URL::current() }}',
            type: 'POST',
            data: {_token: token, _method: 'PATCH'},
            headers: {'X-CSRF-Token': token},
            success: function (response) {
                console.log(response);
            }
        });
    </script>
@endsection