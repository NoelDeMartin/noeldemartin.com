<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
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

            Text::make('Username')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->hideFromIndex()
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Boolean::make('Admin', 'is_admin')
                ->sortable(),

            Boolean::make('Reviewer', 'is_reviewer')
                ->sortable(),

            $this->createdField(),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),
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
