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
			<div id="social-links">
				<a id="twitter" href="https://twitter.com/NoelDeMartin"></a>
				<a id="linkedin" href="http://www.linkedin.com/pub/noel-de-martin-fernandez/41/a7b/64"></a>
				<a id="gmail" href="mailto:noeldemartin@gmail.com"></a>
			</div>
			<div id="header-wrapper">
				<div id="header-content">
					<img src="/img/myface.png">
					<h1>NOEL<br>DE MARTIN</h1>
				</div>
			</div>
		</header>
		<nav>
			<ul>
				<li {{ Request::is('blog')? 'class="active"' : '' }} >
					{{ HTML::linkRoute('blog', 'BLOG') }}
				</li><li {{ Request::is('about')? 'class="active"' : '' }} >
					{{ HTML::linkRoute('about', 'ABOUT ME') }}
				</li><li {{ Request::is('experiments')? 'class="active"' : '' }} >
					{{ HTML::linkRoute('experiments', 'EXPERIMENTS') }}
				</li><li id="chilli">
					<a href="http://www.lincolnschilli.com"></a>
				</li>
			</ul>
		</nav>
		<div id="main-content" class="container">
			<div class="row">
				<div class="alert alert-info" role="alert">
					<b>Hi!</b> This week I am attending {{ HTML::link('https://www.apps-world.net/europe/', 'AppsWorld') }} in London.
				</div>
			</div>
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