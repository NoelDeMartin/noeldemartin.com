@extends('layouts.master')

@section('content')
	<h1>Posts</h1>
	<table class="table">
		<thead>
			<tr>
				<th>Title</th>
				@if (Auth::user()->isAdmin())
					<th></th>
				@endif
				<th>Text</th>
				<th>Published At</th>
				<th>Created At</th>
				<th>Updated At</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($posts as $post)
				<tr>
					<td>{{HTML::linkRoute('posts.show', $post->title, $post->id) }}</td>
					@if (Auth::user()->isAdmin())
						<td>{{HTML::linkRoute('posts.edit', 'edit', $post->id) }}</td>
					@endif
					<td>{{ substr($post->text_markdown, 0, max(count($post->text_markdown), 15)) . '...' }}</td>
					<td>{{ $post->published_at }}</td>
					<td>{{ $post->created_at }}</td>
					<td>{{ $post->updated_at }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@if (Auth::user()->isAdmin())
		{{ HTML::linkRoute('posts.create', 'New Post', [], ['class' => 'btn btn-lg btn-primary', 'role' => 'button']) }}
	@endif
@stop