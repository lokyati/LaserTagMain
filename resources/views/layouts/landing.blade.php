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
    <script src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" defer></script>

</head>
<body>
	@include('cookieConsent::index')
	<div class="page">
		<div class="header" id="header">
			<infomodal v-if="showModal" @close="showModal = false"></infomodal>

			Szeretnél többet megtudni? <a @click="showModal = true">Kattints ide!</a>
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
</body>
</html>