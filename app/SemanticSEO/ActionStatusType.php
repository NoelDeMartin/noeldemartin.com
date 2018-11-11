<?php

namespace App\SemanticSEO;

use NoelDeMartin\SemanticSEO\Types\Thing;

// TODO hierarchy incomplete (Thing > Intangible > Enumeration > ActionStatusType)
class ActionStatusType extends Thing
{
    const ACTIVE = 'https://schema.org/ActiveActionStatus';
    const COMPLETED = 'https://schema.org/CompletedActionStatus';
    const FAILED = 'https://schema.org/FailedActionStatus';
    const POTENTIAL = 'https://schema.org/PotentialActionStatus';

    public static function values()
    {
        return [
            ActionStatusType::ACTIVE,
            ActionStatusType::COMPLETED,
            ActionStatusType::FAILED,
            ActionStatusType::POTENTIAL,
        ];
    }
}
