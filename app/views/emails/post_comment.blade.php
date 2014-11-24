<p>You have got a new comment in your blog! The post which was commented was "{{ HTML::linkRoute('posts.show', $post->title, $post->tag) }}". Take a look:</p>

<blockquote>{{ nl2br($comment->text) }}</blockquote> -- <cite>{{ $comment->author_link? HTML::link($comment->author_link, $comment->author) : $comment->author }}</cite>