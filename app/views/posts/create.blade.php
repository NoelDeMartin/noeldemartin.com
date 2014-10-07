@extends('layouts.master')

@section('content')
	<h1>Create Post</h1>

	{{ Form::open(['route' => 'posts.store'], ['role' => 'form']) }}

	<div class="form-group">
		<label for="postname">Post</label>
		{{ Form::text('title', null, ['placeholder' => 'Title', 'class' => 'form-control']) }}
	</div>

	<div class="form-group">
		<label for="email">Text (Markdown)</label>
		{{ Form::textarea('text_markdown', null, ['placeholder' => 'Text', 'class' => 'form-control']) }} <br>
		{{ Form::text('published_at', null, ['placeholder' => 'Publication date (dd/mm/yyyy)', 'class' => 'form-control']) }}
	</div>

	{{ Form::hidden('author_id', 1) }}

	@foreach ($errors->all() as $error)
		<div class="alert alert-danger" role="alert">{{ $error }}</div>
	@endforeach

	{{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
	{{ Form::close() }}
@stop