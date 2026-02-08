<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\ImageObject;
use Override;

class Logo extends ImageObject
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttributes(trans('seo.schema:logo'));
        $this->url(asset('img/myface.png'));
    }

    #[Override]
    protected function getType(): string
    {
        return 'ImageObject';
    }
}
