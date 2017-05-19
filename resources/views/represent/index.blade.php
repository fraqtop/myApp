@extends('layouts.r_layout')

@section('content')
    <section id="intro">
        <div class="title_img">
            <img src="{{URL::asset('img/example.jpg')}}" alt="">
        </div>
        <div class="profile">
            <table class="table">
                <tbody>
                <tr><th>Name</th><th>Vanya Pralov</th></tr>
                <tr><th>Age</th><th>24</th></tr>
                <tr><th>Specialization</th><th>Web developer</th></tr>
                <tr><th>Location</th><th>Yaroslavl, Russia, Earth</th></tr>
                </tbody>
            </table>
        </div>
        <div class="message">
            <article>
                I like making good and helpful things using new technologies. Coding
                is my favorite hobby and it helps me be happy even waking up at 6:00
                on Monday. I perform not only working tasks but my own projects too. I try
                my code to be efficient, laconic and self-documenting. I love structure and order and I
                also stand for quality.
            </article>
        </div>
    </section>
    <section id="extra">
        <div>
            <h2>Frontend</h2>
            <div class="skill">
                <div class="col-md-3"><img src="{{URL::asset('img/css.png')}}" alt=""></div>
                <article>
                    CSS helps my web applications to have user-friendly interface.
                    My frontend is comfortable for most devices. To make flexible
                    layouts I use css flexbox and bootstrap grid.
                </article>
            </div>
            <div class="skill">
                <div class="col-md-3"><img src="{{URL::asset('img/bootstrap.png')}}" alt=""></div>
                <article>
                    I like making good and helpful things using new technologies. Coding
                    is my favorite hobby and it helps me be happy even waking up at 6:00
                    on Monday.
                </article>
            </div>
            <div class="skill">
                <div class="col-md-3"><img src="{{URL::asset('img/js.png')}}" alt=""></div>
                <article>
                    Javascript is very important part of any modern site, cause makes pages more
                    interactive and adds needed behaviour. Besides, I use it for asynchronous
                    requests to server. I can write with or without jquery on es6.
                </article>
            </div>
        </div>
        <div>
            <h2>Backend</h2>
            <div class="skill">
                <div class="col-md-3"><img src="{{URL::asset('img/c-sharp.png')}}" alt=""></div>
                <article>
                    This amazing strict technology was first in my education and helped me to
                    learn some basic, but very important stuff of object-oriented programming.
                    I wrote some desktop apps, including machine learning, patterns recognition
                    and other.
                </article>
            </div>
            <div class="skill">
                <div class="col-md-3"><img src="{{URL::asset('img/php.png')}}" alt=""></div>
                <article>
                    My first site was wrote with this
                </article>
            </div>
            <div class="skill">
                <div class="col-md-3"><img src="{{URL::asset('img/python.png')}}" alt=""></div>
                <article>
                    I like making good and helpful things using new technologies. Coding
                    is my favorite hobby and it helps me be happy even waking up at 6:00
                    on Monday.
                </article>
            </div>
        </div>
    </section>
@endsection