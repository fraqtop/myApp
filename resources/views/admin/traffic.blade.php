@extends('layouts.admin')
@section('content')
    <form method="get" action="">
        <input name="dateFrom" type="datetime-local">
        <input type="submit" value="send">
    </form>
    <div class="horizontal_graphic">
        <div class="y-axis">
            @foreach($yAxisLegend as $yValue)
                <span>{{$yValue}}</span>
            @endforeach
        </div>
        <div class="x-axis">
            @foreach($xAxisLegend as $xValue)
                <span>{{$xValue}}</span>
            @endforeach
        </div>
        <div class="graphic-values">
            @foreach($visits as $visit)
                <div style="height: {{100 / $yAxisLegend[0] * $visit->visitsCount}}%" data-toggle="tooltip" data-placement="top" title="{{$visit->date}}"></div>
            @endforeach
        </div>
    </div>
@endsection