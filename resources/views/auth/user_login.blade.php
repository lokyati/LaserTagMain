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
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/userLogin_style.css') }}" rel="stylesheet">

</head>
<body>
    <div class="back">
        <a href="{{url('/')}}">Vissza</a>
    </div>
	<div class="card">
        <div class="card-header">{{ __('Belépés') }}</div>

        <div class="card-body">
             <form method="POST" action="{{ route('login') }}">
            @csrf

                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail:') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        </div>
                </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Jelszó:') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Emlékezz rám') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                    {{ __('Belépés') }}
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Elfelejtetted a jelszavad?') }}
                            </a>
                        </div>
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