<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{URL::asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{URL::asset('style/main.css')}}">
    <link rel="stylesheet" href="{{URL::asset('style/bootstrap/dist/css/bootstrap.min.css')}}">
    <script src="{{URL::asset('js/jquery/dist/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <script src="{{URL::asset('style/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('js/main.js')}}"></script>
    <title>fraqtop's</title>
</head>
<body>
<div class="top">
    <div id="particles-js"></div>
    <div class="jumbotron" id="override_jumbotron">
        <div class="container">
            <h1>Welcome, I'm Vanya Pralov.</h1>
            <p>Glad to meet you here.</p>
        </div>
    </div>
    <nav>
        <a href="/">about</a>
        <a href="/posts/">blog</a>
    </nav>
</div>
@yield('content')
<footer id="footer">
    <div class="copyright">
        &#169 Designed and made by Vanya Pralov, 2017.
    </div>
    @if(Auth::check())
        <a href="/logout" id="sign_link">sign out {{Auth::user()->name}}</a>
    @else
        <a href="/login" id="sign_link">sign in</a>
    @endif
    <div class="contacts">
        <a href="#"> <img src="{{URL::asset('img/icon-gmail.png')}}" alt=""> </a>
        <a href="#"><img src="{{URL::asset('img/icon-google.png')}}" alt=""></a>
        <a href="#"><img src="{{URL::asset('img/icon-instagram.png')}}" alt=""></a>
        <a href="#"><img src="{{URL::asset('img/icon-vk.png')}}" alt=""></a>
    </div>
</footer>
</body>
</html>