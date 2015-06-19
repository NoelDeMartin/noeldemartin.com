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
		<form id="new-room">
			<input type="text" class="form-control" />
			<div class="checkbox">
				<input type="submit" class="btn btn-primary" value="New Room" />
				<label>
					<input type="checkbox"> Private Room
				</label>
			</div>
		</form>
	</div>
@stop

@section('scripts')

	<script src="https://cdn.firebase.com/js/client/2.2.4/firebase.js"></script>
	{!! Html::script('js/experiments/online-meeting.js') !!}

	<script type="text/javascript">
		var $newRoomForm = $('#new-room'),
			$newRoomInput = $newRoomForm.find('input[type="text"]'),
			$newRoomPrivate = $newRoomForm.find('input[type="checkbox"]'),
			$roomsList = $('#rooms-list');
		var roomsManager = new RoomsManager();

		// Setup Listeners
		roomsManager.setListeners({
			onNewRoom: function(room) {
				var $newRoom = $('<tr class="room" id="room-' + room.key + '">'
									+ '<td><a href="{{route('experiments.online-meeting')}}/' + room.key + '">' + room.name + '</a></td>'
									+ '<td class="users-count">' + room.getUsersCount() + '</td>'
								+ '</tr>'),
					$usersCount = $newRoom.find('.users-count');
				$newRoom.data('roomKey', room.key);
				$roomsList.append($newRoom);

				room.listenUsersCount(function(count) {
					$usersCount.text(count);
				});
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

			var roomName = $newRoomInput.val();
			if (roomName.length < 4 || roomName.length > 254) {
				alert('The name of a room must have between 4 and 254 characters');
				return;
			}

			roomsManager.openNewRoom(roomName, $newRoomPrivate.is(':checked'), function(room) {
				if (room.isPrivate) {
					alert('Use this url to access the private room {{ route('experiments.online-meeting') }}/' + room.key);
				}
			});

			return false;
		});
	</script>

@stop