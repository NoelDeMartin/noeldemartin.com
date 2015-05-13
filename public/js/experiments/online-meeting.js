function loginUser(key, success) {
	var firebase = new Firebase('https://brilliant-fire-1291.firebaseio.com'),
		usersRef = firebase.child('users');
	usersRef.child(key).once('value', function(snapshot) {
		success(new User(key, snapshot.val()));
	}, function (error) {
		console.log('Error login user: ' + error.code);
	});
}

/* RoomsManager class */

function RoomsManager() {
	// Setup Public Attributes
	var myself = this;
	myself.rooms = {};

	// Setup Private Attributes
	var onNewRoom = function(room) {},
		onRoomClosed = function(room) {};

	// Setup server
	var firebase = new Firebase('https://brilliant-fire-1291.firebaseio.com'),
		roomsRef = firebase.child('rooms');

	roomsRef.on('child_added', function(snapshot) {
		var room = new Room(snapshot.key(), snapshot.val());
		myself.rooms[room.key] = room;
		onNewRoom(room);
	}, function (error) {
		console.log('Rooms added listener failed: ' + error.code);
	});

	roomsRef.on('child_removed', function(snapshot) {
		var room = myself.rooms[snapshot.key()];
		delete myself.rooms[snapshot.key()];
		onRoomClosed(room);
	}, function (error) {
		console.log('Rooms removed listener failed: ' + error.code);
	});


	/* Public Methods */
	myself.setListeners = function(listeners) {
		var defaultListeners = {
			onNewRoom: onNewRoom,
			onRoomClosed: onRoomClosed
		};
		var listeners = $.extend(defaultListeners, listeners);
		onNewRoom = listeners.onNewRoom;
		onRoomClosed = listeners.onRoomClosed;
	}
	myself.openNewRoom = function(user, roomName, success) {
		var roomRef = roomsRef.push({name: roomName}, function(error) {
			if (error == null) {
				if (typeof success == 'function') {
					success(myself.rooms[roomRef.key()]);
				}
			} else {
				console.log('Error creating new room: ' + error.code);
			}
		});
	}
};

/* Room class */

