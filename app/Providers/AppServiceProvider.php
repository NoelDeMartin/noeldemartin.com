<?php

namespace App\Providers;

use App\Services\ActivityService;
use App\Support\DiscoverStatamicModels;
use App\Support\Markdown\FencedCodeRenderer;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use Statamic\Facades\Markdown;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('activity', ActivityService::class);
    }

    public function boot(): void
    {
        $this->bootCarbon();
        $this->bootMarkdown();
        $this->bootStatamicModels();
    }

    protected function bootCarbon(): void
    {
        Carbon::macro('display', function ($format = 'datetime') {
            /** @var Carbon $date */
            $date = $this; // @phpstan-ignore-line

            return match ($format) {
                'day' => $date->format('F d'),
                'date' => $date->format('F j, Y'),
                'month' => $date->format('F Y'),
                'month-short' => $date->format('M Y'),
                'datetime-short' => $date->format('M d, Y H:i'),
                default => $date->format('F j, Y H:i'),
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
}
