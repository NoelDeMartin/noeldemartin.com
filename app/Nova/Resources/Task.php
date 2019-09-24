<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;

use Inspheric\Fields\Url;

use App\Models\Task as TaskModel;
use App\Support\Markdown;

class Task extends Resource
{
    public static $model = TaskModel::class;

    public static $title = 'name';

    public static $search = [
        'name', 'description_markdown',
    ];

    public static function boot()
    {
        parent::boot();

        TaskModel::creating(function ($task) {
            $task->slug = TaskModel::newSlug($task->name);
            $task->description_html = Markdown::text($task->description_markdown);
        });

        TaskModel::updating(function ($task) {
            $task->description_html = Markdown::text($task->description_markdown);
        });
    }

    public function fields(Request $request)
    {
        [, $formsDescriptionField] = $this->markdownFields('Description', 'description_markdown');

        return [
            $this->idField(),

            Url::make('Url')->clickable()->onlyOnDetail(),

            Text::make('Name')
                ->sortable()
                ->rules('required'),

            $formsDescriptionField,

            DateTime::make('Completed', 'completed_at')
                ->sortable()
                ->nullable()
                ->format('DD MMM YYYY')
                ->hideWhenCreating(),

            $this->createdField(),

            HasMany::make('Comments', 'comments', TaskComment::class),
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
        return [
            new Actions\CompleteTask,
        ];
    }
}
