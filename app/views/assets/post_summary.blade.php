<article>
	<h1>{{ $post->title }}</h1>
	<p>{{ substr($post->text_html, 0, strpos($post->text_html, '</p>')) }}</p>
	{{ HTML::linkRoute('posts.show', 'Read more...', $post->id) }}
</article>