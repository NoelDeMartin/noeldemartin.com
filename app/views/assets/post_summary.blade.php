<article class="post">
	<h1 class="title">{{ HTML::linkRoute('posts.show', $post->title, $post->tag) }}</h1>
	<div class="body readable-text">{{ substr($post->text_html, 0, strpos($post->text_html, '<h2')) }}</div>
	{{ HTML::linkRoute('posts.show', 'Read more...', $post->tag) }}
</article>