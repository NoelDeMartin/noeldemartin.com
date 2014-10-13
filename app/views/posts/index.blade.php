@extends('layouts.master')

@section('content')
	<h1>Posts</h1>
	<table class="table">
		<thead>
			<tr>
				<th>Title</th>
				@if (Auth::user()->is_admin)
					<th></th>
				@endif
				<th>Publication Date</th>
				<th>Public?</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($posts as $post)
				<tr>
					<td>{{HTML::linkRoute('posts.show', $post->title, $post->id) }}</td>
					@if (Auth::user()->is_admin)
						<td>{{HTML::linkRoute('posts.edit', 'edit', $post->id) }}</td>
					@endif
					<td>{{ $post->published_at->toFormattedDateString() }}</td>
					@if ($post->isPublic())
						<td class="bg-success">Yes</td>
					@else
						<td class="bg-danger">No</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
	@if (Auth::user()->is_admin)
		{{ HTML::linkRoute('posts.create', 'New Post', [], ['class' => 'btn btn-lg btn-primary', 'role' => 'button']) }}
	@endif
@stop