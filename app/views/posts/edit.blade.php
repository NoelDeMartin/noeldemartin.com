@extends('layouts.master')

@section('content')
	<h1>{{ $post->title }}</h1>

	{{ var_dump($post) }}

	{{ HTML::linkRoute('posts.destroy', 'Delete', $post->id, ['class' => 'btn btn-lg btn-danger', 'id' => 'destroy-post', 'role' => 'button']) }}
@stop

@section('scripts')
	<script type="text/javascript">
		$('#destroy-post').restfulize({
			method: 'DELETE',
			confirm: function() {
				return confirm('Are you sure you want to delete post {{ $post->title }}?');
			}
		});
	</script>
@stop