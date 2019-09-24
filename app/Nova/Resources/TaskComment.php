<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;

use Inspheric\Fields\Url;

use App\Nova\Fields\Markdown;

class TaskComment extends Resource
{
    public static $model = \App\Models\TaskComment::class;

    public static $title = 'id';

    public static $search = [
        'id', 'text_markdown',
    ];

    public function fields(Request $request)
    {
        return [
            $this->idField(),

            BelongsTo::make('Task')
                ->hideWhenUpdating()
                ->sortable(),

            Url::make('Url')->clickable()->onlyOnDetail(),

            Text::make('Text', 'text_markdown')
                ->onlyOnIndex()
                ->displayUsing(function ($value) {
                    return Str::limit($value, 42);
                }),

            Markdown::make('Text')
                ->rules('required')
                ->stacked(),

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
