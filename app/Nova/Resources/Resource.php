<?php

namespace App\Nova\Resources;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;

abstract class Resource extends NovaResource
{
    public static $defaultOrderings = ['created_at' => 'desc'];

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

    protected function idField()
    {
        return ID::make()->hideFromIndex()->sortable();
    }

    protected function createdField()
    {
        return DateTime::make('Created', 'created_at')
            ->sortable()
            ->format('DD MMM YYYY')
            ->hideWhenCreating()
            ->hideWhenUpdating();
    }
}
