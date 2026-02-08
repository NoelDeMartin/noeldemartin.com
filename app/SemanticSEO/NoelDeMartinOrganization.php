<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\Organization;
use Override;

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

    #[Override]
    protected function getType(): string
    {
        return 'Organization';
    }
}
