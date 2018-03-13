@extends('layouts.master')

@section('styles')
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.3/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.css">
@stop

@section('content')
	<h1>Invitations</h1>
	<table id="invitations" class="table">
		<thead>
			<tr>
				<th>Email</th>
				<th></th>
				<th>Created at</th>
				<th>Token</th>
				<th>Used?</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($invitations as $invitation)
				<tr>
					<td>{!! $invitation->email !!}</td>
					<td>
						<a
							href="{!! route('invitations.destroy', [$invitation->id]) !!}"
							class="destroy-invitation"
							data-email="{!! $invitation->email !!}"
						>delete</a>
					</td>
					<td data-order="{!! $invitation->created_at->timestamp !!}">{!! $invitation->created_at->toFormattedDateString() !!}</td>
					<td>{!! $invitation->token !!}</td>
					@if ($invitation->used)
						<td class="bg-success">Yes</td>
					@else
						<td class="bg-danger">No</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
	<a href="{!! route('invitations.create') !!}" class="btn btn-lg btn-primary" role="button">New Invitation</a>
@stop

@section('scripts')
	<script src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script type="text/javascript">
		$('.destroy-invitation').each(function() {
			var link = $(this);
			link.restfulize({
				email: link.data('email'),
				method: 'DELETE',
				params: {
					'_token' : '{{ csrf_token() }}'
				},
				confirm: function() {
					return confirm('Are you sure you want to delete invitation for ' + this.email + '?');
				}
			});
		});
		$(document).ready(function(){
		    $('#invitations').DataTable({
				'aaSorting': [[2,'desc']],
				fnDrawCallback: function(oSettings) {
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
