<?php

namespace App\Http\SEO;

use App\SemanticSEO\Logo;
use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use App\SemanticSEO\WebPage;
use App\Support\Facades\Activity;
use Carbon\Carbon;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;
use NoelDeMartin\SemanticSEO\Types\AboutPage;
use NoelDeMartin\SemanticSEO\Types\Blog;

class Home
{
    public function __invoke(): void
    {
        SemanticSEO::meta(trans('seo.home'));
        SemanticSEO::canonical(sroute('home'));
        SemanticSEO::is(NoelDeMartin::class);

        SemanticSEO::website()
            ->setAttributes(trans('seo.schema:website'))
            ->url(sroute('home'))
            ->image(Logo::class)
            ->discussionUrl(trans('seo.discussion_urls'))
            ->inLanguage('English')
            ->hasPart([
                (new AboutPage)
                    ->setAttributes(trans('seo.schema:about'))
                    ->url(sroute('home')),
                (new Blog)
                    ->setAttributes(trans('seo.schema:blog'))
                    ->url(sroute('blog')),
                (new WebPage)
                    ->setAttributes(trans('seo.schema:now'))
                    ->url(sroute('now')),
                (new WebPage)
                    ->setAttributes(trans('seo.schema:site'))
                    ->url(sroute('site')),
            ])
            ->about(NoelDeMartin::class)
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class)
            ->datePublished(Carbon::create(2014, 10, 24)->startOfDay())
            ->dateCreated(Carbon::create(2014, 10, 24)->startOfDay())
            ->dateModified(Activity::lastModificationDate()->startOfDay());

        SemanticSEO::about()
            ->setAttributes(trans('seo.schema:about'))
            ->url(sroute('home'))
            ->about(NoelDeMartin::class)
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class);
    }
}
