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
            <h1>Vanya Pralov</h1>
            <p>web developer</p>
        </div>
    </div>
    <nav>
        <a href="/">home</a>
        <a href="/blog/">blog</a>
        <a href="/contact/">contact</a>
    </nav>
</header>
<div class="header_pillow"></div>
@yield('content')
<footer>
    <div class="copyright"><h5>Copyright &copy; 2017, designed and made by Vanya Pralov</h5></div>
    <a href="#"><img src="{{Url::asset('img/icon-gmail.png')}}"></a>
    <a href="#"><img src="{{Url::asset('img/icon-google.png')}}"></a>
    <a href="#"><img src="{{Url::asset('img/icon-instagram.png')}}"></a>
    <a href="#"><img src="{{Url::asset('img/icon-vk.png')}}"></a>
</footer>
</body>
</html>