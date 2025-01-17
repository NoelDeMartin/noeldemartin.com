<?php

use Illuminate\Support\Arr;
use Statamic\Facades\Entry;
use Statamic\Facades\GlobalSet;
use Statamic\Statamic;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

if (! function_exists('sroute')) {

    /**
     * @param  string[]|string  $parameters
     */
    function sroute(string $name, array|string $parameters = [], bool $absolute = true)
    {
        $entry = empty($parameters) ? Entry::find($name) : null;

        if (is_null($entry)) {
            $path = '/' . implode('/', array_merge([$name], Arr::wrap($parameters)));
            $entry = Entry::findByUri($path);
        }

        if (is_null($entry)) {
            throw new RouteNotFoundException("Statamic Route [{$name}] not found.");
        }

        if ($absolute) {
            return strval(Statamic::tag('link')->to($entry->url())->absolute(true));
        }

        return $entry->url();
    }

}

if (! function_exists('sglobal')) {

    function sglobal(string $key)
    {
        [$namespace, $key] = explode('.', $key);
        $set = GlobalSet::findByHandle($namespace);

        if (is_null($set)) {
            throw new Exception("Statamic Global [{$key}] not found.");
        }

        $variables = $set->inCurrentSite();

        if (is_null($variables)) {
            throw new Exception("Statamic Global [{$key}] not found.");
        }

        if (! $variables->has($key)) {
            throw new Exception("Statamic Global [{$key}] not found.");
        }

        return $variables->get($key);
    }

}
