<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;

use App\Models\PostComment as PostCommentModel;

class PostComment extends Resource
{
    public static $model = PostCommentModel::class;

    public static $title = 'id';

    public static $search = [
        'id', 'text',
    ];

    public function fields(Request $request)
    {
        return [
            $this->idField(),

            BelongsTo::make('Post')
                ->hideWhenUpdating()
                ->sortable(),

            Text::make('Author')->sortable(),

            Text::make('Text')
                ->onlyOnIndex()
                ->displayUsing(function ($value) { return Str::limit($value, 42); }),

            // TODO make clickable
            Text::make('Author Link')->sortable(),

            Text::make('Text')->hideFromIndex(),

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
