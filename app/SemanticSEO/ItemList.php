<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\Thing;
use Override;

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

    #[Override]
    protected function getAttributeDefinitions(): array
    {
        return array_merge(parent::getAttributeDefinitions(), [
            'itemListElement' => ['string', Thing::class],
            'numberOfItems' => ['integer'],
        ]);
    }
}
