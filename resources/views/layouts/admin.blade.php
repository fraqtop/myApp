<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>fraqtop</title>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/eggplant/jquery-ui.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}?{{File::lastModified('css/style.css')}}" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicon.png')}}">
</head>
<body>
<div class="admin-container">
    <div></div>
    <div class="panel">
        <a href="/">home</a>
        <a href="/admin">traffic</a>
        <a href="/admin/categories">categories</a>
        <a href="/football">football</a>
        <a href="/admin/tasks">tasks</a>
        <a href="/admin/avatar">avatar</a>
    </div>
    <div class="admin-frame">
        @yield('content')
    </div>
</div>
<script src="{{ asset('js/all.js') }}?{{File::lastModified('js/all.js')}}"></script>
</body>
@yield('script')
</html>