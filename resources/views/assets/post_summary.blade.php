<article class="post">
	<h1 class="title">{!! Html::linkRoute('posts.show', $post->title, $post->tag) !!}</h1>
	<div class="body readable-text">{!! $post->getSummary() !!}</div>
	{!! Html::linkRoute('posts.show', 'Read more...', $post->tag, ['class' => 'read-more']) !!}
</article>