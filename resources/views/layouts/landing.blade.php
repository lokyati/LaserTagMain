<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>LaserTag</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <link href="{{ asset('css/landing_style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500&amp;subset=latin-ext" rel="stylesheet"> 

	<!-- Scripts--> 
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

</head>
<body>
	<div class="page">
		<div id="info" class="header">
			Szeretnél többet megtudni? <a @click="showModal = true">Kattints ide!</a>

			<infomodal v-if="showModal" @close="showModal = false"></infomodal>
		</div>

		<div class="containers columns  is-marginless">
			<div class="user column is-half">
				<h2>
					Visszatérő játékos
				</h2>
				<a class="button is-info is-large" href="{{ route('login') }}">Belépés</a>
			</div>
			<div class="guest column">
				<h2>
					Új játékos
				</h2>
				<a class="button is-info is-large" href="{{ route('register') }}">Regisztráció</a>
			</div>
		</div>
	</div>
<footer id="footer">
	Footer - 
	@if (Auth::guard('user')->check())
        <a class="admin_button" href="{{ route('admin.login') }}" style="display: none;"></a>
    @else 
        <a class="admin_button" href="{{ route('admin.login') }}">
            {{ __('Admin belépés') }}
        </a>
    @endif
	<gdprmodal v-if="showModal" @close="showModal = false"></gdprmodal>

	<a @click="showModal = true">Adatvédelmi tájékoztató</a>
</footer>
</body>
</html>