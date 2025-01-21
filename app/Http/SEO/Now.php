<?php

namespace App\Http\SEO;

use App\SemanticSEO\Logo;
use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use App\SemanticSEO\WebPage;
use App\Support\Facades\Activity;
use Carbon\Carbon;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;

class Now
{
    public function __invoke(): void
    {
        SemanticSEO::meta(trans('seo.now'));

        SemanticSEO::is(WebPage::class)
            ->setAttributes(trans('seo.schema:now'))
            ->url(sroute('now'))
            ->image(Logo::class)
            ->discussionUrl(trans('seo.discussion_urls'))
            ->inLanguage('English')
            ->about(NoelDeMartin::class)
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class)
            ->datePublished(Carbon::create(2018, 11, 11)->startOfDay())
            ->dateCreated(Carbon::create(2018, 11, 11)->startOfDay())
            ->dateModified(Activity::lastModificationDate());
    }
}
