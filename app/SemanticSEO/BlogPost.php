<?php

namespace App\SemanticSEO;

use App\Models\Post;
use NoelDeMartin\SemanticSEO\Types\Article;

class BlogPost extends Article
{
    public function __construct(Post $post)
    {
        parent::__construct();

        $this->name($post->title);
        $this->headline($post->title);
        $this->description($post->summary);
        $this->url(route('posts.show', $post->tag));
        $this->image(is_null($post->image_url) ? Logo::class : $post->image_url);
        $this->wordCount($post->word_count);
        $this->articleSection('Blog');
        $this->author(NoelDeMartin::class);
        $this->creator(NoelDeMartin::class);
        $this->publisher(NoelDeMartinOrganization::class);
        $this->mainEntityOfPage(route('home'));
        $this->datePublished($post->published_at);
        $this->dateCreated($post->published_at);
        $this->dateModified(max($post->published_at, $post->updated_at));
    }

    protected function getType()
    {
        return 'Article';
    }
}
