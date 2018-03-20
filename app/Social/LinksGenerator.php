<?php

namespace App\Social;

use App\Models\Post;

class LinksGenerator
{
    public function twitter(Post $post)
    {
        return 'https://twitter.com/intent/tweet' .
                    '?text=' . urlencode(utf8_encode('"' . $post->title . '" by @NoelDeMartin')) .
                    '&url=' . urlencode(route('posts.show', $post->tag));
    }

    public function linkedin(Post $post)
    {
        return 'https://www.linkedin.com/shareArticle' .
                    '?title=' . urlencode(utf8_encode($post->title)) .
                    '&url=' . urlencode(route('posts.show', $post->tag)) .
                    '&source=' . urlencode(route('home'));
    }

    public function email(Post $post)
    {
        return 'mailto:?subject=' . rawurlencode(utf8_encode($post->title)) .
                        '&body=' . rawurlencode(
                            'Check out "' . $post->title . '" by Noel De Martin: ' . route('posts.show', $post->tag)
                        );
    }

    public function raw(Post $post)
    {
        return route('posts.show', $post->tag);
    }
}
