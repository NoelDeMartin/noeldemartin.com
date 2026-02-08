<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\Thing;
use Override;

// TODO hierarchy incomplete (Thing > Intangible > ItemList)
class ListItem extends Thing
{
    #[Override]
    protected function getAttributeDefinitions(): array
    {
        return array_merge(parent::getAttributeDefinitions(), [
            'position' => ['integer'],
            'item' => [Thing::class],
        ]);
    }
}
