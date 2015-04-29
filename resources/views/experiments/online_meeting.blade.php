@extends('layouts.experiment')

@section('styles')
	<style type="text/css">
		#users .user {
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
		function MeetingUser() {
			var myself = this;
			myself.peersData = {};
			myself.id = userCounter++;
			myself.onMessage = function(user, message) {
				// empty
				console.debug('I am ' + myself.id + ' message received from ' + user.id + ' is: ' + message);
			}
			myself.requestConnect = function(user, otherConnection) {
				var connection = createConnection(user);
				myself.peersData[user.id] = {'user'			: user,
											'connection'	: otherConnection,
											'master'		: false,
											'channels'		: []};
				return connection;
			}
			myself.connect = function(user) {
					// Create channel and connections
					var connection = createConnection(user);
					var channel = createChannel(user, connection, 'default');
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
				myself.peersData[user.id] = {'user'			: user,
											'connection'	: otherConnection,
											'master'		: true,
											'channels'		: [channel]};
			}
			myself.broadcastMessage = function(message) {
				for (peerId in myself.peersData) {
					for (channel in myself.peersData[peerId]['channels']) {
						myself.peersData[peerId]['channels'][channel].send(message);
					}
				}
			}

			// private methods
			function createChannel(user, connection, name) {
				var channel = connection.createDataChannel(name);
				channel.onmessage = function(event) {
					myself.onMessage(user, event.data);
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
					myself.peersData[user.id]['channels'].push(event.channel);
					event.channel.onmessage = function(event) {
						myself.onMessage(user, event.data);
					}
					event.channel.onerror = function(event) {
						console.debug(event);
					}
				}

				return connection;
			}
		}

		// Methods & Main
		var users = [];

		function addUser() {
			var user = new MeetingUser();
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
			$users.append('<div class="user"></div>');
			addUser();
		});
		$('#test').click(function() {
			getUser(0).broadcastMessage('This is a message from 0!!!');
			getUser(1).broadcastMessage('This is a message from 1!!!');
		});
		$('#new-user').trigger('click');
	</script>

@stop