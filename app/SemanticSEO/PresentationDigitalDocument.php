<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\CreativeWork;
use Override;
use Statamic\Entries\Entry;

class PresentationDigitalDocument extends CreativeWork
{
    public function __construct(Entry $talk)
    {
        parent::__construct();

        $this->name($talk->value('title'));
        $this->headline($talk->value('title'));
        $this->description(strip_tags($talk->content));
        $this->url($talk->value('slidesUrl'));
        $this->author(NoelDeMartin::class);
        $this->creator(NoelDeMartin::class);
        $this->publisher(NoelDeMartinOrganization::class);
        $this->mainEntityOfPage(sroute('home'));
        $this->datePublished($talk->presentation_date);
        $this->dateCreated($talk->presentation_date);
        $this->dateModified($talk->presentation_date);
    }

    #[Override]
    protected function getType(): string
    {
        return 'PresentationDigitalDocument';
    }
}
