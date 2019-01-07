<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Official site of fraqtop, also known as Roman Bukhantsov">
    <meta name="keywords" content="fraqtop, Roman Bukhantsov, Роман Буханцов, personal, web development, programming">
    @yield('external_meta')
    <title>fraqtop</title>
    <link href="{{ asset('css/style.css') }}?{{File::lastModified('css/style.css')}}" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicon.png')}}">
</head>
<body>
    <div class="soft-container">
        <nav class="min-dark-nav">
            <a href="/">home</a>
            <a href="/posts">blog</a>
            <a href="/football">football</a>
            <div class="nav-right">
            @guest
                <a href="/register">register</a>
                <a href="/login">login</a>
            @else
                <form action="/logout" method="post">
                    {{csrf_field()}}
                    <input type="submit" value="logout">
                </form>
            @endguest
            </div>
        </nav>
        <div class="nav-pillow"></div>
        @yield('content')
        @include('footer')
    </div>
    <script src="{{ asset('js/all.js') }}?{{File::lastModified('js/all.js')}}"></script>
    @yield('script')
</body>
</html>
