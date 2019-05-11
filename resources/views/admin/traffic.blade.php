@extends('layouts.admin')
@section('content')
    <form method="get" action="">
        <input name="dateFrom" class="dateTimePicker">
        <input type="submit" value="send">
    </form>
    <canvas style="max-width: 100%;" id="traffic-graphic">

    </canvas>
@endsection
@section('script')
    <script>
        let graphic = document.getElementById('traffic-graphic').getContext('2d');
        let chart = new Chart(graphic, {
           type: 'bar',
           data: {
               labels: {!! $xAxisLegend !!},
               datasets: [{
                   label: 'Visits per day',
                   data: {!! $visits !!},
                   backgroundColor: '#4D4D8F',
                   borderWidth: 1
               }]
           }
        });
    </script>
@endsection