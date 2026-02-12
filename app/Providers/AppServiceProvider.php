<?php

namespace App\Providers;

use App\Services\ActivityService;
use App\Support\DiscoverStatamicModels;
use App\Support\Markdown\FencedCodeRenderer;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Nightwatch\Facades\Nightwatch;
use Laravel\Nightwatch\Records\CacheEvent;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use Override;
use Statamic\Facades\Markdown;

class AppServiceProvider extends ServiceProvider
{
    #[Override]
    public function register(): void
    {
        $this->app->singleton('activity', ActivityService::class);
    }

    public function boot(): void
    {
        ini_set('memory_limit', '512M');

        $this->bootCarbon();
        $this->bootMarkdown();
        $this->bootStatamicModels();
        $this->bootNightwatch();
    }

    protected function bootCarbon(): void
    {
        Carbon::macro('display', function ($format = 'datetime') {
            /** @var Carbon $date */
            $date = $this;

            // @phpstan-ignore cast.string
            $timezoneDate = $date->clone()->setTimezone((string) config('app.timezone'));

            return match ($format) {
                'day' => $timezoneDate->format('F d'),
                'date' => $timezoneDate->format('F j, Y'),
                'month' => $timezoneDate->format('F Y'),
                'month-short' => $timezoneDate->format('M Y'),
                'datetime-short' => $timezoneDate->format('M d, Y H:i'),
                default => $timezoneDate->format('F j, Y H:i'),
            };
        });
    }

    protected function bootMarkdown(): void
    {
        Markdown::addExtension(fn (): ExternalLinkExtension => new ExternalLinkExtension);
        Markdown::addRenderer(fn (): array => [FencedCode::class, new FencedCodeRenderer]);
    }

    protected function bootStatamicModels(): void
    {
        $models = DiscoverStatamicModels::within(base_path('app/Models'));

        foreach ($models as $model) {
            $model->getName()::boot();
        }
    }

    protected function bootNightwatch(): void
    {
        Nightwatch::rejectCacheEvents(function (CacheEvent $cacheEvent): bool {
            return Str::startsWith($cacheEvent->key, 'stache::')
                || Str::startsWith($cacheEvent->key, 'static-caching::');
        });
    }
}
