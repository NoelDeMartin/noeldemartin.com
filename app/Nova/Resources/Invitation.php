<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;

class Invitation extends Resource
{
    public static $model = \App\Models\Invitation::class;

    public static $title = 'id';

    public static $search = [
        'id', 'token', 'email',
    ];

    public function fields(Request $request)
    {
        return [
            $this->idField(),

            Text::make('Email')->sortable(),

            Text::make('Token')->hideFromIndex(),

            Boolean::make('Used')->sortable(),

            $this->createdField(),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
