<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Laser Tag</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="{{ asset('css/admin_layout_style.css') }}" rel="stylesheet">
    <!-- Bulma Version 0.7.4-->
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.7.4/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 

    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="container big_container">
        <div class="columns">
            <div class="column is-3 nav_aside_container">
                <aside class="menu is-hidden-mobile">
                    <p class="menu-label">
                        Általános
                    </p>
                    <ul class="menu-list">
                        <li><a class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'is-active' : '' }}" href="{{ url('/admin/dashboard') }}">Vezérlőpult</a></li>
                        <li><a class="{{ Route::currentRouteName() == 'admin.users' ? 'is-active' : '' }}" href="{{ url('/admin/users') }}">Felhasználók</a></li>
                    </ul>
                    <p class="menu-label">
                        Adminisztráció
                    </p>
                    <ul class="menu-list">
                        <li><a class="{{ Route::currentRouteName() == 'admin.reservations' ? 'is-active' : '' }}" href="{{ url('/admin/reservations') }}">Foglalások</a></li>
                        <li><a class="{{ Route::currentRouteName() == 'admin.packages' ? 'is-active' : '' }}" href="{{ url('/admin/packages') }}">Csomagok kezelése</a></li>
                    </ul>
                    <p class="menu-label">
                        Műveletek
                    </p>
                    <ul class="menu-list">
                        <li><a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Kijelentkezés </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form></li>
                    </ul>
                </aside>
            </div>
            <div id="app" class="column is-9 admin_content is-paddingless">
                <section class="hero is-info welcome is-small">
                    <div class="hero-body">
                        <div class="container">
                            <h1 class="title">
                                @yield('hero_title')
                            </h1>
                            <h2 class="subtitle">
                                @yield('hero_subtitle')
                            </h2>
                        </div>
                    </div>
                </section>
                <section class="admin_section">
                    @yield('section')

                </section>
            </div>
        </div>
    </div>
    <script async type="text/javascript" src="../js/bulma.js"></script>
</body>

</html>