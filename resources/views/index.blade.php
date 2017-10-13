@extends('layouts.basicLayout')

@section('content')
    <main>
        <section class="info">
            <div>
                <img src="{{URL::asset('img/example.jpg')}}">
            </div>
            <table class="table">
                <tbody>
                <tr><th>Name</th><th>Vanya Pralov</th></tr>
                <tr><th>Age</th><th>24</th></tr>
                <tr><th>Specialization</th><th>Web developer</th></tr>
                <tr><th>Location</th><th>Yaroslavl, Russia, Earth</th></tr>
                </tbody>
            </table>
            <article>
                I like making good and helpful things using new technologies.
                Coding is my favorite hobby and it helps me be happy even waking up at 6:00 on Monday.
                I perform not only working tasks but my own projects too.
                I try my code to be efficient, laconic and self-documenting.
                I love structure and order and I also stand for quality.
            </article>
        </section>

        <section class="skills">
            <div><h2>my stack</h2></div>
            <div class="stack">
                <div id="html"><h3>HTML5</h3></div>
                <div id="css"><h3>CSS3</h3></div>
                <div id="sass"><h3>Sass</h3></div>
                <div id="grid"><h3>Grid Layout</h3></div>
                <div id="flex"><h3>Flex box</h3></div>
                <div id="bootstrap"><h3>Bootstrap</h3></div>
                <div id="js"><h3>Javascript(ES6+)</h3></div>
                <div id="jquery"><h3>Jquery</h3></div>
                <div id="ajax"><h3>Ajax</h3></div>
                <div id="gulp"><h3>Gulp</h3></div>
                <div id="python"><h3>Python</h3></div>
                <div id="opencv"><h3>OpenCV</h3></div>
                <div id="django"><h3>Django</h3></div>
                <div id="suds"><h3>Suds</h3></div>
                <div id="php"><h3>PHP</h3></div>
                <div id="guzzle"><h3>Guzzle</h3></div>
                <div id="laravel"><h3>Laravel</h3></div>
                <div id="composer"><h3>Composer</h3></div>
                <div id="pdo"><h3>PDO</h3></div>
                <div id="c"><h3>C#</h3></div>
                <div id="mysql"><h3>MySQL</h3></div>
                <div id="oop"><h3>OOP</h3></div>
                <div id="git"><h3>Git</h3></div>
            </div>
        </section>
        <section class ="posts">
            <div class="post"></div>
            <div class="post"></div>
            <div class="post"></div>
        </section>
    </main>
@endsection