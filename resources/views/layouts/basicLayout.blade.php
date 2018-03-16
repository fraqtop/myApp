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
@yield('content')
<footer>
    <div class="copyright"><h5>Copyright &copy; 2018, designed and made by Vanya Pralov</h5></div>
    @if (Auth::check())
        <div class="auth">Hello, <a href="/profile">{{Auth::user()->name}}</a></div>
    @else
        <div class="auth">Hello, you can log in <a href="/login">here</a></div>
    @endif
    <a href="#"><img src="{{Url::asset('img/icon-gmail.png')}}"></a>
    <a href="#"><img src="{{Url::asset('img/icon-google.png')}}"></a>
    <a href="#"><img src="{{Url::asset('img/icon-instagram.png')}}"></a>
    <a href="#"><img src="{{Url::asset('img/icon-vk.png')}}"></a>
</footer>
</body>
</html>