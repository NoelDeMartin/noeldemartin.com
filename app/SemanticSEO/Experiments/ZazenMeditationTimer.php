<?php

namespace App\SemanticSEO\Experiments;

use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use Illuminate\Support\Carbon;
use NoelDeMartin\SemanticSEO\Types\CreativeWork;

class ZazenMeditationTimer extends CreativeWork
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttributes(trans('seo.schema:zazen_meditation_timer'));
        $this->url('https://noeldemartin.github.io/zazen-meditation-timer/');
        $this->sameAs('https://github.com/NoelDeMartin/zazen-meditation-timer');
        $this->datePublished(Carbon::create(2017, 9, 18)->startOfDay());
        $this->author(NoelDeMartin::class);
        $this->creator(NoelDeMartin::class);
        $this->publisher(NoelDeMartinOrganization::class);
    }

    protected function getType()
    {
        return 'CreativeWork';
    }
}
