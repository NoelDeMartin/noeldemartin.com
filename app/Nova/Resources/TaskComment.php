<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;

use Laravel\Nova\Fields\BelongsTo;

use Inspheric\Fields\Url;

use App\Models\TaskComment as TaskCommentModel;
use App\Support\Markdown;

class TaskComment extends Resource
{
    public static $model = TaskCommentModel::class;

    public static $title = 'id';

    public static $search = [
        'id', 'text_markdown',
    ];

    public static function boot()
    {
        parent::boot();

        TaskCommentModel::saving(function ($comment) {
            $comment->text_html = Markdown::text($comment->text_markdown);
        });
    }

    public function fields(Request $request)
    {
        [$indexTextField, $formsTextField] = $this->markdownFields('Text', 'text_markdown');

        return [
            $this->idField(),

            BelongsTo::make('Task')
                ->hideWhenUpdating()
                ->sortable(),

            Url::make('Url')->clickable()->onlyOnDetail(),

            $indexTextField,

            $formsTextField,

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
