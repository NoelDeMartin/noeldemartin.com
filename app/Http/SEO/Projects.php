<?php

namespace App\Http\SEO;

use App\SemanticSEO\Logo;
use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use App\SemanticSEO\Project;
use App\SemanticSEO\WebPage;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;
use Statamic\Entries\Entry;

class Projects
{
    public function index(): void
    {
        SemanticSEO::meta(trans('seo.projects'));

        SemanticSEO::is(WebPage::class)
            ->setAttributes(trans('seo.schema:projects'))
            ->url(sroute('projects'))
            ->image(Logo::class)
            ->discussionUrl(trans('seo.discussion_urls'))
            ->inLanguage('English')
            ->about((new WebPage)->url(sroute('home')))
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class);
    }

    public function show(Entry $project): void
    {
        SemanticSEO::meta(trans("seo.projects.{$project->slug}"));
        SemanticSEO::is(new Project($project));
    }
}
