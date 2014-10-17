@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $post->title }}</h1>
			{{ $post->text_html }}
			<br/>
			<br/>
		</div>
		<div class="col-md-4">
			@if (Auth::user()->is_reviewer)
				<div class="alert alert-info" role="alert">
					Hi There! You're a reviewer, right? So, don't be shy and <b>tell me what you think!</b>
					@if (!$post->isPublished())
						<br>
						(This post hasn't been published yet, it will be public on {{ $post->published_at->toFormattedDateString() }})
					@endif
				</div>
				{{ HTML::link('mailto:noeldemartin+blog.review@gmail.com?subject='.rawurlencode('[Post Review] '.$post->title.' (by '.Auth::user()->username.')'), 'Send Feedback', ['class' => 'btn btn-lg btn-danger', 'role' => 'button']) }}
			@endif
		</div>
	</div>
@stop