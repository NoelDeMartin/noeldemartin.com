@extends('layouts.master')

@section('content')
	<h1>Edit {{ $user->username }}</h1>

	{{ var_dump($user) }}

	{{ HTML::linkAction('users.destroy', 'Delete', $user->id, ['class' => 'btn btn-lg btn-danger', 'id' => 'destroy-user', 'role' => 'button']) }}
@stop

@section('scripts')
	<script type="text/javascript">
		$('#destroy-user').restfulize({
			method: 'DELETE',
			confirm: function() {
				return confirm('Are you sure you want to delete user {{ $user->username }}?');
			}
		});
	</script>
@stop