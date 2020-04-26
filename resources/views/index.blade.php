<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <title>fraqtop</title>
</head>
<body>
<div id="#navigation" class="pillow">
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
<div class="sections-menu">
  <div class="section-link" id="nav-link"><i class="fas fa-star"></i></div>
  <div class="section-link" id="info-link"><i class="fas fa-star"></i></div>
  <div class="section-link" id="knowledge-link"><i class="fas fa-star"></i></div>
  <div class="section-link" id="posts-link"><i class="fas fa-star"></i></div>
</div>
<div class="grid-container">
  <section class="info" id="info">
    <div class="profile-image">
      <img src="{{$picture}}">
    </div>
    <article>
      Hi, my name is Roman, nice to meet you here. I'm web
      developer from Moscow. I like creating awesome and helpful things
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
  <section id="knowledge" class="p-2 container">
    <div class="skills-container">
      <div class="skill">
        <i class="fab fa-php fa-2x" style="color: #6c8ef0"></i>
        <div id="php" class="line"></div>
      </div>
      <div class="skill">
        <i class="fab fa-python fa-2x" style="color: #DBC200;"></i>
        <div id="python" class="line"></div>
      </div>
      <div class="skill">
        <i class="fab fa-git fa-2x" style="color: #FF473D"></i>
        <div id="git" class="line"></div>
      </div>
      <div class="skill">
        <i class="fas fa-database fa-2x" style="color: #6c8ef0;"></i>
        <div id="t-sql" class="line"></div>
      </div>
      <div class="skill">
        <i class="fab fa-sass fa-2x" style="color: #FF8585"></i>
        <div id="scss" class="line"></div>
      </div>
      <div class="skill">
        <i class="fab fa-bootstrap fa-2x" style="color: #9000AD"></i>
        <div id="bootstrap" class="line"></div>
      </div>
      <div class="skill">
        <i class="fab fa-gulp fa-3x" style="color: #FF473D"></i>
        <div id="gulp" class="line"></div>
      </div>
      <div class="skill">
        <i class="fab fa-vuejs fa-2x" style="color: #00B344"></i>
        <div id="vue" class="line"></div>
      </div>
      <div class="skill">
        <i class="fab fa-js-square fa-2x" style="color: #DBC200"></i>
        <div id="js" class="line"></div>
      </div>
      <div class="skill">
        <i class="fab fa-laravel fa-2x" style="color: #FF473D"></i>
        <div id="laravel" class="line"></div>
      </div>
    </div>
  </section>
  <section class="posts" id="posts">
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
<script src="{{asset('js/all.js')}}"></script>
<script>
  $(document).ready(function () {
    let animationDuration = 1000
    $('#nav-link').click(() => {$('html, body').animate({scrollTop: $('body').offset().top}, animationDuration);})
    $('#info-link').click(() => {$('html, body').animate({scrollTop: $('#info').offset().top}, animationDuration);})
    $('#knowledge-link').click(() => {$('html, body').animate({scrollTop: $('#knowledge').offset().top}, animationDuration);})
    $('#posts-link').click(() => {$('html, body').animate({scrollTop: $('#posts').offset().top}, animationDuration);})
  })
  particlesJS.load('particles-js', 'js/particles.json', function () {});
</script>
</html>