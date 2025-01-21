<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\Organization;
use Statamic\Structures\Page;

class Project extends Organization
{
    public function __construct(Page $project)
    {
        parent::__construct();

        $slug = $project->slug;

        $this->setAttributes(trans("seo.schema:projects.{$slug}"));
        $this->url($project->url());
        $this->image(url("img/projects/{$slug}/logo.png"));
        $this->logo(url("img/projects/{$slug}/logo.png"));
    }
}
