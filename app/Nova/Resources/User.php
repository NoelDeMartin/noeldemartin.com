<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Text;

class User extends Resource
{
    public static $model = \App\Models\User::class;

    public static $title = 'username';

    public static $search = [
        'id', 'username', 'email',
    ];

    public static $defaultOrderings = [
        'id' => 'asc',
    ];

    public function fields(Request $request)
    {
        return [
            $this->idField(),

            Gravatar::make(),

            Text::make('Username')->sortable(),

            Text::make('Email')->hideFromIndex(),

            Boolean::make('Admin', 'is_admin')->sortable(),

            Boolean::make('Reviewer', 'is_reviewer')->sortable(),

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
