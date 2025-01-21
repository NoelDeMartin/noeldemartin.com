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
            'https://noeldemartin.social/@noeldemartin',
            'https://github.com/NoelDeMartin',
        ]);
        $this->logo(Logo::class);
        $this->url(sroute('home'));
    }

    protected function getType(): string
    {
        return 'Organization';
    }
}
