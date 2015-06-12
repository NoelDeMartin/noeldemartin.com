@extends('layouts.experiment')

@section('styles')
	<style type="text/css">

		html, body, #room, #loading {
			width: 100%;
			height: 100%;
		}

		#loading {
			position: absolute;
			display: table;
			background: #eee;
			opacity: 0.7;
			z-index: 10;
		}

		#loading .loading-text {
			display: table-cell;
			vertical-align: middle;
			text-align: center;
			font-size: 10rem;
		}

		#room-name {
			text-align: center;
			font-size: 3rem;
			position: fixed;
			width: 100%;
			top: 0;
			left: 0;
			right: 0;
		}

		#board {
			position: absolute;
			background: #e3e3e3;
			border: 1px dotted #666;
		}

		.side-panel {
			background: white;
			width: 20%;
			height: 100%;
		}

		.side-panel .title {
			font-size: 3rem;
			padding: 1rem;
			background: #e3e3e3;
			border-bottom: 0.25rem solid #aaa;
			margin-bottom: 0;
		}

		#info {
			float: left;
			border-right: 0.5rem solid #aaa;
		}

		#info #controls {
			padding: 0.5rem;
		}

		#info #controls .control {
			width: 100%;
		}

		#info #controls h3 {
			margin-bottom: 0;
		}

		#info #users {
			border-top: 0.25rem solid #aaa;
			overflow-y: auto;
			margin: 0;
		}

		#info #users .user {
			font-size: 1.75rem;
			padding: 0.5rem;
		}

		#info #users .user.local {
			font-size: 2rem;
			font-weight: bold;
			text-decoration: underline;
		}

		#info #users .audio {
			cursor: pointer;
			float: right;
			margin-right: 5px;
		}

		#chat {
			float: right;
			border-left: 0.5rem solid #aaa;
		}

		#chat #messages {
			overflow-y: auto;
			margin-bottom: 0;
		}

		#chat #messages .message {
			padding: 0.5rem;
			border-bottom: 1px dashed #aaa;

		}

		#chat #messages .message.local {
			background-color: #eee;
		}

		#chat #new-message {
			padding: 5px;
		}

		#chat #new-message textarea {
			box-sizing: border-box;
			height: 100%;
			width: 80%;
			float: left;
			resize: none;
			border-radius: 15px 0 0 15px;
			border: 1px solid #bbb;
			padding: 5px
		}

		#chat #new-message input[type="submit"] {
			box-sizing: border-box;
			height: 100%;
			width: 20%;
			margin: 0;
			float: right;
			border-radius: 0 15px 15px 0;
			border: 1px solid #bbb;
		}

	</style>
@stop

@section('content')
	<div id="loading">
		<div class="loading-text">Loading...</div>
	</div>
	<div id="room">
		<div id="info" class="side-panel">
			<p class="title">Room Info</p>
			<div id="controls">
				<div class="form-group">
					<label for="color-picker">Pick Color:</label>
					<input id="color-picker" name="color-picker" type="range" value="0" min="0" max="360" />
				</div>
				<div class="form-group">
					<button id="clear-board" class="btn btn-primary control">Clear Board</button>
				</div>
				<div class="form-group">
					<button id="enable-audio" class="btn btn-primary control">Enable Audio</button>
					<button id="disable-audio" class="btn btn-danger control hidden">Disable Audio</button>
				</div>
				<h3>Users:</h3>
			</div>
			<ul id="users" class="list-unstyled"></ul>
		</div>
		<span id="room-name">Room Name</span>
		<canvas id="board" ></canvas>
		<div id="chat" class="side-panel">
			<p class="title">Chat</p>
			<ul id="messages" class="list-unstyled">
			</ul>
			<form id="new-message" class="form-inline">
				<textarea></textarea>
				<input type="submit" class="btn btn-primary" value="Send" />
			</form>
		</div>
	</div>
@stop

