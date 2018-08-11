<?php

namespace App\SemanticSEO\Experiments;

use Illuminate\Support\Carbon;
use App\SemanticSEO\NoelDeMartin;
use NoelDeMartin\SemanticSEO\Types\WebSite;
use App\SemanticSEO\NoelDeMartinOrganization;

class FreedomCalculator extends WebSite
{
    public function __construct()
    {
        parent::__construct();

        // TODO add image

        $this->setAttributes(trans('seo.schema:freedom_calculator'));
        $this->url(route('experiments.freedom-calculator'));
        $this->datePublished(Carbon::create(2014, 12, 9)->startOfDay());
        $this->author(NoelDeMartin::class);
        $this->creator(NoelDeMartin::class);
        $this->publisher(NoelDeMartinOrganization::class);
    }

    protected function getType()
    {
        return 'WebSite';
    }
}
