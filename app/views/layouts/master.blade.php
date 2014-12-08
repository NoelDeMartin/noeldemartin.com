<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		@if (Route::is('posts.show'))
			<title>{{ $post->title }} | Noel De Martin</title>
			@include('assets.post_meta', $post)
		@else
			<title>Noel De Martin</title>
		@endif

		<meta name="pocket-site-verification" content="a7da21e29497dd96109d3eaf4d2529" />
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
				<a id="twitter" href="https://twitter.com/NoelDeMartin">Twitter</a>
				<a id="linkedin" href="http://www.linkedin.com/pub/noel-de-martin-fernandez/41/a7b/64">LinkedIn</a>
				<a id="gmail" href="mailto:noeldemartin@gmail.com">Email</a>
			</div>
			<div id="header-wrapper">
				<div id="header-content">
					<!-- Applied this: http://alistapart.com/article/responsive-images-in-practice -->
					<img src="/img/myface.png"
							alt="My Face"
							srcset="/img/myface.png 465w,
									/img/myface-small.png  200w"
							sizes="(min-width: 1170px) 555px, 47.5vw" />
					<h1>NOEL<br>DE MARTIN</h1>
				</div>
			</div>
		</header>
		<nav>
			<ul>
				<li {{ Route::is('blog')? 'class="active"' : '' }} >
					{{ HTML::linkRoute('blog', 'BLOG') }}
				</li><li {{ Route::is('about')? 'class="active"' : '' }} >
					{{ HTML::linkRoute('about', 'ABOUT ME') }}
				</li><li {{ Route::is('experiments')? 'class="active"' : '' }} >
					{{ HTML::linkRoute('experiments', 'EXPERIMENTS') }}
				</li><li id="chilli">
					<a href="http://www.lincolnschilli.com"></a>
				</li>
			</ul>
		</nav>
		<div id="main-content" class="container">
			@if (Session::has('message'))
				<div class="alert alert-info">{{ Session::get('message') }}</div>
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