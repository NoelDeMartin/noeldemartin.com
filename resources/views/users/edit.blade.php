@extends('layouts.master')

@section('content')
	<h1>Edit {!! $user->username !!}</h1>

	<pre>{!! $user->toJson() !!}</pre>

	<a href="{!! route('users.destroy', [$user->id]) !!}" id="destroy-user" role="button" class="btn btn-lg btn-danger">Delete</a>
@stop

@section('scripts')
	<script type="text/javascript">
		$('#destroy-user').restfulize({
			method: 'DELETE',
			params: {
				'_token' : '{{ csrf_token() }}'
			},
			confirm: function() {
				return confirm('Are you sure you want to delete user {!! $user->username !!}?');
			}
		});
	</script>
@stop
