<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>fraqtop's</title>
</head>
<body>
    <div class="pillow">
        <header>
            <div id="particles-js"></div>
            <div class="hello-alert">
                <h1>Vanya Pralov</h1>
                <h4>full stack web developer</h4>
            </div>
            <nav class="index-nav">
                <a href="/">home</a>
                <a href="/posts">blog</a>
                <a href="/contact">contact</a>
            </nav>
        </header>
    </div>
    <div class="grid-container">
        <section class="info">
            <img src="{{asset('img/example_space.jpg')}}">
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
            <div class="graphic">
                <div class="legend">
                    <h3>Rarely</h3>
                    <h3>Sometimes</h3>
                    <h3>Often</h3>
                    <h3>Usually</h3>
                </div>
                <div class="diagram">
                    <div id="scss"><h3>scss</h3></div>
                    <div id="t-sql"><h3>t-sql</h3></div>
                    <div id="sharp"><h3>c#</h3></div>
                    <div id="php"><h3>php</h3></div>
                    <div id="python"><h3>python</h3></div>
                    <div id="js"><h3>javascript</h3></div>
                </div>
            </div>
            <div class="img-responsive">
                <img src="{{URL::asset('img/pie.png')}}">
            </div>
        </section>
        <section class="posts">
            @foreach($posts as $post)
                <a href="/post/{{$post->id}}/">
                    <div class="card post">
                        <img class="card-img-top" src="{{$post->getPicture()}}">
                            <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">{{$post->content}}</p>
                        </div>
                        <div class="post-overflow"></div>
                    </div>
                </a>
            @endforeach
        </section>
    </div>
    @include('footer')
</body>
<script src="{{asset('js/all.js')}}"></script>
</html>