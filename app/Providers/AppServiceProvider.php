<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Project;
use App\Models\Task;
use App\Services\ActivityService;
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
        $this->bootModels();
        $this->bootMarkdown();
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

    protected function bootModels(): void
    {
        Post::boot();
        Task::boot();
        Project::boot();
    }

    protected function bootMarkdown(): void
    {
        Markdown::addExtension(function () {
            return new ExternalLinkExtension;
        });
    }
}
