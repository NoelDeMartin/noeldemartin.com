<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\Organization;

class NoelDeMartinOrganization extends Organization
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
        $this->logo(Logo::class);
        $this->url(route('home'));
    }

    protected function getType()
    {
        return 'Organization';
    }
}