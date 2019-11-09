<?php

use Illuminate\Support\Facades\Config;

if (! function_exists('get_timezone_offset')) {

    function get_timezone_offset()
    {
        if (!isset($_COOKIE['timezone_offset']))
            return null;

        return intval($_COOKIE['timezone_offset']);
    }

}

if (! function_exists('set_timezone_offset')) {

    function set_timezone_offset($value)
    {
        $expiresAt = now()->addMinutes(Config::get('session.lifetime'));

        setcookie('timezone_offset', $value, $expiresAt->timestamp, '/');
    }

}

if (! function_exists('has_timezone_offset')) {

    function has_timezone_offset()
    {
        return ! is_null(get_timezone_offset());
    }

}
