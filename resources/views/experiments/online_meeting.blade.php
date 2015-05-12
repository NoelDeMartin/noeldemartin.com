@extends('layouts.experiment')

@section('styles')
	<style type="text/css">

		#rooms {
			border: 1px solid #e3e3e3;
			padding: 15px;
			padding: 15px;
		}

		#room .board {
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
		<h1>Online Meeting Tool (<span id="user"></span>)</h1>

		<div id="rooms">
			<table id="rooms-list" class="table table-bordered"></table>
			<form id="new-room" class="form-inline">
				<input type="text" class="form-control" />
				<a class="btn btn-primary">New Room</a>
			</form>
		</div>

		<div id="room">
			<h2>Room <span class="name"></span></h2>
			<canvas class="board"></canvas>
			<table class="table table-bordered users"></table>
		</div>

		<!--<a id="new-user" class="btn btn-primary">New User</a>
		<a id="test" class="btn btn-primary">Test</a>

		<div id="users"></div>-->
	</div>
@stop

@section('scripts')

	<script src="https://cdn.firebase.com/js/client/2.2.4/firebase.js"></script>

	<script type="text/javascript">

		var firebase = new Firebase('https://brilliant-fire-1291.firebaseio.com'),
			roomsRef = firebase.child('rooms'),
			usersRef = firebase.child('users'),
			roomRef, roomUsersRef;
		var user;
		var $user = $('#user'),
			$room = $('#room'),
			$roomName = $room.find('.name'),
			$roomUsers = $room.find('.users'),
			$roomBoard = $room.find('.board'),
			$newRoomForm = $('#new-room'),
			$newRoomButton = $newRoomForm.find('a'),
			$newRoomInput = $newRoomForm.find('input'),
			$roomsList = $('#rooms-list');

		// Populate Rooms
		roomsRef.on('child_added', function(snapshot) {
			addRoom(snapshot.key(), snapshot.val());
		}, function (error) {
			console.log('The rooms listener failed: ' + error.code);
		});

		$roomsList.on('click', '.room', function() {
			var $room = $(this);
			enterRoom($room.data('key'), $room.data('data'));
		});

		// Initialize user
		var userKey = '-Jp2wwFF77u6l1AYgGVo'; // NoelDeMartin
		var userKey = '-Jp2wt2APC6rJXtUIhG8'; // JinJiD
		//var userKey = '-Jp2wxrI5Los6eh_luDt'; // Guetaa
		usersRef.child(userKey).once('value', function(snapshot) {
			user = new MeetingUser(userKey, snapshot.val());
			$user.text(user.name);
		}, function (error) {
			console.log('Error login user: ' + error.code);
		});

		// New Room
		$newRoomButton.click(function() {
			var newRoom = {
				name: $newRoomInput.val(),
				users: []
			};
			roomsRef.push(newRoom, function(error) {
				if (error != null) {
					console.debug('Error creating new room: ' + error.code);
				}
			});
		});

		// Prepare Board
		$roomBoard.attr('width', $roomBoard.width());
		$roomBoard.attr('height', $roomBoard.height());

		/** Methods **/
		function addRoom(roomKey, room) {
			var $newRoom = $('<tr class="room"><td><a href="javascript:void(0);">' + room.name + '</a></td></tr>');
			$newRoom.data('key', roomKey);
			$newRoom.data('data', room);
			$roomsList.append($newRoom);
		}

		function enterRoom(roomKey, room) {
			roomRef = roomsRef.child(roomKey);
			roomUsersRef = roomRef.child('users');
			roomBoardPathsRef = roomRef.child('board-paths');

			// Update HTML
			$roomName.text(room.name);
			$roomUsers.empty();

			// Enter room
			roomUsersRef.once('value', function(snapshot) {
				// Login user if not already inside
				var inside = false;
				var users = snapshot.val();
				for (key in users) {
					if (users[key].key == user.key) {
						inside = true;
						break;
					}
				}
				if (!inside) {
					roomUsersRef.push(user.toJSON(), function(error) {
						if (error != null) {
							console.debug('Error creating entering user to room: ' + error.code);
						} else {
							for (key in users) {
								user.connect(users[key].key);
							}
						}
					});
				}

				// Listen and retrieve room users
				roomUsersRef.on('child_added', function(snapshot) {
					var peer = snapshot.val();
					$roomUsers.append('<tr class="room"><td>' + peer.name + '</td></tr>');
				}, function (error) {
					console.log('The room users listener failed: ' + error.code);
				});
			});
		}

		/** Classes **/
		function MeetingUser(userKey, user) {
			// Constructor
			var myself = this;
			myself.key = userKey;
			myself.name = user.name;
			myself.peers = {};
			myself.drawingColor = getRandomColor();
			myself.isDrawing = false;
			myself.boardPaths = {};

			// Setup signaling listener
			var userSignalingRef = usersRef.child(userKey + '/signaling');
			userSignalingRef.on('child_added', function(snapshot) {
				var signalingData = snapshot.val();
				if (signalingData.session.type == 'offer') {
					var connection = createConnection(signalingData.origin);
					connection.setRemoteDescription(new mozRTCSessionDescription(signalingData.session), function() {
						connection.createAnswer(function(answer) {
							connection.setLocalDescription(answer, function() {
								usersRef.child(signalingData.origin + '/signaling').push({origin: myself.key, session: answer.toJSON()}, function(error) {
									if (error == null) {
										userSignalingRef.child(snapshot.key()).remove(function(error) {
											if (error != null) {
												onError('Removing signaling data', error);
											} else {
												console.debug('connected (answerer)!');
											}
										});
									} else {
										onError('Sending answer signaling data', error);
									}
								});
							}, function() {
								onError('Setting local description', error);
							});
						}, function(error) {
							onError('Creating answer', error);
						});
					}, function(error) {
						onError('Setting remote description', error);
					});
				} else { // answer
					var connection = myself.peers[signalingData.origin]['connection'];
					connection.setRemoteDescription(new mozRTCSessionDescription(signalingData.session), function() {
						userSignalingRef.child(snapshot.key()).remove(function(error) {
							if (error != null) {
								onError('Removing signaling data', error);
							} else {
								console.debug('connected (caller)!');
							}
						});
					}, function(error) {
						onError('Setting remote description', error);
					});
				}
			}, function (error) {
				console.log('ICE listener failed: ' + error.code);
			});

			// Setup ICE listener
			var userIceRef = usersRef.child(userKey + '/ice');
			userIceRef.on('child_added', function(snapshot) {
				var iceData = snapshot.val();
				myself.peers[iceData.origin]['connection'].addIceCandidate(new mozRTCIceCandidate(iceData.candidate), function() {
					// consume ICE candidate
					userIceRef.child(snapshot.key()).remove(function(error) {
						if (error != null) {
							onError('Removing ICE data', error);
						}
					});
				}, function(error) {
					onError('Adding ICE candidate', error);
				});
			}, function (error) {
				onError('ICE listener', error);
			});

			// Init canvas
			$roomBoard.mousedown(function(event) {
				// Create new path
				startBoardPath(myself.key, myself.drawingColor);
				myself.isDrawing = true;
				$.each(myself.peers, function(key, peerData) {
					peerData['channels']['board'].send(JSON.stringify({type: 'start-path', origin: myself.key, color: myself.drawingColor}));
				});
			});
			$roomBoard.mousemove(function(event) {
				if (myself.isDrawing) {
					var point = {
						x: event.pageX - $roomBoard[0].offsetLeft,
						y: event.pageY - $roomBoard[0].offsetTop
					};
					addBoardPathPoint(myself.key, point);
					$.each(myself.peers, function(key, peerData) {
						peerData['channels']['board'].send(JSON.stringify({type: 'point', origin: myself.key, point: point}));
					});
				}
			});
			$roomBoard.mouseup(function(event) {
				myself.isDrawing = false;
			});

			/** Public Methods **/
			myself.connect = function(peerKey) {
				var connection = createConnection(peerKey);
				createChannel(peerKey, 'board');

				// Send Offer
				connection.createOffer(function (offer) {
					connection.setLocalDescription(offer, function() {
						usersRef.child(peerKey + '/signaling').push({origin: myself.key, session: offer.toJSON()}, function(error) {
							if (error != null) {
								onError('Sending offer signaling data', error);
							}
						});
					}, function(error) {
						onError('Setting local description', error);
					});
				}, function(error) {
					onError('Creating offer', error);
				});
			}
			myself.toJSON = function() {
				return {
					key: myself.key,
					name: myself.name
				};
			}
			myself.sendMessage = function(message) {
				$.each(myself.peers, function(key, peerData) {
					$.each(peerData.channels, function(label, channel) {
						channel.send(message);
					});
				});
			}

			/** Private Methods **/
			function getRandomColor() {
				var letters = '0123456789ABCDEF'.split('');
				var color = '#';
				for (var i = 0; i < 6; i++ ) {
					color += letters[Math.floor(Math.random() * 16)];
				}
				return color;
			}
			function createConnection(peerKey) {
				var peerData = {
					connection: new mozRTCPeerConnection(null),
					iceRef: usersRef.child(peerKey + '/ice'),
					channels: {}
				};
				myself.peers[peerKey] = peerData;

				// Setup ICE
				peerData['connection'].onicecandidate = function(event) {
					if(event.candidate != null) {
						peerData.iceRef.push({origin: myself.key, candidate: event.candidate.toJSON()}, function(error) {
							if (error != null) {
								onError('Sending ICE candidate', error);
							}
						});
					}
				}

				// Listen to opened channels
				peerData['connection'].ondatachannel = function(event) {
					var channelLabel = event.channel.label;
					peerData['channels'][channelLabel] = event.channel;
					var theChannel = event.channel;
					event.channel.onmessage = function(event) {
						onMessage(channelLabel, peerKey, event.data);
					}
					event.channel.onerror = function (error) {
						onError('Channel onError', error);
					};
				}

				return peerData['connection'];
			}
			function createChannel(peerKey, name) {
				var channel = myself.peers[peerKey]['connection'].createDataChannel(name);
				var channelLabel = channel.label;
				channel.onmessage = function(event) {
					onMessage(channelLabel, peerKey, event.data);
				}
				channel.onerror = myself.onError;
				myself.peers[peerKey]['channels'][channelLabel] = channel;
				return channel;
			}
			function startBoardPath(userKey, color) {
				if (typeof myself.boardPaths[userKey] == 'undefined') {
					myself.boardPaths[userKey] = [];
				}
				myself.boardPaths[userKey].push({color: color, x: [], y: []});
			}
			function addBoardPathPoint(userKey, point) {
				var path = myself.boardPaths[userKey][myself.boardPaths[userKey].length -1];
				path['x'].push(point.x);
				path['y'].push(point.y);
				drawBoard();
			}
			function drawBoard() {
				// Clears the canvas
				var canvasContext = $roomBoard[0].getContext('2d');
				canvasContext.clearRect(0, 0, canvasContext.canvas.width, canvasContext.canvas.height);
				$.each(myself.boardPaths, function(peerKey, paths) {
					paths.forEach(function (path) {

						// Define stroke
						canvasContext.strokeStyle = path['color'];
						canvasContext.lineJoin = "round";
						canvasContext.lineWidth = 3;

						// Draw path
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
			function onMessage(channelLabel, peerKey, message) {
				if (channelLabel == 'board') {
					var message = JSON.parse(message);
					// TODO use arraybuffer instead
					if (message.type == 'start-path') {
						startBoardPath(message.origin, message.color);
					} else { // path point
						addBoardPathPoint(message.origin, message.point);
					}
					drawCanvas();
				} else {
					console.debug('Message received on non-board channel (' + channelLabel + '): ' + message);
				}
			}
			function onError(message, error) {
				console.debug('Error: ' + message);
				console.debug(error);
			}
		}

	</script>

	<!-- Peer Connection -->
	<script type="text/javascript">
	/*
		var userCounter = 0;

		// Classes
		function MeetingUser(canvas) {
			var myself = this;
			myself.id = userCounter++;
			myself.peersData = {};
			myself.canvasContext = canvas[0].getContext('2d');
			myself.drawingData = {'active' : false, 'colors' : {}, 'paths' : {}};
			myself.drawingData['colors'][myself.id] = getRandomColor();
			myself.drawingData['paths'][myself.id] = [];
			myself.onMessage = function(channelLabel, user, message) {
				if (channelLabel == 'board') {
					// TODO use arraybuffer instead
					if (message == 'new-path') {
						myself.drawingData['paths'][user.id].push({'x' : [], 'y' : []});
					} else { // path point
						var coords = message.split(' '),
							path = myself.drawingData['paths'][user.id][myself.drawingData['paths'][user.id].length - 1];
						path['x'].push(parseFloat(coords[0]));
						path['y'].push(parseFloat(coords[1]));
					}
					drawCanvas();
				} else {
					console.debug('I am ' + myself.id + ' message received from ' + user.id + ' in channel ' + channelLabel + ' is: ' + message);
				}
			}
			myself.requestConnect = function(user, otherConnection) {
				var connection = createConnection(user);
				myself.drawingData['paths'][user.id] = [];
				myself.drawingData['colors'][user.id] = user.drawingData['colors'][user.id];
				myself.peersData[user.id] = {'user'			: user,
											'connection'	: otherConnection,
											'master'		: false,
											'channels'		: {},
											'paths'			: []};
				return connection;
			}
			myself.connect = function(user) {
					// Create channel and connections
					var connection = createConnection(user);
					var channels = [createChannel(user, connection, 'broadcast'),
										createChannel(user, connection, 'board')];
					var otherConnection = user.requestConnect(myself, connection);

					// Send offer and answer
					connection.createOffer(function (offer) {
					connection.setLocalDescription(offer, function() {
						otherConnection.setRemoteDescription(new mozRTCSessionDescription(offer), function() {
							otherConnection.createAnswer(function(answer) {
								otherConnection.setLocalDescription(answer, function() {
									connection.setRemoteDescription(new mozRTCSessionDescription(answer), function() {}, function(event) {
										console.debug('error');
										console.debug(event);
									});
								},
								function (event) {
									console.debug('error');
									console.debug(event);
								});
							}, function(event) {
								console.debug('error');
								console.debug(event);
							});
						},
						function (event) {
							console.debug('error');
							console.debug(event);
						});
					}, function(event) {
						console.debug('error');
						console.debug(event);
					});
				},
				function (error) {
					console.debug('error');
					console.debug(event);
				});

				// Store data
				myself.drawingData['paths'][user.id] = [];
				myself.drawingData['colors'][user.id] = user.drawingData['colors'][user.id];
				myself.peersData[user.id] = {'user'			: user,
											'connection'	: otherConnection,
											'master'		: true,
											'channels'		: {}};
				channels.forEach(function(channel) {
					myself.peersData[user.id]['channels'][channel.label] = channel;
				});
			}
			myself.broadcastMessage = function(message) {
				$.each(myself.peersData, function(peerId, peerData) {
					peerData['channels']['broadcast'].send(message);
				});
			}

			// Init canvas
			canvas.mousedown(function(event) {
				// Create new path
				myself.drawingData['active'] = true;
				myself.drawingData['paths'][myself.id].push({'x' : [], 'y' : []});
				$.each(myself.peersData, function(peerId, peerData) {
					peerData['channels']['board'].send('new-path');
				});

				// Add point
				processDrawingEvent(event);
				drawCanvas();
			});
			canvas.mousemove(function(event) {
				if (myself.drawingData['active']) {
					processDrawingEvent(event);
					drawCanvas();
				}
			});
			canvas.mouseup(function(event) {
				myself.drawingData['active'] = false;
			});

			// private methods
			function getRandomColor() {
				var letters = '0123456789ABCDEF'.split('');
				var color = '#';
				for (var i = 0; i < 6; i++ ) {
					color += letters[Math.floor(Math.random() * 16)];
				}
				return color;
			}
			function createChannel(user, connection, name) {
				var channel = connection.createDataChannel(name);
				var channelLabel = channel.label;
				channel.onmessage = function(event) {
					myself.onMessage(channelLabel, user, event.data);
				}
				channel.onerror = function(event) {
					console.debug(event);
				}
				return channel;
			}
			function createConnection(user) {
				var connection = new mozRTCPeerConnection(null);
				connection.onicecandidate = function(event) {
					if(event.candidate != null) {
						myself.peersData[user.id]['connection'].addIceCandidate(event.candidate, function(){}, function(event) {
							console.debug(event);
						});
					}
				}

				// Listen to opened channels
				connection.ondatachannel = function(event) {
					var channelLabel = event.channel.label;
					myself.peersData[user.id]['channels'][channelLabel] = event.channel;
					var theChannel = event.channel;
					event.channel.onmessage = function(event) {
						myself.onMessage(channelLabel, user, event.data);
					}
					event.channel.onerror = function(event) {
						console.debug(event);
					}
				}

				return connection;
			}
			function processDrawingEvent(event) {
				var path = myself.drawingData['paths'][myself.id][myself.drawingData['paths'][myself.id].length - 1],
					x = event.pageX - canvas[0].offsetLeft,
					y = event.pageY - canvas[0].offsetTop;

				path['x'].push(x);
				path['y'].push(y);

				$.each(myself.peersData, function(peerId, peerData) {
					peerData['channels']['board'].send(x + ' ' + y);
				});
			}
			function drawCanvas() {
				// Clears the canvas
				var canvasContext = myself.canvasContext;
				canvasContext.clearRect(0, 0, canvasContext.canvas.width, canvasContext.canvas.height);

				$.each(myself.drawingData['paths'], function(userId, paths) {
					// Define stroke
					canvasContext.strokeStyle = myself.drawingData['colors'][userId];
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
		}

		// Methods & Main
		var users = [];

		function addUser(canvas) {
			var user = new MeetingUser(canvas);
			for (other in users) {
				users[other].connect(user);
			}
			users.push(user);
		}

		function getUser(index) {
			return users[index];
		}

		*/
	</script>

	<!-- DOM manipulation -->
	<script type="text/javascript">
		/*var $users = $('#users');
		$('#new-user').click(function() {
			var canvas = $('<canvas class="user-canvas"></canvas>');
			canvas.appendTo($users);
			canvas.attr('width', canvas.width());
			canvas.attr('height', canvas.height());
			addUser(canvas);
		});
		$('#test').click(function() {
			getUser(0).broadcastMessage('This is a message from 0!!!');
			getUser(1).broadcastMessage('This is a message from 1!!!');
		});
		$('#new-user').trigger('click');
		*/
	</script>

@stop