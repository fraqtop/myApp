<footer>
    <div class="copyright">Copyright &copy; 2018, designed and made by fraqtop</div>
    @if (Auth::check())
        <div class="auth">Hello, <a href="/profile">{{Auth::user()->name}}</a></div>
    @else
        <div class="auth">Hello, you can log in <a href="/login">here</a></div>
    @endif
    <a href="https://github.com/fraqtop"><img src="{{asset('img/icon-github.png')}}"></a>
    <a href="https://www.instagram.com/fraqtop.rb"><img src="{{asset('img/icon-instagram.png')}}"></a>
    <a href="https://vk.com/best_freestyler"><img src="{{asset('img/icon-vk.png')}}"></a>
    <a href="https://www.facebook.com/roman.bukhantsov.9"><img src="{{asset('img/icon-facebook.png')}}"></a>
</footer>