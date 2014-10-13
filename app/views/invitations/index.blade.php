@extends('layouts.master')

@section('content')
	<h1>Invitations</h1>
	<table class="table">
		<thead>
			<tr>
				<th>Email</th>
				<th></th>
				<th>Token</th>
				<th>Used?</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($invitations as $invitation)
				<tr>
					<td>{{ $invitation->email }}</td>
					<td>{{HTML::linkRoute('invitations.destroy', 'delete', $invitation->id, ['class' => 'destroy-invitation', 'data-email' => $invitation->email]) }}</td>
					<td>{{ $invitation->token }}</td>
					@if ($invitation->used)
						<td class="bg-success">Yes</td>
					@else
						<td class="bg-danger">No</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ HTML::linkRoute('invitations.create', 'New Invitation', [], ['class' => 'btn btn-lg btn-primary', 'role' => 'button']) }}
@stop

@section('scripts')
	<script type="text/javascript">
		$('.destroy-invitation').each(function() {
			var link = $(this);
			link.restfulize({
				email: link.data('email'),
				method: 'DELETE',
				confirm: function() {
					return confirm('Are you sure you want to delete invitation for ' + this.email + '?');
				}
			});
		});
	</script>
@stop