function Room(key, data) {
	// Setup Public Attributes
	var myself = this;
	myself.key = key;
	myself.name = data.name;
	myself.users = {};

	// Setup Private Attributes
	var onNewUser = function(user) {},
		onUserLeave = function(user) {},
		onBoardUpdated = function(boardData) {},
		roomRef = new Firebase('https://brilliant-fire-1291.firebaseio.com/rooms/' + myself.key),
		roomUsersRef = roomRef.child('users'),
		roomBoardPathsRef = roomRef.child('board-paths'),
		peers = null,
		localUserKey = null,
		localUserSignalingRef = null;

	/* Public Methods */
	myself.setListeners = function(listeners) {
		var defaultListeners = {
			onNewUser: onNewUser,
			onUserLeave: onUserLeave,
			onBoardUpdated: onBoardUpdated
		};
		var listeners = $.extend(defaultListeners, listeners);
		onNewUser = listeners.onNewUser;
		onUserLeave = listeners.onUserLeave;
		onBoardUpdated = listeners.onBoardUpdated;
	}
	myself.enter = function(user) {
		roomUsersRef.once('value', function(snapshot) {
			var roomPreviousUsers = snapshot.val();

			// Login user into room
			var localUserRef = roomUsersRef.push(user.toJSON(), function(error) {
				if (error == null) { // User was logged in correctly
					// Initialize local user
					peers = {};
					localUserKey = localUserRef.key();
					localUserSignalingRef = roomUsersRef.child(localUserKey).child('signaling');
					localUserICERef = roomUsersRef.child(localUserKey).child('ICE');

					setUpSignaling();
					setUpICE();

					// Connect with users
					for (peerKey in roomPreviousUsers) {
						connectWith(peerKey);
					}

					// Listen and retrieve room users
					roomUsersRef.on('child_added', function(snapshot) {
						var newUser = new RoomUser(snapshot.key(), snapshot.val());
						myself.users[newUser.key] = newUser;
						onNewUser(newUser);
					}, function (error) {
						console.log('The room users listener failed: ' + error.code);
					});
				} else {
					console.log('Error entering user to room: ' + error.code);
				}
			});
		});
	}
	// TODO remove this
	myself.sendMessage = function(message) {
		$.each(peers, function(key, peerData) {
			peerData['channels']['board'].send(message);
		});
	}

	/* Private Methods */
	function setUpSignaling() {
		localUserSignalingRef.on('child_added', function(snapshot) {
			var signalingData = snapshot.val();
			if (signalingData.session.type == 'offer') {
				var connection = createConnection(signalingData.origin);
				connection.setRemoteDescription(new mozRTCSessionDescription(signalingData.session), function() {
					connection.createAnswer(function(answer) {
						connection.setLocalDescription(answer, function() {
							roomUsersRef.child(signalingData.origin).child('signaling').push({origin: localUserKey, session: answer.toJSON()}, function(error) {
								if (error == null) {
									localUserSignalingRef.child(snapshot.key()).remove(function(error) {
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
				var connection = peers[signalingData.origin]['connection'];
				connection.setRemoteDescription(new mozRTCSessionDescription(signalingData.session), function() {
					localUserSignalingRef.child(snapshot.key()).remove(function(error) {
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
			console.log('Signaling listener failed: ' + error.code);
		});
	}
	function setUpICE() {
		localUserICERef.on('child_added', function(snapshot) {
			var iceData = snapshot.val();
			peers[iceData.origin]['connection'].addIceCandidate(new mozRTCIceCandidate(iceData.candidate), function() {
				// consume ICE candidate
				localUserICERef.child(snapshot.key()).remove(function(error) {
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
	}
	function connectWith(peerKey) {
		var connection = createConnection(peerKey);
		createChannel(peerKey, 'board');

		// Send Offer
		connection.createOffer(function (offer) {
			connection.setLocalDescription(offer, function() {
				roomUsersRef.child(peerKey).child('signaling').push({origin: localUserKey, session: offer.toJSON()}, function(error) {
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
	function createConnection(peerKey) {
		var peerData = {
			connection: new mozRTCPeerConnection(null),
			ICERef: roomUsersRef.child(peerKey).child('ICE'),
			channels: {}
		};
		peers[peerKey] = peerData;

		// Setup ICE
		peerData['connection'].onicecandidate = function(event) {
			if(event.candidate != null) {
				peerData.ICERef.push({origin: localUserKey, candidate: event.candidate.toJSON()}, function(error) {
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
				console.debug('message received');
				console.debug(event.data);
				// TODO onMessage(channelLabel, peerKey, event.data);
			}
			event.channel.onerror = function (error) {
				onError('Channel onError', error);
			};
		}

		return peerData['connection'];
	}
	function createChannel(peerKey, name) {
		var channel = peers[peerKey]['connection'].createDataChannel(name);
		var channelLabel = channel.label;
		channel.onmessage = function(event) {
			console.debug('message received');
			console.debug(event.data);
			// TODO onMessage(channelLabel, peerKey, event.data);
		}
		channel.onerror = myself.onError;
		peers[peerKey]['channels'][channelLabel] = channel;
		return channel;
	}
	function onError(message, error) {
		console.debug('Error: ' + message);
		console.debug(error);
	}
}

/* User class (for logged in user) */
function User(key, data) {
	var myself = this;
	myself.key = key;
	myself.name = data.name;
	myself.toJSON = function() {
		return {
			key: myself.key,
			name: myself.name
		};
	}
}

/* RoomUser class (for peers) */
function RoomUser(key, data) {
	var myself = this;
	myself.key = key;
	myself.userKey = data.key;
	myself.name = data.name;
}