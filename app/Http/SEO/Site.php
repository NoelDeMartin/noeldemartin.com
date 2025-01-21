<?php

namespace App\Http\SEO;

use App\SemanticSEO\Logo;
use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use App\SemanticSEO\WebPage;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;

class Site
{
    public function __invoke(): void
    {
        SemanticSEO::meta(trans('seo.site'));

        SemanticSEO::is(WebPage::class)
            ->setAttributes(trans('seo.schema:site'))
            ->url(sroute('site'))
            ->image(Logo::class)
            ->discussionUrl(trans('seo.discussion_urls'))
            ->inLanguage('English')
            ->about((new WebPage)->url(sroute('home')))
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class);
    }
}
