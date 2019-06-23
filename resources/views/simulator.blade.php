<!DOCTYPE html>
<html>
<head>
	<title>Match simulator</title>
	<meta charset="utf-8">

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<script src="{{ asset('js/app.js') }}" defer></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
</head>
<body>
	<div id="app">
		<simulator></simulator>
	</div>
</body>
</html>