<?php

namespace App\SemanticSEO\Experiments;

use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use Illuminate\Support\Carbon;
use NoelDeMartin\SemanticSEO\Types\WebSite;

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
