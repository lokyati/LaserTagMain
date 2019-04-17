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
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

    <!-- Fonts -->
    <!--dns-prefetch: It is a way to speed up web pages by pre-resolving DNS. -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500&amp;subset=latin-ext" rel="stylesheet"> 

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link href="{{ asset('css/admin_style.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    Admin
                <span class="caret"></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ url('/admin/dashboard') }}">Vezérlőpult</a> 
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Kijelentkezés') }}
              </a>
                

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
          </li>
        </ul>
      </div>
  </div>
</nav>

<main class="py-4">
    @yield('content')
</main>
<footer>
    Footer 
</footer>
</div>
</body>
</html>
