<?php

namespace App\Helpers;

use App\Models\Post;

class Social {

    public static function tweetLink(Post $post) {
        return 'https://twitter.com/intent/tweet' .
                    '?text=' . urlencode(utf8_encode('"' . $post->title . '" by @NoelDeMartin')) .
                    '&url=' . urlencode(route('posts.show', $post->tag));
    }

    public static function facebookShareLink(Post $post) {
        return 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode(route('posts.show', $post->tag));
    }

    public static function googlePlusShareLink(Post $post) {
        return 'https://plus.google.com/share?url=' . urlencode(route('posts.show', $post->tag));
    }

    public static function mailShareLink(Post $post) {
        return 'mailto:?subject=' . rawurlencode(utf8_encode($post->title)) .
                        '&body=' . rawurlencode('Check out "' . $post->title . '" by Noel De Martin: ' . route('posts.show', $post->tag));
    }

}
