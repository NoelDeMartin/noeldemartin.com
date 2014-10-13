@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $post->title }}</h1>
			{{ $post->text_html }}
		</div>
		<div class="col-md-4">
			@if (Auth::user()->isReviewer())
				<div class="alert alert-info" role="alert">
					Hi There! You're a reviewer, right? So, don't be shy and <b>tell me what you think!</b>
					@if (!$post->isPublic())
						<br>
						(This post hasn't been published yet, it will be public on {{ $post->published_at->toFormattedDateString() }})
					@endif
				</div>
				{{ HTML::link('mailto:noeldemartin+blog.review@gmail.com', 'Send Feedback', ['class' => 'btn btn-lg btn-danger', 'role' => 'button']) }}
			@endif
		</div>
	</div>
@stop