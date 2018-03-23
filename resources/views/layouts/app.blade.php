<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{URL::asset('favicon.ico')}}">
</head>
<body>
    <div class="soft-container">
        <nav class="min-dark-nav">
            <a href="/">home</a>
            <a href="/posts">blog</a>
            <a href="/contact">contact</a>
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
        @yield('content')
        @include('footer')
    </div>
    <script src="{{ asset('js/all.js') }}"></script>
</body>
</html>
