<?php

namespace App\SemanticSEO\Experiments;

use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use Illuminate\Support\Carbon;
use NoelDeMartin\SemanticSEO\Types\WebSite;

class Synonymizer extends WebSite
{
    public function __construct()
    {
        parent::__construct();

        // TODO add image

        $this->setAttributes(trans('seo.schema:synonymizer'));
        $this->url(route('experiments.synonymizer'));
        $this->datePublished(Carbon::create(2016, 4, 24)->startOfDay());
        $this->author(NoelDeMartin::class);
        $this->creator(NoelDeMartin::class);
        $this->publisher(NoelDeMartinOrganization::class);
    }

    protected function getType()
    {
        return 'WebSite';
    }
}
