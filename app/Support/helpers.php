<?php

use Carbon\Carbon;
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

if (! function_exists('parse_landmarks')) {

    function _parse_html_headings(string $html): array
    {
        preg_match_all('/<h(\d) id="([^"]+)"[^>]*>(.+?)<\/h\d>/sm', $html, $matches);

        return array_map(
            function ($_, $level, $anchor, $title) {
                return (object) [
                    'title' => trim(_remove_anchor_from_title($title)),
                    'anchor' => "#{$anchor}",
                    'level' => intval($level),
                ];
            },
            ...$matches
        );
    }

    function _remove_anchor_from_title(string $title): string
    {
        return preg_replace('/<a href="#[^"]+"[^>]*>(.*?)<\/a>/sm', '$1', $title);
    }

    function _create_ancestor_landmark($previousLandmark, $header)
    {
        while ($previousLandmark->level !== $header->level) {
            $previousLandmark = $previousLandmark->parent;
        }

        $landmark = (object) [
            'level' => $header->level,
            'title' => $header->title,
            'anchor' => $header->anchor,
            'parent' => $previousLandmark->parent,
            'children' => [],
        ];

        return tap($landmark, function ($landmark) use ($previousLandmark) {
            $previousLandmark->parent->children[] = $landmark;
        });
    }

    function _create_descendant_landmark($previousLandmark, $header)
    {
        while ($previousLandmark->level !== $header->level - 1) {
            $childLandmark = (object) [
                'level' => $previousLandmark->level + 1,
                'parent' => $previousLandmark,
                'children' => [],
            ];

            $previousLandmark->children[] = $childLandmark;
            $previousLandmark = $childLandmark;
        }

        $landmark = (object) [
            'level' => $header->level,
            'title' => $header->title,
            'anchor' => $header->anchor,
            'parent' => $previousLandmark,
            'children' => [],
        ];

        return tap($landmark, function ($landmark) use ($previousLandmark) {
            $previousLandmark->children[] = $landmark;
        });
    }

    function _clean_landmark_tree($landmark)
    {
        while ($landmark->level !== 1) {
            $landmark = $landmark->parent;
        }

        _clean_landmark($landmark);

        return $landmark;
    }

    function _clean_landmark($landmark)
    {
        unset($landmark->parent);

        if (empty($landmark->children)) {
            unset($landmark->children);
        } else {
            array_map('_clean_landmark', $landmark->children);
        }
    }

    /**
     * @return array<Landmark>
     */
    function parse_landmarks(string $html): array
    {
        $headings = _parse_html_headings($html);
        $currentLandmark = (object) [
            'level' => 1,
            'children' => [],
        ];

        foreach ($headings as $heading) {
            $currentLandmark = $currentLandmark->level >= $heading->level
                ? _create_ancestor_landmark($currentLandmark, $heading)
                : _create_descendant_landmark($currentLandmark, $heading);
        }

        return _clean_landmark_tree($currentLandmark)->children ?? [];
    }

}

if (! function_exists('antlers_icon')) {
    function antlers_icon(string $name, string $class = '', array $attrs = []): string
    {
        $attrsString = "class=\"{$class}\"";

        foreach ($attrs as $attr => $value) {
            $attrsString .= " {$attr}=\"{$value}\"";
        }

        return str_replace('class="{{ class ?? \'\' }}"', $attrsString, file_get_contents(resource_path("views/icons/{$name}.antlers.html")));
    }
}

if (! function_exists('carbon')) {

    function carbon(string $date)
    {
        return new Carbon($date);
    }

}
