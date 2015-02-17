@extends('layouts.master')

@section('content')
	<article class="post">
		<h1 class="title">{!! $post->title !!}</h1>
		<div class="body readable-text">{!! $post->text_html !!}</div>
		<div class="publish-date readable-text">Published {!! $post->published_at->toFormattedDateString() !!}</div>

		<div class="share">
			<span class="text">Share:</span>
			<a class="social-share share-popup twitter" href="{!! App\Helpers\Social::tweetLink($post) !!}">Share in Twitter</a>
			<a class="social-share share-popup facebook" href="{!! App\Helpers\Social::facebookShareLink($post) !!}">Share in Facebook</a>
			<a class="social-share share-popup gplus" href="{!! App\Helpers\Social::googlePlusShareLink($post) !!}">Share in Google</a>
			<a class="social-share gmail" href="{!! App\Helpers\Social::mailShareLink($post) !!}">Share in Gmail</a>
		</div>
		@if (Auth::check() && Auth::user()->is_reviewer)
			<div class="alert alert-info" role="alert">
				Hi There! You're a reviewer, right? So, don't be shy and <b>tell me what you think!</b>
				@if (!$post->isPublished())
					<br>
					(This post hasn't been published yet, it will be public on {!! $post->published_at->toFormattedDateString() !!})
				@endif
			</div>
			{!! Html::link('mailto:noeldemartin+blog.review@gmail.com?subject='.rawurlencode('[Post Review] '.$post->title.' (by '.Auth::user()->username.')'), 'Send Feedback', ['class' => 'btn btn-lg btn-danger', 'role' => 'button']) !!}
		@endif
		<div class="comments">
			@foreach ($post->comments as $comment)
				<div class="comment">
					<span class="author"><strong>{!! $comment->author_link? Html::link($comment->author_link, $comment->author) : $comment->author !!}</strong></span>
					<p class="text">{!! nl2br($comment->text) !!}</p>
					<span class="date">{!! $comment->created_at->toFormattedDateString() !!}</span>
				</div>
			@endforeach

			<div class="new-comment">
				{!! Form::open(['route' => ['posts.comment', $post->id], 'role' => 'form', 'class' => 'form-inline']) !!}

				<div class="form-group">
					{!! Form::text('author', null, ['placeholder' => 'Author (Optional)', 'class' => 'form-control']) !!}
					{!! Form::text('author_link', null, ['placeholder' => 'Contact Link or Email (Optional)', 'class' => 'form-control', 'size' => '32']) !!}
				</div>

				{!! Form::textarea('text', '', ['placeholder' => 'Comment', 'class' => 'form-control']) !!}

				@foreach ($errors->all() as $error)
					<div class="alert alert-danger" role="alert">{!! $error !!}</div>
				@endforeach

				{!! Form::submit('Add Comment', ['class' => 'btn btn-default']) !!}
				{!! Form::close() !!}

				<div class="comment-button hidden">
					<span class="glyphicon glyphicon-plus"></span> ADD A NEW COMMENT
				</div>
			</div>

		</div>
	</article>
@stop

@section('scripts')
	<script type="text/javascript">
		(function () {
			@if ($errors->isEmpty())
				var $commentForm = $('.new-comment form'),
					$commentButton = $('.new-comment .comment-button');

				// Prepare comment form
				$commentForm.addClass('hidden');
				$commentButton.removeClass('hidden');
				$commentButton.click(function () {
					$commentButton.addClass('hidden');
					$commentForm.removeClass('hidden');
				});
			@endif

			// Prepare share popups
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
		})();
	</script>
@stop