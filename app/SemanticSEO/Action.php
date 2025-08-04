<?php

namespace App\SemanticSEO;

use Illuminate\Support\Str;
use NoelDeMartin\SemanticSEO\SemanticSEO;
use NoelDeMartin\SemanticSEO\Types\Organization;
use NoelDeMartin\SemanticSEO\Types\Person;
use NoelDeMartin\SemanticSEO\Types\Thing;

class Action extends Thing
{
    public function beforeRender(SemanticSEO $seo): void
    {
        $seo->twitter(
            $this->withoutEmptyValues([
                'site' => $this->getTwitterHandleFromAttribute('agent'),
            ]),
            false
        );

        parent::beforeRender($seo);
    }

    protected function getAttributeDefinitions(): array
    {
        return array_merge(parent::getAttributeDefinitions(), [
            'agent' => [Organization::class, Person::class],
            'actionStatus' => 'enumeration:' . implode(',', ActionStatusType::values()),
            'startTime' => 'date',
            'endTime' => 'date',
        ]);
    }

    // TODO move this to Thing class instead
    protected function isType(string $type, mixed $value): bool
    {
        if (Str::startsWith($type, 'enumeration:')) {
            $enumValues = explode(',', substr($type, 12));

            return in_array($value, $enumValues);
        }

        return parent::isType($type, $value);
    }

    // TODO move this to Thing class instead
    protected function castValue(string $type, mixed $value): mixed
    {
        if (Str::startsWith($type, 'enumeration:')) {
            $castedValue = (string) $value;

            return $this->isType($type, $castedValue) ? $castedValue : null;
        }

        return parent::castValue($type, $value);
    }
}
