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
    <link href="{{ asset('css/register_style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">

</head>
<body>
<div class="register_container"> 
    <div class="register">
        <form class="register_form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="field">
              <p class="control">
                <input id="name" class="input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" placeholder="Felhasználónév" name="name" required autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </p>
            </div>
            <div class="field">
              <p class="control">
                <input id="password" class="input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Jelszó" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </p>
            </div>
            <div class="field">
              <p class="control">
                <input id="password-confirm" class="input form-control" type="password" placeholder="Jelszó újra" name="password_confirmation" required>
              </p>
            </div>
        <div class="field">
          <p class="control">
            <input id="email" class="input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" placeholder="Email" name="email" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </p>
        </div>
            <div id="footer">
            <label class="checkbox">
              <input type="checkbox" required>
              Elfogadom a <a @click="showModal = true">Felhasználási feltételeket</a>
            </label>
                <gdprmodal v-if="showModal" @close="showModal = false"></gdprmodal>
            </div>

            <div class="field">
              <p class="control">
                <button type="submit" class="button is-info is-fullwidth">
                  Regisztráció
                </button>
              </p>
            </div>
            <div class="divider"></div>
            <div class="field has-text-centered pt40">
                Már tag vagy? 
                <a class="has-text-info" href="{{ route('login') }}">Jelentkezz be itt</a>
            </div>
        </form> 
    </div>
</div>
</body>
<footer id="footer">
    <div class="columns">
        <div class="column is-half">
            <p class="title is-4 has-text-white">Cimünk</p>
            <p class="subtitle is-8 has-text-white">Csíkszereda, Hargita megye, Szabadság tér, 1. szám, 530104</p>
            <gdprmodal v-if="showModal" @close="showModal = false"></gdprmodal>
            <p class="subtitle is-8 has-text-white"><a @click="showModal = true">Adatvédelmi tájékoztató</a></p>
            <p class="subtitle is-8 has-text-white">© 2019 LaserTag</p>
        </div>
        <div class="column">
            <p class="title is-4 has-text-white">Keress minket a közösségi oldalakon is</p>
            <div class="icon_container">
              <div class="facebook_icon"></div>
              <div class="twitter_icon"></div>
              <div class="instagram_icon"></div>
            </div>
        </div>
    </div>
</footer>
</html>
