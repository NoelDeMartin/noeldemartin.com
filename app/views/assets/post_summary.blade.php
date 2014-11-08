<article class="post">
	<h1 class="title">{{ HTML::linkRoute('posts.show', $post->title, $post->id) }}</h1>
	<div class="body">{{ substr($post->text_html, 0, strpos($post->text_html, '</p>')) }}</div>
	{{ HTML::linkRoute('posts.show', 'Read more...', $post->id) }}
</article>