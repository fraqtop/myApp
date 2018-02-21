<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{URL::asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <script src="{{URL::asset('js/all.js')}}"></script>
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
    <nav>
        <a href="#">home</a>
        <a href="#">blog</a>
        <a href="#">contact</a>
    </nav>
</header>
</div>
@yield('content')
<footer>
    <div class="copyright"><h5>Copyright &copy; 2018, designed and made by Vanya Pralov</h5></div>
    <a href="#"><img src="{{Url::asset('img/icon-gmail.png')}}"></a>
    <a href="#"><img src="{{Url::asset('img/icon-google.png')}}"></a>
    <a href="#"><img src="{{Url::asset('img/icon-instagram.png')}}"></a>
    <a href="#"><img src="{{Url::asset('img/icon-vk.png')}}"></a>
</footer>
</body>
</html>