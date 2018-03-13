<article class="post">
	<h1 class="title">
		<a href="{!! route('posts.show', $post->tag) !!}">{{ $post->title }}</a>
	</h1>
	<div class="body readable-text">{!! $post->summary !!}</div>
	<a class="read-more" href="{!! route('posts.show', [$post->tag]) !!}">Read more...</a>
</article>
