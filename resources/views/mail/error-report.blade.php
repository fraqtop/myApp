<div>
    God dammit, new error was found, check this out
    <br>
        {{$errorMessage}}
    <br>
    @foreach($errorTrace as $row)
        <br>
            {{$row['file']}} -> {{$row['line']}}
        <br>
    @endforeach
</div>