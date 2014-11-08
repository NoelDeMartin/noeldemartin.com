@extends('layouts.master')

@section('content')
	<article class="post">
		<h1 class="title">{{ $post->title }}</h1>
		<div class="body">{{ $post->text_html }}</div>

		<div class="share">
			<span class="text">Share:</span>
			<a class="social-share twitter" href="javascript:void(0);">Share in Twitter</a>
			<a class="social-share facebook" href="javascript:void(0);">Share in Facebook</a>
			<a class="social-share gplus" href="javascript:void(0);">Share in Google</a>
		</div>
	</article>
	@if (Auth::check() && Auth::user()->is_reviewer)
		<div class="alert alert-info" role="alert">
			Hi There! You're a reviewer, right? So, don't be shy and <b>tell me what you think!</b>
			@if (!$post->isPublished())
				<br>
				(This post hasn't been published yet, it will be public on {{ $post->published_at->toFormattedDateString() }})
			@endif
		</div>
		{{ HTML::link('mailto:noeldemartin+blog.review@gmail.com?subject='.rawurlencode('[Post Review] '.$post->title.' (by '.Auth::user()->username.')'), 'Send Feedback', ['class' => 'btn btn-lg btn-danger', 'role' => 'button']) }}
	@endif
@stop