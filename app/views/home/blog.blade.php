@extends('layouts.master')

@section('content')
	<ul>
		@foreach ($posts as $post)
			<li>{{ HTML::linkRoute('posts.show', $post->title, $post->id) }}</li>
		@endforeach
	</ul>
@stop