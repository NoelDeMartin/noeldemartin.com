<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\Article;
use Statamic\Entries\Entry;

class BlogPost extends Article
{
    public function __construct(Entry $post)
    {
        parent::__construct();

        $this->name($post->value('title'));
        $this->headline($post->value('title'));
        $this->description(trim(strip_tags($post->summary)));
        $this->url($post->url());
        $this->image(is_null($post->value('imageUrl')) ? Logo::class : $post->value('imageUrl'));
        $this->wordCount($post->value('words'));
        $this->articleSection('Blog');
        $this->author(NoelDeMartin::class);
        $this->creator(NoelDeMartin::class);
        $this->publisher(NoelDeMartinOrganization::class);
        $this->mainEntityOfPage(sroute('home'));
        $this->datePublished($post->publication_date);
        $this->dateCreated($post->publication_date);
        $this->dateModified(max($post->publication_date, $post->modification_date));
    }

    protected function getType(): string
    {
        return 'Article';
    }
}
