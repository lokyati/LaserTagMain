<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LaserTag</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500&amp;subset=latin-ext" rel="stylesheet"> 

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                @if (Auth::guard('admin')->check())
                    <a class="navbar-brand" href="{{ url('/admin/dashboard') }}">
                        LaserTag - Admin felulet
                    </a>
                @else 
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        LaserTag
                    </a>
                @endif
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    
                    <!-- Navbar for User -->
                    @if (Auth::guard('user')->check() || Auth::guard()->check())
                        <ul>
                          <li><a href="{{ url('/calendar') }}">Foglalás</a></li>
                        </ul> 
                    @else

                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if (Auth::guard('admin')->check() || Auth::guard()->check())
                            <li class="nav-item dropdown">
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
                                            <a class="dropdown-item" href="{{ url('/profil') }}">Profilom</a> <!--a felhasznalo alapbol a fooldalra kerul, a profilt (sajat dashboardjat) a profilom fullel eri el-->
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
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <footer>
            Footer <br>
            @if (Auth::guard('user')->check())
                <a class="admin_button" href="{{ route('admin.login') }}" style="display: none;"></a>
            @else 
                <a class="admin_button" href="{{ route('admin.login') }}">
                    {{ __('Admin belépés') }}
                </a>
            @endif
            
        </footer>
    </div>
</body>
</html>
