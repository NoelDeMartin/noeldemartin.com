<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\SemanticSEO;
use NoelDeMartin\SemanticSEO\Types\Thing;
use NoelDeMartin\SemanticSEO\Types\Person;
use NoelDeMartin\SemanticSEO\Types\Organization;

class Action extends Thing
{
    public function beforeRender(SemanticSEO $seo)
    {
        $seo->twitter(
            $this->withoutEmptyValues([
                'site' => $this->getTwitterHandleFromAttribute('agent'),
            ]),
            false
        );

        parent::beforeRender($seo);
    }

    protected function getAttributeDefinitions()
    {
        return array_merge(parent::getAttributeDefinitions(), [
            'agent' => [Organization::class, Person::class],
            'actionStatus' => 'enumeration:' . implode(',', ActionStatusType::values()),
            'startTime' => 'date',
            'endTime' => 'date',
        ]);
    }

    // TODO move this to Thing class instead
    protected function isType($type, $value)
    {
        if (starts_with($type, 'enumeration:')) {
            $enumValues = explode(',', substr($type, 12));

            return in_array($value, $enumValues);
        } else {
            return parent::isType($type, $value);
        }
    }

    // TODO move this to Thing class instead
    protected function castValue($type, $value)
    {
        if (starts_with($type, 'enumeration:')) {
            $castedValue = (string) $value;

            return $this->isType($type, $castedValue) ? $castedValue : null;
        } else {
            return parent::castValue($type, $value);
        }
    }
}
