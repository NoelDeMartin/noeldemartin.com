<?php

namespace App\SemanticSEO\Experiments;

use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use Illuminate\Support\Carbon;
use NoelDeMartin\SemanticSEO\Types\WebSite;

class OnlineMeeting extends WebSite
{
    public function __construct()
    {
        parent::__construct();

        // TODO add image

        $this->setAttributes(trans('seo.schema:online_meeting'));
        $this->url(route('experiments.online-meeting'));
        $this->datePublished(Carbon::create(2015, 4, 29)->startOfDay());
        $this->author(NoelDeMartin::class);
        $this->creator(NoelDeMartin::class);
        $this->publisher(NoelDeMartinOrganization::class);
    }

    protected function getType()
    {
        return 'WebSite';
    }
}
