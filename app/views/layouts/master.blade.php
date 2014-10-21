<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>Noel De Martin</title>

		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- stylesheets -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/main.css">

		@yield('styles')
	</head>

	<body>
		<header>
			<h1>NOEL DE MARTIN</h1>
		</header>
		<div id="main-content" class="container">
			@if (!in_array(Route::getCurrentRoute()->getName(), ['home', 'login', 'register']) || (Route::getCurrentRoute()->getName() == 'home' && Auth::check() && Auth::user()->is_admin) )
				<br>
				<div class="alert alert-info" role="alert">You are logged in as <b>{{ Auth::user()->username }}</b> {{ HTML::linkRoute('logout', '(Logout)') }}</div>
			@endif
			@yield('content')
		</div>

		<div id="bootstrap-cdn-check" class="hidden" style="height:1px;"></div>

		<!-- JQuery and Bootstrap with fallbacks - http://eddmann.com/posts/providing-local-js-and-css-resources-for-cdn-fallbacks/ -->
		<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script>window.jQuery.fn.modal || document.write('<script src="js/bootstrap.min.js"><\/script>')</script>

		<!-- StyleSheet CDN Fallbacks - http://theericbutler.wordpress.com/2014/03/20/how-to-fall-back-to-a-local-bootstrap-css-file-if-the-cdn-is-down/ -->
		<script>
			if ($('#bootstrap-cdn-check').is(':visible') === true) {
				$('<link rel="stylesheet" type="text/css" href="/css/fallbacks/bootstrap.min.css">').appendTo('head');
			}
		</script>

		{{ HTML::script('js/main.js') }}

		@yield('scripts')

		@include('assets.analytics')
	</body>
</html>