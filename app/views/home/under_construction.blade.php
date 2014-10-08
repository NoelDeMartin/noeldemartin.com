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
		</style>
	</head>

	<body>
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