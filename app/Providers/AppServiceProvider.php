<?php

namespace App\Providers;

use App\Services\ActivityService;
use App\Support\DiscoverStatamicModels;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
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

            switch ($format) {
                case 'date':
                    return $date->format('F j, Y');
                case 'month':
                    return $date->format('F Y');
                case 'month-short':
                    return $date->format('M Y');
                case 'datetime-short':
                    return $date->format('M d, Y H:i');
                case 'datetime':
                default:
                    return $date->format('F j, Y H:i');
            }
        });
    }

    protected function bootMarkdown(): void
    {
        Markdown::addExtension(function () {
            return new ExternalLinkExtension;
        });
    }

    protected function bootStatamicModels(): void
    {
        $models = DiscoverStatamicModels::within(base_path('app/Models'));

        foreach ($models as $model) {
            $model->getName()::boot();
        }
    }
}
