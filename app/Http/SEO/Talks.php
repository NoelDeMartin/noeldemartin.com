<?php

namespace App\Http\SEO;

use App\SemanticSEO\Logo;
use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use App\SemanticSEO\WebPage;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;

class Talks
{
    public function __invoke(): void
    {
        SemanticSEO::meta(trans('seo.talks'));

        SemanticSEO::is(WebPage::class)
            ->setAttributes(trans('seo.schema:talks'))
            ->url(sroute('talks'))
            ->image(Logo::class)
            ->discussionUrl(trans('seo.discussion_urls'))
            ->inLanguage('English')
            ->about(NoelDeMartin::class)
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class);
    }
}
