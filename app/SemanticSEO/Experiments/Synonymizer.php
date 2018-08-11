<?php

namespace App\SemanticSEO\Experiments;

use Illuminate\Support\Carbon;
use App\SemanticSEO\NoelDeMartin;
use NoelDeMartin\SemanticSEO\Types\WebSite;
use App\SemanticSEO\NoelDeMartinOrganization;

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
