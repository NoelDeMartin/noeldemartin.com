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
        Collection::computed('posts', 'summary', function (Entry $entry) {
            if (! isset($entry->content) || ! is_string($entry->content)) {
                return null;
            }

            $summary = substr($entry->content, 0, strpos($entry->content, '<h2') ?: 0);
            $summary = preg_replace('/<a(\s|>)[^>]*>(.*?)<\/a>/', '$2', $summary) ?: '';
            $summary = preg_replace('/<img[^>]*>/', '', $summary);

            return $summary;
        });

        Collection::computed('posts', 'duration', function (Entry $entry) {
            if (! isset($entry->content) || ! is_string($entry->content)) {
                return null;
            }

            $words = str_word_count(strip_tags($entry->content));

            return round($words / 200);
        });

        Collection::computed('projects', 'stateClasses', function (Entry $entry) {
            switch ($entry->value('state')) {
                case 'live':
                    return 'bg-jade-lighter text-jade-darker';
                case 'archived':
                case 'experimental':
                    return 'bg-yellow-lighter text-yellow-darker';
                default:
                    return 'bg-blue-lighter text-blue-darker';
            }
        });

        Collection::computed('projects', 'images', function (Entry $entry) {
            $id = $entry->id();

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
