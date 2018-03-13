<p>You have got a new comment in your blog! The post which was commented was <a href="{!! route('posts.show', [$post->tag]) !!}">{{ $post->title }}</a>. Take a look:</p>

<blockquote>{!! nl2br($comment->text) !!}</blockquote> -- <cite>{!! $comment->author_link? '<a href="' . $comment->author_link . '">' . $comment->author . '</a>' : $comment->author !!}</cite>