@section('scripts')

	<script src="https://cdn.firebase.com/js/client/2.2.4/firebase.js"></script>
	{!! Html::script('js/experiments/online-meeting.js') !!}

	<script type="text/javascript">
		var $loading = $('#loading'),
			$roomName = $('#room-name'),
			$info = $('#info'),
			$chat = $('#chat'),
			$infoTitle = $info.find('.title'),
			$chatTitle = $chat.find('.title'),
			$controls = $('#controls'),
			$users = $('#users'),
			$board = $('#board'),
			$messages = $('#messages'),
			$newMessageForm = $('#new-message'),
			$newMessageTextarea = $newMessageForm.find('textarea');
		var roomRef;

		// Enter Room
		initRoom('{{ $roomKey }}', function(room) {
			$roomName.text(room.name);
			roomRef = room;

			var username;
			var names = ['Cow', 'Cat', 'Dog', 'Bull', 'Donkey', 'Bat', 'Bee', 'Bear', 'Camel', 'Cheetah', 'Chicken', 'Snake',
							'Crocodile', 'Crow', 'Fish', 'Duck', 'Eagle', 'Elephant', 'Lemur', 'Panda', 'Fox', 'Frog', 'Goat', 'Turtle',
							'Horse', 'Koala', 'Lion', 'Tiger', 'Monkey', 'Mouse', 'Octopus', 'Penguin', 'Pig', 'Rabbit'],
				adjectives = ['Dangerous', 'Funny', 'Twisted', 'Awesome', 'Lucky', 'Fancy', 'Red', 'Green', 'Blue', 'Dead', 'Lazy',
								'Old', 'Young', 'Strong', 'Electric', 'Fat', 'Kind', 'Nice', 'Good', 'Bad', 'Wise', 'Plastic'];
			do {
				username = prompt('Please, confirm your username',
									adjectives[Math.floor(Math.random()*adjectives.length)] + ' ' + names[Math.floor(Math.random()*names.length)]);
			} while (username == null);

			// Set Listeners
			room.setListeners({
				onNewUser: function(user) {
					var $user = $('<li class="user" id="user-' + user.key + '">' + user.name + '</li>');
					$user.css('background-color', user.drawingColor);
					$user.append('<span class="audio hidden glyphicon glyphicon-volume-up"></span>');
					if (room.isLocalUser(user)) {
						$user.addClass('local');
					}
					$users.append($user);
				},
				onUserUpdated: function(user) {
					var $user = $('#user-'+user.key);
					$user.css('background-color', user.drawingColor);
				},
				onUserLeave: function(user) {
					$('#user-' + user.key).remove();
				},
				onBoardUpdated: drawBoard,
				onChatMessage: function(user, message) {
					var $message = $('<li class="message"><strong>' + user.name + ':</strong> ' + message + '</li>');
					if (room.isLocalUser(user)) {
						$message.addClass('local');
					}
					$messages.append($message);
				},
				onEnableAudio: function(user) {
					$('#user-'+user.key+' .audio').removeClass('hidden');
				},
				onDisableAudio: function(user) {
					$('#user-'+user.key+' .audio').addClass('hidden');
				}
			});

			// Enter room
			room.enter(username, function() {
				// Init Controls
				var $colorPicker = $('#color-picker'),
					$enableAudio = $('#enable-audio'),
					$disableAudio = $('#disable-audio');
				$colorPicker.change(function(event) {
					room.updateLocalUserColor($colorPicker.val());
				});
				$('#clear-board').click(function(event) {
					room.clearLocalUserPaths();
				});
				$enableAudio.click(function(event) {
					room.enableAudio();
					$disableAudio.removeClass('hidden');
					$enableAudio.addClass('hidden');
				});
				$disableAudio.click(function(event) {
					room.disableAudio();
					$enableAudio.removeClass('hidden');
					$disableAudio.addClass('hidden');
				});

				$users.delegate('.audio', 'click', function() {
					var $audio = $(this),
						userKey = $audio.parent('.user').attr('id').substring('user-'.length);
					$audio.toggleClass('glyphicon-volume-up');
					$audio.toggleClass('glyphicon-volume-off');
					if ($audio.hasClass('glyphicon-volume-up')) {
						room.startUserAudio(userKey);
					} else {
						room.stopUserAudio(userKey);
					}
				});

				// Init canvas
				var isDrawing = false;
				$board.on('touchstart', function(event) {
					event.preventDefault();
					isDrawing = true;
					var touch = event.originalEvent.touches[0] || event.originalEvent.changedTouches[0];
					room.startLocalDrawingPath((touch.pageX - $board[0].offsetLeft)/$board.width(),
													(touch.pageY - $board[0].offsetTop)/$board.height());
				});
				$board.on('touchmove', function(event) {
					if (isDrawing) {
						event.preventDefault();
						var touch = event.originalEvent.touches[0] || event.originalEvent.changedTouches[0];
						room.addLocalDrawingPoint((touch.pageX - $board[0].offsetLeft)/$board.width(),
													(touch.pageY - $board[0].offsetTop)/$board.height());
					}
				});
				$board.on('mousedown', function(event) {
					isDrawing = true;
					room.startLocalDrawingPath((event.pageX - $board[0].offsetLeft)/$board.width(),
													(event.pageY - $board[0].offsetTop)/$board.height());
				});
				$board.on('mousemove', function(event) {
					if (isDrawing) {
						room.addLocalDrawingPoint((event.pageX - $board[0].offsetLeft)/$board.width(),
													(event.pageY - $board[0].offsetTop)/$board.height());
					}
				});
				$board.on('touchend touchleave touchcancel mouseup mouseout', function(e) {
					isDrawing = false;
				});

				// Init Chat
				$newMessageForm.submit(function(event) {
					if (event.preventDefault) {
						event.preventDefault();
					}

					room.sendChatMessage($newMessageTextarea.val());

					return false;
				});

				$loading.remove();
			});
		});

		// Prepare Board
		var $window = $(window);
		$window.ready(function() {
			function fixDimensions() {
				var screenWidth = $window.width(),
					screenHeight = $window.height(),
					chatTitleHeight = $chatTitle.outerHeight(),
					boardDimensions = Math.min(screenWidth - $chat.width() - $info.width(), screenHeight)*0.9;
				$users.css('max-height', (screenHeight - $infoTitle.outerHeight() - $controls.outerHeight()) + 'px');
				$board.css('top', Math.max($roomName.outerHeight(), (screenHeight/2 - boardDimensions/2)) + 'px');
				$board.css('left', (screenWidth/2 - boardDimensions/2) + 'px');
				$board.attr('width', boardDimensions);
				$board.attr('height', boardDimensions);
				$messages.css('height', (screenHeight - chatTitleHeight)*0.8 + 'px');
				$newMessageForm.css('height', (screenHeight - chatTitleHeight)*0.2 + 'px');
			}
			$window.resize(function() {
				fixDimensions();
				if (roomRef != null) {
					drawBoard(roomRef.boardPaths);
				}
			});
			fixDimensions();
		});

		function drawBoard(paths) {
			// Clears the canvas
			var canvasContext = $board[0].getContext('2d'),
				width = $board.width(),
				height = $board.height();
			canvasContext.clearRect(0, 0, width, height);

			$.each(paths, function(userKey, paths) {
				var user = roomRef.users[userKey];
				if (typeof user != 'undefined') {
					// Define stroke
					canvasContext.strokeStyle = user.drawingColor;
					canvasContext.lineJoin = "round";
					canvasContext.lineWidth = 3;

					// Draw paths
					paths.forEach(function (path) {
						if (path['x'].length > 1) {
							var x, y,
								xs = path['x'],
								ys = path['y'],
								prevX = xs[0] * width,
								prevY = ys[0] * height;
							canvasContext.beginPath();
							for (var i = 1, finalI = xs.length; i < finalI; i++) {
								x = xs[i - 1] * width,
								y = ys[i - 1] * height;
								canvasContext.moveTo(prevX, prevY);
								canvasContext.lineTo(x, y);
								prevX = x;
								prevY = y;
							}
							canvasContext.closePath();
							canvasContext.stroke();
						}
					});
				}
			});
		}

	</script>

@stop