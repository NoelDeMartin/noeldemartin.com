<?php

namespace App\Nova\Resources;

use Illuminate\Http\Request;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

use Inspheric\Fields\Url;

use App\Models\Post as PostModel;
use App\Nova\Fields\Markdown;

class Post extends Resource
{
    public static $model = PostModel::class;

    public static $title = 'title';

    public static $search = [
        'title', 'text_markdown',
    ];

    public static $defaultOrderings = [
        'published_at' => 'desc',
    ];

    public static function boot()
    {
        PostModel::creating(function ($post) {
            $post->tag = PostModel::createTitleTag($post->title);
            $post->author_id = auth()->id();
        });
    }

    public function fields(Request $request)
    {
        return [
            $this->idField(),

            Url::make('Url')->clickable()->onlyOnDetail(),

            Text::make('Title')
                ->sortable()
                ->rules('required'),

            // TODO sortable
            Number::make('Duration')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->displayUsing(function ($duration) {
                    return $duration . ' min.';
                }),

            Markdown::make('Text')
                ->rules('required')
                ->stacked(),

            DateTime::make('Published', 'published_at')
                ->sortable()
                ->format('DD MMM YYYY')
                ->rules('required'),

            HasMany::make('Comments', 'comments', PostComment::class),
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
