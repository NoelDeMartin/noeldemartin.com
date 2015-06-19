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

		.bootbox {
			display: table;
			width: 100%;
			height: 100%;
		}

		.bootbox .modal-dialog {
			display: table-cell;
			vertical-align: middle;
			padding: 0 10%;
		}

		#room-title {
			text-align: center;
			position: fixed;
			padding: 1rem 0;
			width: 58%;
			top: 0;
			left: 21%;
		}

		#room-title #room-name {
			font-size: 3rem;
		}

		#room-title #alerts .alert {
			margin: 10px;
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

		#chat #message {
			width: 100%;
			padding: 5px;
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
		<div id="room-title">
			<span id="room-name">Room Name</span>
			<button id="refresh" class="btn btn-primary">
				<span class="glyphicon glyphicon-refresh"></span> Refresh
			</button>
			<ul id="alerts" class="list-unstyled"/>
		</div>
		<canvas id="board" ></canvas>
		<div id="chat" class="side-panel">
			<p class="title">Chat</p>
			<ul id="messages" class="list-unstyled">
			</ul>
			<div id="message">
				<input type="text" class="form-control" id="new-message" placeholder="Say something...">
			</div>
		</div>
	</div>
@stop

@section('scripts')

	<!-- TODO add fallbacks -->
	<script src="https://cdn.firebase.com/js/client/2.2.4/firebase.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	{!! Html::script('js/experiments/bootbox.min.js') !!}
	{!! Html::script('js/experiments/online-meeting.js') !!}

	<script type="text/javascript">
		var $loading = $('#loading'),
			$roomTitle = $('#room-title'),
			$roomName = $roomTitle.find('#room-name'),
			$refresh = $roomTitle.find('#refresh'),
			$alerts = $roomTitle.find('#alerts'),
			$info = $('#info'),
			$infoTitle = $info.find('.title'),
			$controls = $info.find('#controls'),
			$users = $info.find('#users'),
			$board = $('#board'),
			$chat = $('#chat'),
			$chatTitle = $chat.find('.title'),
			$messages = $chat.find('#messages'),
			$message = $chat.find('#message'),
			$newMessage = $message.find('#new-message');
		var room = null,
			fixDimensions = function() {};

		// Prepare Room
		var $window = $(window);
		$window.ready(function() {
			fixDimensions = function() {
				var screenWidth = $window.width(),
					screenHeight = $window.height(),
					chatTitleHeight = $chatTitle.outerHeight(),
					boardDimensions = Math.min(screenWidth - $chat.width() - $info.width(), screenHeight - $roomTitle.outerHeight())*0.9;
				$users.css('max-height', (screenHeight - $infoTitle.outerHeight() - $controls.outerHeight()) + 'px');
				$board.css('top', Math.max($roomTitle.outerHeight(), (screenHeight/2 - boardDimensions/2)) + 'px');
				$board.css('left', (screenWidth/2 - boardDimensions/2) + 'px');
				$board.attr('width', boardDimensions);
				$board.attr('height', boardDimensions);
				$messages.css('height', (screenHeight - chatTitleHeight - $message.outerHeight()) + 'px');
			}
			$window.resize(function() {
				fixDimensions();
				if (room != null) {
					drawBoard(room.boardPaths);
				}
			});
			fixDimensions();
		});
		$refresh.click(function() {
			$refresh.removeClass('btn-primary');
			$refresh.addClass('disabled');
			$refresh.html('Refreshing...');
			$loading.removeClass('hidden');
			room.refresh(function() {
				$refresh.removeClass('disabled');
				$refresh.addClass('btn-primary');
				$refresh.html('<span class="glyphicon glyphicon-refresh"></span> Refresh');
				$loading.addClass('hidden');
				drawBoard(room.boardPaths);
			});
		});

		initRoom('{{ $roomKey }}', function(roomRef) {
			room = roomRef;
			$roomName.text(room.name);

			var names = ['Cow', 'Cat', 'Dog', 'Bull', 'Donkey', 'Bat', 'Bee', 'Bear', 'Camel', 'Cheetah', 'Chicken', 'Snake',
							'Crocodile', 'Crow', 'Fish', 'Duck', 'Eagle', 'Elephant', 'Lemur', 'Panda', 'Fox', 'Frog', 'Goat', 'Turtle',
							'Horse', 'Koala', 'Lion', 'Tiger', 'Monkey', 'Mouse', 'Octopus', 'Penguin', 'Pig', 'Rabbit'],
				adjectives = ['Dangerous', 'Funny', 'Twisted', 'Awesome', 'Lucky', 'Fancy', 'Red', 'Green', 'Blue', 'Dead', 'Lazy',
								'Old', 'Young', 'Strong', 'Electric', 'Fat', 'Kind', 'Nice', 'Good', 'Bad', 'Wise', 'Plastic'],
				promptData = {
					title: 'Please, confirm your username',
					value: adjectives[Math.floor(Math.random()*adjectives.length)]
								+ ' ' + names[Math.floor(Math.random()*names.length)],
					closeButton: false,
					callback: function(result) {
						if (!result || result.length == 0) {
							bootbox.prompt(promptData);
							return;
						}
						if (room.audioAvailable) {
							// Prepare audio objects (necessary to work in mobile, fore more info see: https://mauricebutler.wordpress.com/2014/02/22/android-chrome-does-not-allow-applications-to-play-html5-audio-without-an-explicit-action-by-the-user/
							var audioObjects = [], audio;
							for (var i = 0; i < 10; i++) {
								audio = document.createElement('audio');
								audio.load();
								audioObjects.push(audio);
							};
							room.initAudio(audioObjects);
						}
						startRoom(result);
					}
				};
			bootbox.prompt(promptData);
		});

		function startRoom(username) {
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
				onChatMessage: appendChatMessage,
				onEnableAudio: enableAudio,
				onDisableAudio: function(user) {
					room.stopUserAudio(user.key);
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

				if (room.audioAvailable) {
					for (i in room.enabledAudios) {
						enableAudio(room.users[room.enabledAudios[i]]);
					}
				}

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
				drawBoard(room.boardPaths);

				// Init Chat
				$newMessage.keypress(function(event) {
					if (event.which == 13) {
						event.preventDefault();
						var text = $newMessage.val().trim();
						$newMessage.val('');
						if (text.length > 0) {
							room.sendChatMessage(text);
						}
					}
				});

				var message;
				for (i in room.chatMessages) {
					message = room.chatMessages[i];
					appendChatMessage(room.users[message.user], message.message);
				}

				// Final modifications
				if (!room.audioAvailable) {
					$enableAudio.addClass('hidden');
					addMessage('Audio is not available in your browser', 'warning');
				}

				$loading.addClass('hidden');
			});
		}

		function drawBoard(paths) {
			// Clears the canvas
			var canvasContext = $board[0].getContext('2d'),
				width = $board.width(),
				height = $board.height();
			canvasContext.clearRect(0, 0, width, height);

			$.each(paths, function(userKey, paths) {
				var user = room.users[userKey];
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

		function appendChatMessage(user, message) {
			var userName = user? user.name : 'Unkown';
			var $message = $('<li class="message"><strong>' + userName + ':</strong> ' + message + '</li>');
			if (room.isLocalUser(user)) {
				$message.addClass('local');
			}
			$messages.append($message);
		}

		function enableAudio(user) {
			if (user) {
				room.startUserAudio(user.key);
				$('#user-'+user.key+' .audio').removeClass('hidden');
			}
		}

		function addMessage(text, type) {
			$alerts.append('<li class="alert alert-' + type + '" role="alert">' + text + '</li>');
			fixDimensions();
		}

	</script>

@stop