<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\Thing;

// TODO hierarchy incomplete (Thing > Intangible > ItemList)
class ItemList extends Thing
{
    public function items($items)
    {
        $position = 0;
        $listItems = [];

        foreach ($items as $item) {
            $listItems[] = (new ListItem)->position(++$position)->item($item);
        }

        return $this->itemListElement($listItems);
    }

    protected function getAttributeDefinitions()
    {
        return array_merge(parent::getAttributeDefinitions(), [
            'itemListElement' => ['string', Thing::class],
            'numberOfItems' => ['integer'],
        ]);
    }
}
