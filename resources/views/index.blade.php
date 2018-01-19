@extends('layouts.basicLayout')

@section('content')
<main class="grid_container">
    <section class="info">
        <h1>About</h1>
        <img src="{{URL::asset('img/example_space.jpg')}}">
        <article>
            Hi, my name is Vanya, nice to meet you here. I'm full stack web
            developer based in Yaroslavl. I like creating awesome and helpful things
            using new technologies. Coding is one of my hobbies, which helps me
            be happy even waking up at 6:00 on Monday.
            I perform not only working tasks but my own projects too. It helps me
            to improve development skills.
            I try my code to be efficient, laconic and self-documenting.
            I love structure, order and also stand for quality.
            Coding is not the only thing, that keeps me in the good mood.
            I'm crazy about different kinds of sport, especially football,
            snowboarding and swimming.
        </article>
    </section>
    <section class="timing">
        <h1>Working time</h1>
        <div class="graphic">
            <div class="gradation">
                <h3>Rarely</h3>
                <h3>Sometimes</h3>
                <h3>Often</h3>
                <h3>Usually</h3>
            </div>
            <div class="diagram">
                <div id="sass"><h3>SASS</h3></div>
                <div id="t-sql"><h3>T-SQL</h3></div>
                <div id="sharp"><h3>C#</h3></div>
                <div id="php"><h3>PHP</h3></div>
                <div id="python"><h3>Python</h3></div>
                <div id="js"><h3>Javascript</h3></div>
            </div>
        </div>
        <div class="pie">
            <img src="{{URL::asset('img/vectorpaint.svg')}}">
        </div>
    </section>
    <section class="posts">
        <div class="post"></div>
        <div class="post"></div>
        <div class="post"></div>
    </section>
</main>
@endsection