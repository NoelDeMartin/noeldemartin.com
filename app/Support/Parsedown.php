<?php

namespace App\Support;

use Illuminate\Support\Str;
use Parsedown as BaseParsedown;

class Parsedown extends BaseParsedown
{

    public static function render($text) {
        return (new static)->text($text);
    }

    protected function inlineLink($excerpt)
    {
        $result = parent::inlineLink($excerpt);

        $result['element']['attributes'] = $result['element']['attributes'] ?? [];

        if (! Str::startsWith($result['element']['attributes']['href'] ?? '', '#'))
            $result['element']['attributes']['target'] = '_blank';

        return $result;
    }

    protected function blockHeader($Line)
    {
        $result = parent::blockHeader($Line);

        $result['element']['attributes'] = $result['element']['attributes'] ?? [];
        $result['element']['attributes']['id'] = Str::slug($result['element']['text']);

        return $result;
    }

}
