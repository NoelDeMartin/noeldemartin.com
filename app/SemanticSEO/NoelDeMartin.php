<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\Person;

class NoelDeMartin extends Person
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttributes(trans('seo.schema:noeldemartin'));
        $this->sameAs([
            'https://twitter.com/NoelDeMartin',
            'https://github.com/NoelDeMartin',
            'https://www.linkedin.com/in/noeldemartin/',
        ]);
        $this->image(Logo::class);
        $this->url(route('home'));
    }

    protected function getType()
    {
        return 'Person';
    }
}