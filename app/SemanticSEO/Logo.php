<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\ImageObject;

class Logo extends ImageObject
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttributes(trans('seo.schema:logo'));
        $this->url(asset('img/myface.png'));
    }

    protected function getType()
    {
        return 'ImageObject';
    }
}
