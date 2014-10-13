<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>Noel De Martin - Under Construction</title>

		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<style type="text/css">
			body, html {
				height: 100%;
			}
			body {
				background: #d8d8d8;
				background-image: url('img/bits.png');
				margin: 0;
			}
			#under-construction {
				max-width: 1200px;
				height: 750px;
				margin: auto;
				position: relative;
				margin-top: -5%;
			}
			#under-construction h1 {
				font-family: Verdana, Geneva, sans-serif;
				font-size: 130px;
				position: absolute;
				left: 0;
				bottom: 0;
				margin: 0;
			}
			#under-construction img {
				position: absolute;
				right: 0;
				top: 0;
			}
			#alert {
				position: absolute;
				left: 5%;
				right: 5%;
				top: 2%;
				color: #8A6D3B;
				background-color: #FCF8E3;
				padding: 15px;
				margin-bottom: 20px;
				border: 1px solid #FAEBCC;
				border-radius: 4px;
				z-index: 10;
			}
			a {
				color: #428BCA;
				text-decoration: none;
			}
		</style>
	</head>

	<body>
		@if (Auth::check() && Auth::user()->isReviewer())
			<div id="alert">
				Hello Reviewer! You can check which posts are pending <b>{{ HTML::linkRoute('posts.index', 'here') }}</b>. Cheers, and thanks for contributing.
			</div>
		@endif
		<div style="display: table;height: 100%; width: 100%;">
			<div style="display: table-cell; vertical-align: middle;">
				<div id="under-construction">
					<h1>Under <br> Construction</h1>
					<img src="img/under-construction.png" width="700px">
					@include('assets.twitter')
				</div>
			</div>
		</div>
		@include('assets.analytics')
	</body>
</html>