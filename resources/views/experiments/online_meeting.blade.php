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

	<script type="text/javascript">
		var senderPeerConnection = new mozRTCPeerConnection(null);
		senderPeerConnection.onicecandidate = function(event) {
			console.debug('onIceCandidate called in sender');
			if(event.candidate != null) {
				receiverPeerConnection.addIceCandidate(event.candidate,
	                        	function (){
	                        			console.debug('addIceCandidate success in sender');
	                        	}, function (){
	                        			console.debug('addIceCandidate error in sender');
	                        	});
			}
		};
		senderPeerConnection.ondatachannel = function (e) {
	    	console.debug('on data channel from sender');
	    	e.channel.onmessage = function(e) {
	    		console.debug('message received!!!');
	    		console.debug(e);
	    	}
	    };
		var senderChannel = senderPeerConnection.createDataChannel("channel-label");
		senderChannel.onopen = function(event) {
			console.debug('on open called in sender');
		}
		senderChannel.onmessage = function(event) {
			console.debug('on message called, data:');
		}
		senderChannel.onclose = function(event) {
			console.debug('on close called sender');
			console.debug(event);
		}
		senderChannel.onerror = function (e) {
	        console.debug('sender on error');
	        console.debug(e);
	    };


		var receiverPeerConnection = new mozRTCPeerConnection(null);
		receiverPeerConnection.onicecandidate = function(event) {
			console.debug('onIceCandidate called in receiver');
			if(event.candidate != null) {
				senderPeerConnection.addIceCandidate(event.candidate,
	                        	function (){
	                        			console.debug('addIceCandidate success in receiver');
	                        	}, function (){
	                        			console.debug('addIceCandidate error in receiver');
	                        	});
			}
		};
	    receiverPeerConnection.ondatachannel = function (e) {
	    	console.debug('on data channel');
	    	e.channel.onmessage = function(e) {
	    		console.debug('message received!!!');
	    		console.debug(e);
	    	}
	    	senderChannel.send("now we're talking bitch!");
	    };

		// Offer
		senderPeerConnection.createOffer(function (offer) {
			console.debug('createOffer succcess');
			senderPeerConnection.setLocalDescription(offer, function() {
				// Send offer to receiver
				receiverPeerConnection.setRemoteDescription(new mozRTCSessionDescription(offer), function() {
					receiverPeerConnection.createAnswer(function(answer) {
						receiverPeerConnection.setLocalDescription(answer, function() {
							console.debug('setLocal on receiver success');
							senderPeerConnection.setRemoteDescription(new mozRTCSessionDescription(answer), function() {
								console.debug('we should be connected now!');
							}, function() {
								console.debug('setRemoteDescription on sender error');
							});
						},
						function () {
							console.debug('setLocalDescription on receiver error');
						});
					}, function() {
						console.debug('createAnswer failed');
					});
				},
				function () {
					console.debug('setRemoteDescription on receiver error');
				});
			}, function() {
				console.debug('setLocalDescription on sender error');
			});
		},
		function (error) {
			console.debug('createOffer failed');
			console.debug(error);
		});
	</script>

@stop