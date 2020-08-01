<?php

namespace App\Support;

use Parsedown as BaseParsedown;

class Parsedown extends BaseParsedown
{

    protected function inlineLink($excerpt)
    {
        $result = parent::inlineLink($excerpt);

        $result['element']['attributes']['target'] = '_blank';

        return $result;
    }

}
