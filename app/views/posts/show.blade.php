@extends('layouts.master')

@section('content')
	<article class="post">
		<h1 class="title">{{ $post->title }}</h1>
		<div class="body readable-text">{{ $post->text_html }}</div>
		<div class="publish-date readable-text">Published {{ $post->published_at->toFormattedDateString() }}</div>

		<div class="share">
			<span class="text">Share:</span>
			<a class="social-share share-popup twitter" href="{{ Social::tweetLink($post) }}">Share in Twitter</a>
			<a class="social-share share-popup facebook" href="{{ Social::facebookShareLink($post) }}">Share in Facebook</a>
			<a class="social-share share-popup gplus" href="{{ Social::googlePlusShareLink($post) }}">Share in Google</a>
			<a class="social-share gmail" href="{{ Social::mailShareLink($post) }}">Share in Gmail</a>
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

@section('scripts')
	<script type="text/javascript">
		$('.share-popup').click(function () {
			var width = Math.min(screen.width*0.8, 600),
				height = Math.min(screen.height*0.6, 600),
				left = (screen.width/2)-(width/2),
				top = (screen.height/2)-(height/2);
			window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes' +
												',width=' + width +
												',height=' + height +
												',top=' + top +
												',left=' + left);
			return false;
		});
	</script>
@stop