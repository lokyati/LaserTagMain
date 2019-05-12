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
    <link href="{{ asset('css/email_style.css') }}" rel="stylesheet">

</head>
<body>
    <div class="reset_container">
        <div class="reset">
            <h1 class="title is-4">Jelszócsere</h1>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="reset_form" method="POST" action="{{ url('password/email') }}">
            @csrf
                <div class="field">
                  <p class="control is-expanded has-icons-right">
                    <input class="input is-fullwidth input-radius" id="email" type="email" placeholder="E-mail" {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                <button type="submit" class="button is-info is-fullwidth">
                    Jelszó csere igénylése
                </button>
            </form>
        </div>
    </div>
</body>
<footer>
</footer>
</html>
