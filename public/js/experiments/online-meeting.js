var RTCPeerConnection = window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
var RTCIceCandidate = window.mozRTCIceCandidate || window.RTCIceCandidate;
var RTCSessionDescription = window.mozRTCSessionDescription || window.RTCSessionDescription;

function initRoom(key, callback) {
	var firebase = new Firebase('https://brilliant-fire-1291.firebaseio.com/rooms/' + key);
	firebase.once('value', function(snapshot) {
		callback(new Room(snapshot.key(), snapshot.val()));
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
		if (!snapshot.val().isPrivate) {
			var room = new Room(snapshot.key(), snapshot.val());
			myself.rooms[room.key] = room;
			onNewRoom(room);
		}
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
	myself.openNewRoom = function(roomName, isPrivate, success) {
		var data = {name: roomName, isPrivate: isPrivate},
		roomRef = roomsRef.push(data, function(error) {
			if (error == null) {
				if (typeof success == 'function') {
					if (isPrivate) {
						success(new Room(roomRef.key(), data));
					} else {
						success(myself.rooms[roomRef.key()]);
					}
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
	myself.isPrivate = data.isPrivate;
	myself.users = $.extend({}, data.users);
	myself.boardPaths = {};

	// Setup Private Attributes
	var onNewUser = function(user) {},
		onUserUpdated = function(user) {},
		onUserLeave = function(user) {},
		onBoardUpdated = function(paths) {},
		onChatMessage = function(user, message) {},
		roomRef = new Firebase('https://brilliant-fire-1291.firebaseio.com/rooms/' + myself.key),
		roomUsersRef = roomRef.child('users'),
		roomBoardPathsRef = roomRef.child('board-paths'),
		peers = null,
		localUserKey = null,
		localUserRef = null,
		localUserSignalingRef = null,
		localUserICERef = null;

	/* Public Methods */
	myself.setListeners = function(listeners) {
		var defaultListeners = {
			onNewUser: onNewUser,
			onUserUpdated: onUserUpdated,
			onUserLeave: onUserLeave,
			onBoardUpdated: onBoardUpdated,
			onChatMessage: onChatMessage
		};
		var listeners = $.extend(defaultListeners, listeners);
		onNewUser = listeners.onNewUser;
		onUserUpdated = listeners.onUserUpdated;
		onUserLeave = listeners.onUserLeave;
		onBoardUpdated = listeners.onBoardUpdated;
		onChatMessage = listeners.onChatMessage;
	}
	myself.enter = function(username, success) {
		roomUsersRef.once('value', function(snapshot) {
			var roomPreviousUsers = snapshot.val();

			// Login user into room
			localUserRef = roomUsersRef.push({name: username, drawingColor: getRandomColor()}, function(error) {
				if (error == null) { // User was logged in correctly
					// Initialize local user
					peers = {};
					localUserKey = localUserRef.key();
					localUserSignalingRef = localUserRef.child('signaling');
					localUserICERef = localUserRef.child('ICE');

					// Listen for user leave
					roomUsersRef.child(localUserKey).onDisconnect().remove();

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
					roomUsersRef.on('child_changed', function(snapshot) {
						var user = myself.users[snapshot.key()],
							shouldUpdateBoard = user.diffBoard(snapshot.val());
						user.update(snapshot.val());
						onUserUpdated(user);
						if (shouldUpdateBoard) {
							onBoardUpdated(myself.boardPaths);
						}
					}, function (error) {
						console.log('The room users listener failed: ' + error.code);
					});
					roomUsersRef.on('child_removed', function(snapshot) {
						var user = myself.users[snapshot.key()];
						clearUserPaths(user.key);
						onUserLeave(user);
						onBoardUpdated(myself.boardPaths);
						delete myself.users[user.key];
					}, function (error) {
						console.log('The room users listener failed: ' + error.code);
					});

					if (typeof success == 'function') {
						success();
					}
				} else {
					console.log('Error entering user to room: ' + error.code);
				}
			});
		});
	}
	myself.listenUsersCount = function(callback) {
		var count = 0;
		roomUsersRef.on('child_added', function(snapshot) {
			count++;
			callback(count);
		}, function (error) {
			console.log('The room users count listener failed: ' + error.code);
		});
		roomUsersRef.on('child_removed', function(snapshot) {
			count--;
			callback(count);
		}, function (error) {
			console.log('The room users count listener failed: ' + error.code);
		});
	}
	myself.startLocalDrawingPath = function(initialX, initialY) {
		// Create new path
		startBoardPath(localUserKey);
		$.each(peers, function(key, peerData) {
			if (typeof peerData['channels']['board'] != 'undefined') {
				peerData['channels']['board'].send(JSON.stringify({type: 'start-path'}));
			}
		});

		// Add initial point
		var point = {x: initialX, y: initialY};
		addBoardPathPoint(localUserKey, point);
		$.each(peers, function(key, peerData) {
			if (typeof peerData['channels']['board'] != 'undefined') {
				peerData['channels']['board'].send(JSON.stringify({type: 'point', point: point}));
			}
		});

		// Notify listener
		onBoardUpdated(myself.boardPaths);
	}
	myself.addLocalDrawingPoint = function(x, y) {
		// Add point
		var point = {x: x, y: y};
		addBoardPathPoint(localUserKey, point);
		$.each(peers, function(key, peerData) {
			if (typeof peerData['channels']['board'] != 'undefined') {
				peerData['channels']['board'].send(JSON.stringify({type: 'point', point: point}));
			}
		});

		// Notify listener
		onBoardUpdated(myself.boardPaths);
	}
	myself.clearLocalUserPaths = function() {
		clearUserPaths(localUserKey);
		$.each(peers, function(key, peerData) {
			if (typeof peerData['channels']['board'] != 'undefined') {
				peerData['channels']['board'].send(JSON.stringify({type: 'clear-paths'}));
			}
		});

		// Notify listener
		onBoardUpdated(myself.boardPaths);
	}
	myself.updateLocalUserColor = function(color) {
		localUserRef.update({drawingColor: getColor(color)});
	}
	myself.sendChatMessage = function(message) {
		onChatMessage(myself.users[localUserKey], message);
		$.each(peers, function(key, peerData) {
			if (typeof peerData['channels']['chat'] != 'undefined') {
				peerData['channels']['chat'].send(message);
			}
		});
	}
	myself.getUsersCount = function() {
		var size = 0, key;
		for (key in myself.users) {
			if (myself.users.hasOwnProperty(key)) size++;
		}
		return size;
	}
	myself.isLocalUser = function(user) {
		return user.key == localUserKey;
	}

	/* Private Methods */
	function setUpSignaling() {
		localUserSignalingRef.on('child_added', function(snapshot) {
			var signalingData = snapshot.val();
			if (signalingData.session.type == 'offer') {
				var connection = createConnection(signalingData.origin);
				connection.setRemoteDescription(new RTCSessionDescription(signalingData.session), function() {
					connection.createAnswer(function(answer) {
						connection.setLocalDescription(answer, function() {
							roomUsersRef.child(signalingData.origin).child('signaling').push({origin: localUserKey, session: answer.toJSON()}, function(error) {
								if (error == null) {
									localUserSignalingRef.child(snapshot.key()).remove(function(error) {
										if (error != null) {
											onError('Removing signaling data', error);
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
				connection.setRemoteDescription(new RTCSessionDescription(signalingData.session), function() {
					localUserSignalingRef.child(snapshot.key()).remove(function(error) {
						if (error != null) {
							onError('Removing signaling data', error);
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
			peers[iceData.origin]['connection'].addIceCandidate(new RTCIceCandidate(iceData.candidate), function() {
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
		createChannel(peerKey, 'chat');

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
			connection: new RTCPeerConnection(null),
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
				onMessage(channelLabel, peerKey, event.data);
			}
			event.channel.onerror = function (error) {
				onError('Channel onError', error);
			};
			event.channel.onclosed = function() {
				delete peerData['channels'][channelLabel];
			}
		}

		return peerData['connection'];
	}
	function createChannel(peerKey, name) {
		var channel = peers[peerKey]['connection'].createDataChannel(name);
		var channelLabel = channel.label;
		channel.onopen = function() {
			peers[peerKey]['channels'][channelLabel] = channel;
		}
		channel.onclosed = function() {
			delete peers[peerKey]['channels'][channelLabel];
		}
		channel.onmessage = function(event) {
			onMessage(channelLabel, peerKey, event.data);
		}
		channel.onerror = myself.onError;
	}
	function startBoardPath(userKey) {
		if (typeof myself.boardPaths[userKey] == 'undefined') {
			myself.boardPaths[userKey] = [];
		}
		myself.boardPaths[userKey].push({x: [], y: []});
	}
	function addBoardPathPoint(userKey, point) {
		var path = myself.boardPaths[userKey][myself.boardPaths[userKey].length -1];
		path['x'].push(point.x);
		path['y'].push(point.y);
	}
	function clearUserPaths(userKey) {
		myself.boardPaths[userKey] = [];
	}
	function getRandomColor() {
		return getColor(Math.random() * 360);
	}
	function getColor(color) {
		return 'hsl(' + color + ', 40%, 60%)'
	}
	function onMessage(channelLabel, peerKey, message) {
		if (channelLabel == 'board') {
			var message = JSON.parse(message);
			// TODO use arraybuffer instead
			if (message.type == 'point') {
				addBoardPathPoint(peerKey, message.point);
			} else if (message.type == 'start-path') {
				startBoardPath(peerKey);
			} else { // clear paths
				clearUserPaths(peerKey);
			}
			onBoardUpdated(myself.boardPaths);
		} else if (channelLabel == 'chat') {
			onChatMessage(myself.users[peerKey], message);
		} else {
			console.debug('Message received on non-board channel (' + channelLabel + '): ' + message);
		}
	}
	function onError(message, error) {
		console.debug('Error: ' + message);
		console.debug(error);
	}
}

/* RoomUser class (for peers) */
function RoomUser(key, data) {
	var myself = this;
	myself.key = key;
	myself.userKey = data.key;
	myself.name = data.name;
	myself.drawingColor = data.drawingColor;

	myself.update = function(data) {
		myself.name = data.name;
		myself.drawingColor = data.drawingColor;
	}
	myself.diffBoard = function(data) {
		return data.drawingColor != myself.drawingColor;
	}

}