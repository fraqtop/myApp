<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}?{{ sha1(file_get_contents(asset('css/style.css'))) }}">
    <title>fraqtop</title>
</head>
<body>
    <div class="pillow">
        <header>
            <div id="particles-js"></div>
            <div class="hello-alert animated fadeIn">
                <h1>romAn buhAncoV</h1>
                <h4>web developer</h4>
            </div>
            <nav class="index-nav animated fadeInDown">
                <a href="/posts">blog</a>
                <a href="/contact">contact</a>
                <a href="/football">football</a>
            </nav>
        </header>
    </div>
    <div class="grid-container">
        <section class="info">
            <img src="{{$picture}}" style="opacity: 0.7">
            <article>
                Hi, my name is Roman, nice to meet you here. I'm web
                developer based in Ukhta city. I like creating awesome and helpful things
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
                <a href="/posts/{{$post->id}}/">
                    <div class="card post">
                        <img class="card-img-top" src="{{$post->getPicture()}}">
                            <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">{{$post->content}}</p>
                        </div>
                        <div class="post-overflow">{{ $post->updated_at }}</div>
                    </div>
                </a>
            @endforeach
        </section>
    </div>
    @include('footer')
</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<script src="{{asset('js/all.js')}}?{{ sha1(file_get_contents(asset('js/all.js'))) }}"></script>
<script>
    $(document).ready(function () {
        particlesJS.load('particles-js', 'js/particles.json', function() {});
        let infoSection = $(".info");
        let timingSection = $(".timing");
        let postsSection = $(".posts");
        infoSection.css("visibility", "hidden");
        timingSection.css("visibility", "hidden");
        postsSection.css("visibility", "hidden");
        let checkPoint = 350;
        window.onscroll = function () {
            if(infoSection.offset().top - window.pageYOffset < checkPoint)
            {
                infoSection.addClass("animated fadeInUp");
                infoSection.css("visibility", "visible");
            }
            if(timingSection.offset().top - window.pageYOffset < checkPoint)
            {
                timingSection.addClass("animated zoomIn");
                timingSection.css("visibility", "visible");
            }
            if(postsSection.offset().top - window.pageYOffset < checkPoint)
            {
                postsSection.addClass("animated zoomIn");
                postsSection.css("visibility", "visible");
            }
        };
    });
</script>
</html>