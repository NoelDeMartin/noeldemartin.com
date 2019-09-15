<?php

namespace App\Nova;

use Laravel\Nova\Resource as NovaResource;
use Laravel\Nova\Http\Requests\NovaRequest;

abstract class Resource extends NovaResource
{
    public static $defaultOrderings = ['id' => 'asc'];

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    public static function scoutQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    public static function detailQuery(NovaRequest $request, $query)
    {
        return parent::detailQuery($request, $query);
    }

    public static function relatableQuery(NovaRequest $request, $query)
    {
        return parent::relatableQuery($request, $query);
    }

    protected static function applyOrderings($query, array $orderings)
    {
        if (empty($orderings)) {
            $orderings = static::$defaultOrderings;
        }

        return parent::applyOrderings($query, $orderings);
    }
}
