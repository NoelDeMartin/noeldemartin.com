@extends('layouts.master')

@section('styles')
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.3/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.css">
@stop

@section('content')
	<h1>Users</h1>
	<table id="users" class="table">
		<thead>
			<tr>
				<th>Username</th>
				<th></th>
				<th>Email</th>
				<th>Roles</th>
				<th>Created At</th>
				<th>Updated At</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{!! Html::linkRoute('users.show', $user->username, $user->id) !!}</td>
					<td>{!! Html::linkRoute('users.edit', 'edit', $user->id) !!}</td>
					<td>{!! $user->email !!}</td>
					<td>{!! implode(', ', $user->getRolesArray()) !!}</td>
					<td data-order="{!! $user->created_at->timestamp !!}">{!! $user->created_at->toFormattedDateString() !!}</td>
					<td>{!! $user->updated_at->toFormattedDateString() !!}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! Html::linkRoute('users.create', 'New User', [], ['class' => 'btn btn-lg btn-primary', 'role' => 'button']) !!}
@stop

@section('scripts')
	<script src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#users').DataTable({
				'aaSorting': [[4,'desc']],
				fnDrawCallback: function(oSettings) {
					console.debug(oSettings._iDisplayLength);
					console.debug(oSettings.aiDisplay);
					if (oSettings.aiDisplay.length <= oSettings._iDisplayLength) {
						$('.dataTables_paginate').hide();
						$('.dataTables_info').hide();
					} else {
						$('.dataTables_paginate').show();
						$('.dataTables_info').show();
					}
				}
			});
		});
	</script>
@stop