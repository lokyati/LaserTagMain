<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LaserTag</title>

    <!-- Scripts--> 
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <!--dns-prefetch: It is a way to speed up web pages by pre-resolving DNS. -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500&amp;subset=latin-ext" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/profil_style.css') }}" rel="stylesheet">

</head>
<body>
    <div class="navbar">
    <ul>
    <!-- Authentication Links -->
    @if (Auth::guard('admin')->check() || Auth::guard()->check())
        <li class="dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    @if (Auth::guard('admin')->check())
                        Admin
                    @else 
                        {{ Auth::user()->name }} 
                    @endif
                    <span class="caret"></span>
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if (Auth::guard('admin')->check())
                        <a class="dropdown-item" href="{{ url('/admin/dashboard') }}">Vezérlőpult</a> <!--admin eseteben nincs fooldal csak a dashboard-->
                        <a class="dropdown-item" href=""
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Kijelentkezés') }}
                        </a>
                    @else   
                        <a class="dropdown-item" href="{{ url('/home') }}">Fooldal</a> <!--a felhasznalo alapbol a fooldalra kerul, a profilt (sajat dashboardjat) a profilom fullel eri el-->
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Kijelentkezés') }}
                            </a>
                    @endif
                    

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
    @else
    

        <li><a class="user_button" href="{{ route('login') }}">{{ __('Felhasználó') }}</a></li>
        <li><a class="registration_button" href="{{ route('register') }}">{{ __('Regisztráció') }}</a></li>
    @endif
</ul>
</div>
<div id="app">
    <userProfil></userProfil>
</div>
</body>
<footer>
    Footer
</footer>
</html>