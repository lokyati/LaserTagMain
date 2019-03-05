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
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

    <!-- Fonts -->
    <!--dns-prefetch: It is a way to speed up web pages by pre-resolving DNS. -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500&amp;subset=latin-ext" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link href="{{ asset('css/adminLogin_style.css') }}" rel="stylesheet">

</head>
<body>
<div class="login_container">
    <div class="login">
        <h1 class="title is-4">Admin belépés</h1>
        <form class="login_form" method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="field">
              <p class="control is-expanded has-icons-right">
                <input class="input is-fullwidth" id="email" type="email" placeholder="E-mail cim" {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <span class="icon is-small is-right">
                  <i class="fas fa-envelope"></i>
                </span>
              </p>
            </div>
            <div class="field">
              <p class="control has-icons-right">
                <input id="password" class="input" type="password" placeholder="Jelszó" {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <span class="icon is-small is-right">
                  <i class="fas fa-lock"></i>
                </span>
              </p>
            </div>
            <div class="field">
              <p class="control">
                <button type="submit" class="button is-info is-fullwidth">
                  Bejelentkezés
                </button>
              </p>
            </div>
        </form>
    </div>
</div>
</body>
<footer>
    Footer
    @if (Auth::guard('user')->check())
                <a class="admin_button" href="{{ route('admin.login') }}" style="display: none;"></a>
            @else 
                <a class="admin_button" href="{{ route('admin.login') }}">
                    {{ __('Admin belépés') }}
                </a>
            @endif
</footer>
</html>
