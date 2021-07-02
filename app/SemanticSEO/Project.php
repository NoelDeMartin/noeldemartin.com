<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\Organization;

class Project extends Organization
{
    public function __construct($slug)
    {
        parent::__construct();

        $this->setAttributes(trans("seo.schema:projects.$slug"));
        $this->url(route('projects.show', $slug));
        $this->image(url("img/projects/$slug/logo.png"));
        $this->logo(url("img/projects/$slug/logo.png"));
    }
}
