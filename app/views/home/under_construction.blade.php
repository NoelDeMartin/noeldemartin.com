<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>Noel De Martin - Under Construction</title>

		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="css/under-construction.css">
	</head>

	<body>

		<div id="top">
			@if (Auth::check() && Auth::user()->is_reviewer)
				<div id="alert">
					Hello Reviewer! You can check which posts are pending <b>{{ HTML::linkRoute('posts.index', 'here') }}</b>. Cheers, and thanks for contributing.
				</div>
			@endif
			@include('assets.twitter')
			@include('assets.linkedin')
		</div>

		<table id="under-construction">
			<tr><td>
				<img src="img/under-construction.png">
			</td></tr>
		</table>

		<h1 id="title">Under<br>Construction</h1>

		@include('assets.analytics')

	</body>
</html>