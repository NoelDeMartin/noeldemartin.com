<article class="post">
	<h1 class="title">{{ HTML::linkRoute('posts.show', $post->title, $post->tag) }}</h1>
	<div class="body readable-text">{{ $post->getSummary() }}</div>
	{{ HTML::linkRoute('posts.show', 'Read more...', $post->tag) }}
</article>