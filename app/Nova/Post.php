<?php

namespace App\Nova;

use Illuminate\Http\Request;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

use Pdewit\ExternalUrl\ExternalUrl;

use App\Models\Post as PostModel;
use App\Support\Markdown;

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
        parent::boot();

        PostModel::creating(function ($post) {
            $post->tag = PostModel::createTitleTag($post->title);
            $post->author_id = auth()->id();
            $post->text_html = Markdown::text($post->text_markdown);
        });

        PostModel::updating(function ($post) {
            $post->text_html = PostModel::text($post->text_markdown);
        });
    }

    public function fields(Request $request)
    {
        [, $formsTextField] = $this->markdownFields('Text', 'text_markdown');

        return [
            $this->idField(),

            ExternalUrl::make('Url', 'url')
                ->linkText('View Post')
                ->onlyOnDetail(),

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

            $formsTextField,

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
