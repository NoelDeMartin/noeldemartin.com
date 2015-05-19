@extends('layouts.experiment')

@section('styles')
	<style type="text/css">

		#username {
			margin: 10px;
		}

		#board {
			display: block;
			width: 100%;
			height: 150px;
			margin: 10px;
			background: #e3e3e3;
		}

	</style>
@stop

@section('content')
	<div class="container">
		<h1>Online Meeting Tool - Room <span id="room-name" /></h1>
		<table id="users" class="table table-bordered" />
		<canvas id="board" />
	</div>
@stop

@section('scripts')

	<script src="https://cdn.firebase.com/js/client/2.2.4/firebase.js"></script>
	{!! Html::script('js/experiments/online-meeting.js') !!}

	<script type="text/javascript">
		var $users = $('#users'),
			$board = $('#board');

		// Enter Room
		initRoom('{{ $roomKey }}', function(room) {
			$('#room-name').text(room.name);

			var username;
			do {
				username = prompt('Please, confirm your username', '{{ \Faker\Factory::create()->username }}');
			} while (username == null);

			// Set Listeners
			room.setListeners({
				onNewUser: function(user) {
					$users.append('<tr style="background-color:' + user.drawingColor + ';" class="room" id="user-' + user.key + '"><td>' + user.name + '</td></tr>');
				},
				onUserLeave: function(user) {
					$('#user-' + user.key).remove();
				},
				onBoardUpdated: function(paths) {
					// Clears the canvas
					var canvasContext = $board[0].getContext('2d');
					canvasContext.clearRect(0, 0, canvasContext.canvas.width, canvasContext.canvas.height);

					$.each(paths, function(userKey, paths) {
						// Define stroke
						canvasContext.strokeStyle = room.users[userKey].drawingColor;
						canvasContext.lineJoin = "round";
						canvasContext.lineWidth = 3;

						// Draw paths
						paths.forEach(function (path) {
							if (path['x'].length > 1) {
								var x, y,
									xs = path['x'],
									ys = path['y'],
									prevX = xs[0],
									prevY = ys[0];
								canvasContext.beginPath();
								for (var i = 1, finalI = xs.length; i < finalI; i++) {
									x = xs[i - 1],
									y = ys[i - 1];
									canvasContext.moveTo(prevX, prevY);
									canvasContext.lineTo(x, y);
									prevX = x;
									prevY = y;
								}
								canvasContext.closePath();
								canvasContext.stroke();
							}
						});
					});
				}
			});

			// Enter room
			room.enter(username, function() {
				// Init canvas
				var isDrawing = false;
				$board.mousedown(function(event) {
					isDrawing = true;
					room.startLocalDrawingPath(event.pageX - $board[0].offsetLeft, event.pageY - $board[0].offsetTop);
				});
				$board.mousemove(function(event) {
					if (isDrawing) {
						room.addLocalDrawingPoint(event.pageX - $board[0].offsetLeft, event.pageY - $board[0].offsetTop);
					}
				});
				$board.mouseup(function(event) {
					isDrawing = false;
				});
				$board.mouseout(function(event) {
					isDrawing = false;
				});
			});

		});

		// Prepare Board
		function fixBoardDimensions() {
			$board.attr('width', $board.width());
			$board.attr('height', $board.height());
		}
		$(window).resize(function() {
			fixBoardDimensions();
		});
		fixBoardDimensions();

	</script>

@stop