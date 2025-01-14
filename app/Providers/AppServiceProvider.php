<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Statamic\Entries\Entry;
use Statamic\Facades\Collection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
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
    }
}
