<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\Thing;

// TODO hierarchy incomplete (Thing > Intangible > ItemList)
class ListItem extends Thing
{
    protected function getAttributeDefinitions()
    {
        return array_merge(parent::getAttributeDefinitions(), [
            'position' => ['integer'],
            'item' => [Thing::class],
        ]);
    }
}
