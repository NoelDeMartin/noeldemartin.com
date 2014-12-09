<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>{{ $title }}</title>

		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- stylesheets -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

		@yield('styles')
	</head>

	<body>
		@yield('content')

		<!-- JQuery and Bootstrap with fallbacks - http://eddmann.com/posts/providing-local-js-and-css-resources-for-cdn-fallbacks/ -->
		<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>

		@yield('scripts')

		@include('assets.analytics')
	</body>
</html>