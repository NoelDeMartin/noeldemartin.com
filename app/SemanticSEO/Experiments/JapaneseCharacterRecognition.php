<?php

namespace App\SemanticSEO\Experiments;

use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use Illuminate\Support\Carbon;
use NoelDeMartin\SemanticSEO\Types\CreativeWork;

class JapaneseCharacterRecognition extends CreativeWork
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttributes(trans('seo.schema:japanese_character_recognition'));
        $this->url('https://github.com/NoelDeMartin/Japanese-Character-Recognition');
        $this->sameAs('https://github.com/NoelDeMartin/Japanese-Character-Recognition');
        $this->datePublished(Carbon::create(2017, 6, 15)->startOfDay());
        $this->author(NoelDeMartin::class);
        $this->creator(NoelDeMartin::class);
        $this->publisher(NoelDeMartinOrganization::class);
    }

    protected function getType()
    {
        return 'CreativeWork';
    }
}
