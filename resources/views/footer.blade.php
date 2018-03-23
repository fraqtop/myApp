<footer>
    <div class="copyright">Copyright &copy; 2018, designed and made by Vanya Pralov</div>
    @if (Auth::check())
        <div class="auth">Hello, <a href="/profile">{{Auth::user()->name}}</a></div>
    @else
        <div class="auth">Hello, you can log in <a href="/login">here</a></div>
    @endif
    <a href="#"><img src="{{asset('img/icon-gmail.png')}}"></a>
    <a href="#"><img src="{{asset('img/icon-google.png')}}"></a>
    <a href="#"><img src="{{asset('img/icon-instagram.png')}}"></a>
    <a href="#"><img src="{{asset('img/icon-vk.png')}}"></a>
</footer>