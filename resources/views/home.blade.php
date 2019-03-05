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
    <!-- defer: A script that will not run until after the page has loaded. -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <!--dns-prefetch: It is a way to speed up web pages by pre-resolving DNS. -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500&amp;subset=latin-ext" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="https://vuejs.org/js/vue.js"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
    />

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link href="{{ asset('css/home_style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/calendar.min.css') }}" rel="stylesheet">

</head>
<body>
<div class="page_container">
    <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
    <a>
      <img class="logo" src="{{asset('img/logo.png')}}">
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item">
        Főoldal
      </a>

      <a class="navbar-item">
        Foglalás
      </a>

      <a class="navbar-item" href="{{ url('/profil') }}">
        Profilom
      </a>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Egyéb
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            Rólunk
          </a>
          <a class="navbar-item">
            Kapcsolat
          </a>
        </div>
     </div>
     <a class="navbar-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();"> Kijelentkezés
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </a>
      </div>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        
    </div>
  </div>
</nav>

    <div class="page">
    <div class="carousel_container">
        
    </div>
    <div class="quick_book_container">
        
    </div>
    <div class="package_container">
        
    </div>
    <!--<div class="content">

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            Be vagy jelentkezve és a főoldalt látod.
            Neved: {{ Auth::user()->name }}
        </div>-->
        <div class="profil_info">
            Profil info
        </div>
    </div>
</div>
<footer>
</footer>
</div>
</body>
</html>