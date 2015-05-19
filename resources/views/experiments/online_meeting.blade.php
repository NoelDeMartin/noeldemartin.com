@extends('layouts.experiment')

@section('content')
	<div class="container">
		<h1>Online Meeting Tool - Rooms</h1>

		<table id="rooms-list" class="table table-bordered">
			<thead>
				<th>Room Name</th>
				<th>#Participants</th>
			</thead>
		</table>
		<form id="new-room" class="form-inline">
			<input type="text" class="form-control" />
			<input type="submit" class="btn btn-primary" value="New Room" />
		</form>
	</div>
@stop

@section('scripts')

	<script src="https://cdn.firebase.com/js/client/2.2.4/firebase.js"></script>
	{!! Html::script('js/experiments/online-meeting.js') !!}

	<script type="text/javascript">
		var $newRoomForm = $('#new-room'),
			$newRoomInput = $newRoomForm.find('input'),
			$roomsList = $('#rooms-list');
		var roomsManager = new RoomsManager();

		// Setup Listeners
		roomsManager.setListeners({
			onNewRoom: function(room) {
				var $newRoom = $('<tr class="room" id="room-' + room.key + '">'
									+ '<td><a href="{{route('experiments.online-meeting')}}/' + room.key + '">' + room.name + '</a></td>'
									+ '<td>' + room.getUsersCount() + '</td>'
								+ '</tr>');
				$newRoom.data('roomKey', room.key);
				$roomsList.append($newRoom);
			},
			onRoomClosed: function(room) {
				$('#room-' + room.key).remove();
			}
		});

		// New Room
		$newRoomForm.submit(function(event) {
			if (event.preventDefault) {
				event.preventDefault();
			}

			roomsManager.openNewRoom($newRoomInput.val());

			return false;
		});
	</script>

@stop