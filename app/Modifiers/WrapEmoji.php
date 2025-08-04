<?php

namespace App\Modifiers;

use Statamic\Modifiers\Modifier;

class WrapEmoji extends Modifier
{
    public function index(mixed $value): ?string
    {
        if (!is_string($value)) {
            return null;
        }

        $regex = '/([\p{Emoji_Presentation}|\x{1F3FB}-\x{1F3FF}|\x{200D}|\x{FE0F}])/u';

        return preg_replace($regex, '<span class="emoji">$1</span>', $value);
    }
}
