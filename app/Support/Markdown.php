<?php

namespace App\Support;

use Parsedown;

class Markdown
{
    private static $instance = null;

    public static function __callStatic($method, $parameters)
    {
        $instance = static::$instance ?? new Parsedown;

        return call_user_func_array([$instance, $method], $parameters);
    }
}
