<?php

namespace App\Http\SEO;

use App\SemanticSEO\BlogPost;
use App\SemanticSEO\Logo;
use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use Carbon\Carbon;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;
use Statamic\Entries\Entry;
use Statamic\Facades\Entry as Entries;

class Blog
{
    public function index(): void
    {
        $posts = collect(Entries::whereCollection('posts')->sortByDesc('publication_date')->all());
        $firstPost = $posts->first();

        SemanticSEO::meta(trans('seo.blog'));

        SemanticSEO::blog()
            ->setAttributes(trans('seo.schema:blog'))
            ->url(sroute('blog'))
            ->image(Logo::class)
            ->sameAs([
                'https://medium.com/@NoelDeMartin',
                'https://steemit.com/@noeldemartin',
            ])
            ->hasPart($posts->map(fn ($post) => new BlogPost($post))->all())
            ->discussionUrl(trans('seo.discussion_urls'))
            ->inLanguage('English')
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class)
            ->datePublished(Carbon::create(2014, 10, 24)->startOfDay())
            ->dateCreated(Carbon::create(2014, 10, 24)->startOfDay())
            ->dateModified(($firstPost->modification_date ?? $firstPost->publication_date)->startOfDay());
    }

    public function show(Entry $post): void
    {
        SemanticSEO::canonical($post->url());
        SemanticSEO::is(new BlogPost($post));
    }
}
