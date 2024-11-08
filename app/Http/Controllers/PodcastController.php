<?php

namespace App\Http\Controllers;

use App\SemanticSEO\Logo;
use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use App\SemanticSEO\WebPage;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;

class PodcastController extends Controller
{
    public function index()
    {
        SemanticSEO::meta(trans('seo.podcast'));

        SemanticSEO::is(WebPage::class)
            ->setAttributes(trans('seo.schema:podcast'))
            ->url(route('podcast.index'))
            ->image(Logo::class)
            ->discussionUrl($this->discussionUrls)
            ->inLanguage('English')
            ->about((new WebPage)->url(route('home')))
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class);

        return view('podcast.index');
    }

    public function feed()
    {
        return response()
            ->view('podcast.feed')
            ->header('Content-Type', 'application/xml');
    }

    public function style()
    {
        return response(file_get_contents(resource_path('assets/xsl/rss.xsl')))
            ->header('Content-Type', 'text/xml');
    }

}
