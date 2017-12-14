@extends('layouts.basicLayout')

@section('content')
<main>
    <section class="info">
        <img src="{{URL::asset('img/example.jpg')}}">
        <div class="about">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>Vanya Pralov</td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td>24 years</td>
                    </tr>
                    <tr>
                        <td>Specialization</td>
                        <td>Web developer</td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td>Yaroslavl, Russia, Earth</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <article>
            I like making good and helpful things using new technologies.
            Coding is my favorite hobby and it helps me be happy even waking up at 6:00 on Monday.
            I perform not only working tasks but my own projects too.
            I try my code to be efficient, laconic and self-documenting.
            I love structure and order and I also stand for quality.
        </article>
    </section>
    <section class="skills">
        <img id="work_time" src="{{URL::asset('img/work-type.png')}}">
        <img id="work_pl" src="{{URL::asset('img/platform.png')}}">
    </section>
    <section class="graphic">
        <div class="gradation">
            <h4>Usually</h4>
            <h4>Often</h4>
            <h4>Sometimes</h4>
            <h4>Rarely</h4>
        </div>
        <div class="diagram">
            <div id="sass"><h3>SASS</h3></div>
            <div id="php"><h3>PHP</h3></div>
            <div id="t-sql"><h3>T-SQL</h3></div>
            <div id="python"><h3>Python</h3></div>
            <div id="sharp"><h3>C#</h3></div>
            <div id="js"><h3>Javascript</h3></div>
        </div>
    </section>
</main>
@endsection