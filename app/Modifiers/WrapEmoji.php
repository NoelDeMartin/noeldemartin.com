<?php

namespace App\Modifiers;

use Statamic\Modifiers\Modifier;

class WrapEmoji extends Modifier
{
    public function index(mixed $value): ?string
    {
        $regex = '/([\p{Emoji_Presentation}|\x{1F3FB}-\x{1F3FF}|\x{200D}|\x{FE0F}])/u';

        // @phpstan-ignore-next-line
        return preg_replace($regex, '<span class="emoji">$1</span>', (string) $value);
    }
}
