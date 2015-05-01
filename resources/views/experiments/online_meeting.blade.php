@extends('layouts.experiment')

@section('styles')
	<style type="text/css">
		#users .user-canvas {
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
		<h1>Online Meeting Tool</h1>

		<a id="new-user" class="btn btn-primary">New User</a>
		<a id="test" class="btn btn-primary">Test</a>

		<div id="users"></div>
	</div>
@stop

@section('scripts')

	<!-- Peer Connection -->
	<script type="text/javascript">

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
	</script>

	<!-- DOM manipulation -->
	<script type="text/javascript">
		var $users = $('#users');
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
	</script>

@stop