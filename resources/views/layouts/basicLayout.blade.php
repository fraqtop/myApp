<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{URL::asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <script src="{{URL::asset('js/all.js')}}"></script>
    <title>fraqtop's</title>
</head>
<body>
<header>
    <div id="particles-js"></div>
    <div class="jumbotron">
        <div class="container">
            <h1>Hello, I'm Vanya Pralov.</h1>
            <p>nice to meet you here.</p>
        </div>
    </div>
    <nav>
        <h1><a href="/">about</a></h1>
        <h1><a href="/posts">blog</a></h1>
    </nav>
</header>
@yield('content')
<footer>
    <div class="copyright">
        &#169 Designed and made by Vanya Pralov, 2017.
    </div>
    @if(Auth::check())
        <a href="/logout" id="sign_link">sign out {{Auth::user()->name}}</a>
    @else
        <a href="/login" id="sign_link">sign in</a>
    @endif
    <a href="#"> <img src="{{URL::asset('img/icon-gmail.png')}}" alt=""> </a>
    <a href="#"><img src="{{URL::asset('img/icon-google.png')}}" alt=""></a>
    <a href="#"><img src="{{URL::asset('img/icon-instagram.png')}}" alt=""></a>
    <a href="#"><img src="{{URL::asset('img/icon-vk.png')}}" alt=""></a>
</footer>
</body>
</html>