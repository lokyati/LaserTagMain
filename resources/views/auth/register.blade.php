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
            <input name="lvl" type="hidden" value="1">
            <input name="battle_points" type="hidden" value="0">
            <input name="experience" type="hidden" value="0">
            <input name="rank_id" type="hidden" value="1">
            <input name="all_shot" type="hidden" value="0">
            <input name="all_hit" type="hidden" value="0">
            <input name="all_out" type="hidden" value="0">
            <input name="matches" type="hidden" value="0">
            <input name="wins" type="hidden" value="0">
            <input name="loses" type="hidden" value="0">
            <input name="bestplace" type="hidden" value="0">
            <input name="avg_shot" type="hidden" value="0">
            <input name="avg_acc" type="hidden" value="0">
            <input name="avg_hit" type="hidden" value="0">
            <div class="field has-text-centered pt40">
                Már tag vagy? 
                <a class="has-text-info" href="{{ route('login') }}">Jelentkezz be itt</a>
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
