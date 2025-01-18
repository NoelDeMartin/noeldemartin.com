<?php

namespace App\Providers;

use App\Services\ActivityService;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Statamic\Entries\Entry;
use Statamic\Facades\Collection;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('activity', ActivityService::class);
    }

    public function boot(): void
    {
        $this->bootCarbon();
        $this->bootCollections();
    }

    protected function bootCarbon(): void
    {
        Carbon::macro('display', function ($format = 'datetime') {
            /** @var Carbon $date */
            $date = $this; // @phpstan-ignore-line

            switch ($format) {
                case 'date-short':
                    return $date->format('M d, Y');
                case 'date':
                    return $date->format('F d, Y');
                case 'time':
                    return $date->format('H:i');
                case 'month':
                    return $date->format('F Y');
                case 'month-short':
                    return $date->format('M Y');
                case 'datetime-short':
                    return $date->format('M d, Y H:i');
                case 'datetime':
                default:
                    return $date->format('F d, Y H:i');
            }
        });
    }

    protected function bootCollections(): void
    {
        Collection::computed('posts', 'summary', function (Entry $post) {
            if (! isset($post->content) || ! is_string($post->content)) {
                return null;
            }

            $summary = substr($post->content, 0, strpos($post->content, '<h2') ?: 0);
            $summary = preg_replace('/<a(\s|>)[^>]*>(.*?)<\/a>/', '$2', $summary) ?: '';
            $summary = preg_replace('/<img[^>]*>/', '', $summary);

            return $summary;
        });

        Collection::computed('posts', 'duration', function (Entry $post) {
            if (! isset($post->content) || ! is_string($post->content)) {
                return null;
            }

            $words = str_word_count(strip_tags($post->content));

            return round($words / 200);
        });

        Collection::computed('posts', 'landmarks', function (Entry $post) {
            if (! isset($post->content) || ! is_string($post->content)) {
                return null;
            }

            return parse_landmarks($post->content);
        });

        Collection::computed('projects', 'stateClasses', function (Entry $project) {
            switch ($project->value('state')) {
                case 'live':
                    return 'bg-jade-lighter text-jade-darker';
                case 'archived':
                case 'experimental':
                    return 'bg-yellow-lighter text-yellow-darker';
                default:
                    return 'bg-blue-lighter text-blue-darker';
            }
        });

        Collection::computed('projects', 'images', function (Entry $project) {
            $id = $project->id();

            if (! is_string($id)) {
                return [];
            }

            $project = substr($id, 0, strlen($id) - 8);
            $imagesPath = "img/projects/{$project}/images";

            return collect(File::files(public_path($imagesPath)))
                ->map(function ($file, $index) use ($imagesPath) {
                    $filename = $file->getFilename();
                    $number = $index + 1;

                    return [
                        'url' => "/{$imagesPath}/{$filename}",
                        'description' => "Project image ({$number})",
                    ];
                })
                ->sortBy('url')
                ->toArray();
        });
    }
}
