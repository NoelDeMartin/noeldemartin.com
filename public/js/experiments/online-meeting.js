// Prefixes
var RTCPeerConnection = window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
var RTCIceCandidate = window.mozRTCIceCandidate || window.RTCIceCandidate;
var RTCSessionDescription = window.mozRTCSessionDescription || window.RTCSessionDescription;
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
var attachMediaStream;
if (navigator.mozGetUserMedia) {
	attachMediaStream = function(element, stream) {
		element.mozSrcObject = stream;
		element.play();
	}
} else if (navigator.webkitGetUserMedia) {
	attachMediaStream = function(element, stream) {
		element.src = (URL || webkitURL).createObjectURL(stream);
		element.play();
	}
} else {
	alert('Cant attach user media!!');
}

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
	myself.chatMessages = [];
	myself.enabledAudios = [];

	// Setup Private Attributes
	var onNewUser = function(user) {},
		onUserUpdated = function(user) {},
		onUserLeave = function(user) {},
		onBoardUpdated = function(paths) {},
		onChatMessage = function(user, message) {},
		onEnableAudio = function(user) {},
		onDisableAudio = function(user) {},
		roomRef = new Firebase('https://brilliant-fire-1291.firebaseio.com/rooms/' + myself.key),
		roomUsersRef = roomRef.child('users'),
		roomBoardPathsRef = roomRef.child('board-paths'),
		audioStream = null,
		peers = null,
		localUserKey = null,
		localUserRef = null,
		localUserSignalingRef = null,
		localUserICERef = null,
		pendingUsersSync = null,
		syncSuccessfulCallback = null,
		freeAudioObjects = [];

	/* Public Methods */
	myself.setListeners = function(listeners) {
		var defaultListeners = {
			onNewUser: onNewUser,
			onUserUpdated: onUserUpdated,
			onUserLeave: onUserLeave,
			onBoardUpdated: onBoardUpdated,
			onChatMessage: onChatMessage,
			onEnableAudio: onEnableAudio,
			onDisableAudio: onDisableAudio
		};
		var listeners = $.extend(defaultListeners, listeners);
		onNewUser = listeners.onNewUser;
		onUserUpdated = listeners.onUserUpdated;
		onUserLeave = listeners.onUserLeave;
		onBoardUpdated = listeners.onBoardUpdated;
		onChatMessage = listeners.onChatMessage;
		onEnableAudio = listeners.onEnableAudio;
		onDisableAudio = listeners.onDisableAudio;
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
					myself.boardPaths[localUserKey] = [{x: [], y: []}];

					// Listen for user leave
					roomUsersRef.child(localUserKey).onDisconnect().remove();

					setUpSignaling();
					setUpICE();

					// This must be done before connecting because of this: http://stackoverflow.com/questions/25986267/webrtc-works-in-chrome-but-not-firefox
					navigator.getUserMedia({audio:true}, function(stream) {
						audioStream = stream;

						// Connect with users
						if (getDictionaryCount(roomPreviousUsers) > 0) {
							pendingUsersSync = [];
							syncSuccessfulCallback = (typeof success == 'function')? success : function(){};
							for (peerKey in roomPreviousUsers) {
								pendingUsersSync.push(peerKey);
								connectWith(peerKey);
							}
						} else if (typeof success == 'function') {
							success();
						}

						// Listen and retrieve room users
						roomUsersRef.on('child_added', function(snapshot) {
							var newUser = new RoomUser(snapshot.key(), snapshot.val());
							if (newUser.isValid()) {
								myself.users[newUser.key] = newUser;
								onNewUser(newUser);
							}
						}, function (error) {
							console.log('The room users listener failed: ' + error.code);
						});
						roomUsersRef.on('child_changed', function(snapshot) {
							var user = myself.users[snapshot.key()];
							if (exists(user)) {
								var shouldUpdateBoard = user.diffBoard(snapshot.val());
								user.update(snapshot.val());
								onUserUpdated(user);
								if (shouldUpdateBoard) {
									onBoardUpdated(myself.boardPaths);
								}
							}
						}, function (error) {
							console.log('The room users listener failed: ' + error.code);
						});
						roomUsersRef.on('child_removed', function(snapshot) {
							var user = myself.users[snapshot.key()];
							if (exists(user)) {
								clearUserPaths(user.key);
								onUserLeave(user);
								onBoardUpdated(myself.boardPaths);
								delete myself.users[user.key];
								delete peers[user.key]; // TODO close channels and streams before deleting this
							}
						}, function (error) {
							console.log('The room users listener failed: ' + error.code);
						});

					}, function(error) {
						onError('Activating local sound', error);
					});
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
			if (exists(peerData['channels']['board'])) {
				peerData['channels']['board'].send(JSON.stringify({type: 'start-path'}));
			}
		});

		// Add initial point
		var point = {x: initialX, y: initialY};
		addBoardPathPoint(localUserKey, point);
		$.each(peers, function(key, peerData) {
			if (exists(peerData['channels']['board'])) {
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
			if (exists(peerData['channels']['board'])) {
				peerData['channels']['board'].send(JSON.stringify({type: 'point', point: point}));
			}
		});

		// Notify listener
		onBoardUpdated(myself.boardPaths);
	}
	myself.clearLocalUserPaths = function() {
		clearUserPaths(localUserKey);
		$.each(peers, function(key, peerData) {
			if (exists(peerData['channels']['board'])) {
				peerData['channels']['board'].send(JSON.stringify({type: 'clear-paths'}));
			}
		});

		// Notify listener
		onBoardUpdated(myself.boardPaths);
	}
	myself.updateLocalUserColor = function(color) {
		localUserRef.update({drawingColor: getColor(color)});
	}
	myself.enableAudio = function() {
		myself.enabledAudios.push(localUserKey);
		$.each(peers, function(key, peerData) {
			if (exists(peerData['channels']['audio'])) {
				peerData['channels']['audio'].send('enable');
			}
		});
	}
	myself.disableAudio = function() {
		removeFromArray(myself.enabledAudios, localUserKey);
		$.each(peers, function(key, peerData) {
			if (exists(peerData['channels']['audio'])) {
				peerData['channels']['audio'].send('disable');
			}
		});
	}
	myself.sendChatMessage = function(message) {
		myself.chatMessages.push({user: localUserKey, message: message});
		onChatMessage(myself.users[localUserKey], message);
		$.each(peers, function(key, peerData) {
			if (exists(peerData['channels']['chat'])) {
				peerData['channels']['chat'].send(message);
			}
		});
	}
	// This should be called from the callback of a user event in order to work for mobile
	// for more info see: https://mauricebutler.wordpress.com/2014/02/22/android-chrome-does-not-allow-applications-to-play-html5-audio-without-an-explicit-action-by-the-user/
	myself.initAudio = function(audioObjects) {
		freeAudioObjects = audioObjects;
	}
	myself.startUserAudio = function(userKey) {
		if (exists(peers[userKey]['stream']) && freeAudioObjects.length > 0) {
			peers[userKey]['audio'] = freeAudioObjects.pop();
			attachMediaStream(peers[userKey]['audio'], peers[userKey]['stream']);
		}
	}
	myself.stopUserAudio = function(userKey) {
		if (exists(peers[userKey]['audio'])) {
			peers[userKey]['audio'].pause();
			freeAudioObjects.push(peers[userKey]['audio']);
			peers[userKey]['audio'] = null;
		}
	}
	myself.getUsersCount = function() {
		return getDictionaryCount(myself.users);
	}
	myself.isLocalUser = function(user) {
		return user && user.key == localUserKey;
	}

	/* Private Methods */
	function setUpSignaling() {
		localUserSignalingRef.on('child_added', function(snapshot) {
			var signalingData = snapshot.val(),
				session = JSON.parse(signalingData.session);
			if (session.type == 'offer') {
				var connection = createConnection(signalingData.origin);
				createAudioStream(signalingData.origin);
				myself.boardPaths[signalingData.origin] = [{x: [], y: []}];
				connection.setRemoteDescription(new RTCSessionDescription(session), function() {
					connection.createAnswer(function(answer) {
						connection.setLocalDescription(answer, function() {
							roomUsersRef.child(signalingData.origin).child('signaling').push({origin: localUserKey, session: JSON.stringify(answer)}, function(error) {
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
				connection.setRemoteDescription(new RTCSessionDescription(session), function() {
					localUserSignalingRef.child(snapshot.key()).remove(function(error) {
						if (error != null) {
							onError('Removing signaling data', error);
						} else {
							onUserConnectionFinished(signalingData.origin);
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
			peers[iceData.origin]['connection'].addIceCandidate(new RTCIceCandidate(JSON.parse(iceData.candidate)), function() {
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
		myself.boardPaths[peerKey] = [{x: [], y: []}];
		createChannel(peerKey, 'sync', processSyncMessage);
		createChannel(peerKey, 'board', processBoardMessage);
		createChannel(peerKey, 'chat', processChatMessage);
		createChannel(peerKey, 'audio', processAudioMessage);
		createAudioStream(peerKey);
		sendOffer(peerKey);
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
				peerData.ICERef.push({origin: localUserKey, candidate: JSON.stringify(event.candidate)}, function(error) {
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
			var theChannel = event.channel,
				callback;
			if (channelLabel == 'board') {
				callback = processBoardMessage;
			} else if (channelLabel == 'chat') {
				callback = processChatMessage;
			} else if (channelLabel == 'audio') {
				callback = processAudioMessage;
			} else if (channelLabel == 'sync') {
				callback = processSyncMessage;
			} else {
				console.debug('Created unknown data channel: ' + channelLabel);
			}
			event.channel.onmessage = function(event) {
				callback(peerKey, event.data);
			}
			event.channel.onerror = function (error) {
				onError('Channel onError', error);
			};
			event.channel.onclosed = function() {
				delete peerData['channels'][channelLabel];
			}
		}

		// Listen to opened streams
		peerData['connection'].onaddstream = function(event) {
			peerData['stream'] = event.stream;
		}

		return peerData['connection'];
	}
	function createChannel(peerKey, name, callback) {
		var channel = peers[peerKey]['connection'].createDataChannel(name);
		channel.onopen = function() {
			peers[peerKey]['channels'][name] = channel;
			if (name == 'sync' && pendingUsersSync && pendingUsersSync.length == 0) {
				pendingUsersSync = null;
				channel.send(JSON.stringify({type: 'request'}));
			}
		}
		channel.onclosed = function() {
			delete peers[peerKey]['channels'][name];
		}
		channel.onmessage = function(event) {
			callback(peerKey, event.data);
		}
		channel.onerror = myself.onError;
	}
	function createAudioStream(peerKey) {
		if (audioStream != null) {
			peers[peerKey]['connection'].addStream(audioStream);
		}
	}
	function sendOffer(peerKey) {
		var connection = peers[peerKey]['connection'];
		connection.createOffer(function (offer) {
			connection.setLocalDescription(offer, function() {
				roomUsersRef.child(peerKey).child('signaling').push({origin: localUserKey, session: JSON.stringify(offer)}, function(error) {
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
	function onUserConnectionFinished(peerKey) {
		var index = pendingUsersSync.indexOf(peerKey);
		if (index >= 0) {
			pendingUsersSync.splice(index, 1);
			if (pendingUsersSync.length == 0) {
				if (exists(peers[peerKey]['channels']['sync'])) {
					pendingUsersSync = null;
					peers[peerKey]['channels']['sync'].send(JSON.stringify({type: 'request'}));
				}
			}
		}
	}
	function startBoardPath(userKey) {
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
	function processSyncMessage(peerKey, message) {
		var message = JSON.parse(message);
		// TODO use arraybuffer instead
		if (message.type == 'request') {
			if (exists(peers[peerKey]['channels']['sync'])) {
				var data = {
					boardPaths: myself.boardPaths,
					chatMessages: myself.chatMessages,
					enabledAudios: myself.enabledAudios
				};
				peers[peerKey]['channels']['sync'].send(JSON.stringify({type: 'data', data: data}));
			}
		} else {
			myself.boardPaths = message.data.boardPaths;
			myself.chatMessages = message.data.chatMessages;
			myself.enabledAudios = message.data.enabledAudios;
			if (syncSuccessfulCallback != null) {
				syncSuccessfulCallback();
				syncSuccessfulCallback = null;
			}
		}
	}
	function processBoardMessage(peerKey, message) {
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
	}
	function processChatMessage(peerKey, message) {
		myself.chatMessages.push({user: peerKey, message: message});
		onChatMessage(myself.users[peerKey], message);
	}
	function processAudioMessage(peerKey, message) {
		if (message == 'enable') {
			myself.enabledAudios.push(peerKey);
			onEnableAudio(myself.users[peerKey]);
		} else {
			removeFromArray(myself.enabledAudios, peerKey);
			onDisableAudio(myself.users[peerKey]);
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
	myself.isValid = function() {
		return exists(myself.name) && exists(myself.drawingColor);
	}

}

function exists(object) {
	if (object && typeof object != 'undefined') {
		return true;
	} else {
		return false;
	}
}

function getDictionaryCount(object) {
	var size = 0, key;
	for (key in object) {
		if (object.hasOwnProperty(key)) size++;
	}
	return size;
}

function removeFromArray(array, object) {
	var index = array.indexOf(object);
	if (index >= 0) {
		array.splice(index, 1);
	}
}