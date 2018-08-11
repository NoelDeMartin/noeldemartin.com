<?php

namespace App\SemanticSEO\Experiments;

use Illuminate\Support\Carbon;
use App\SemanticSEO\NoelDeMartin;
use NoelDeMartin\SemanticSEO\Types\WebSite;
use App\SemanticSEO\NoelDeMartinOrganization;

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
