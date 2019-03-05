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
    <link href="{{ asset('css/reset_style.css') }}" rel="stylesheet">

</head>
<body>
    <div class="reset_container">
        <div class="reset">
            <h1 class="title is-4">Jelszócsere</h1>
            <form class="reset_form" method="POST" action="{{ url('password/reset') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

                <div class="field">
                    <p class="control is-expanded has-icons-right">
                    <input class="input is-fullwidth input-radius" id="email" type="email" placeholder="E-mail" {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus>

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
                        <input id="password" class="input is-fullwidth input-radius" type="password" placeholder="Jelszó" {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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
                    <p class="control has-icons-right">
                        <input class="input is-fullwidth input-radius" id="password-confirm" type="password"{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Jelszó újra" name="password_confirmation" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                        <span class="icon is-small is-right">
                          <i class="fas fa-lock"></i>
                        </span>
                    </p>
                </div>

                <button type="submit" class="button is-info is-fullwidth">
                    Jelszócsere
                </button>
            </form>
        </div>
    </div>
</body>
<footer>
    Footer
</footer>
</html>
