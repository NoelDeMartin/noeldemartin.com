<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootBlade();
        $this->bootSemanticSEO();
        $this->bootCarbon();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function bootBlade()
    {
        Blade::component('components.experiment', 'experiment');
        Blade::component('components.content-card', 'contentcard');
        Blade::component('components.task-comment', 'taskcomment');

        Blade::directive('class', function ($args) {
            return "<?php echo blade_class({$args}); ?>";
        });

        Blade::directive('icon', function ($args) {
            return "<?php echo blade_icon({$args}); ?>";
        });

        Blade::directive('attrs', function ($args) {
            return "<?php echo isset({$args}) ? blade_attrs({$args}) : ''; ?>";
        });
    }

    protected function bootSemanticSEO()
    {
        SemanticSEO::titleSuffix(trans('seo.title_suffix'));
        SemanticSEO::openGraph('site_name', 'Noel De Martin');
        SemanticSEO::rss(url('blog/rss.xml'), trans('seo.rss'));
        SemanticSEO::sitemap(url('sitemap.xml'), trans('seo.sitemap'));
    }

    protected function bootCarbon()
    {
        Carbon::macro('display', function ($format = 'datetime') {
            $date = $this;

            if (session()->has('timezone')) {
                $timezone = session('timezone');

                $date = $date->copy();

                $date->subMinutes($timezone['offset']);
            }

            switch ($format) {
                case 'date-short':
                    return $date->format('M d, Y');
                case 'date':
                    return $date->format('F d, Y');
                case 'time':
                    return $date->format('H:i');
                case 'month':
                    return $date->format('F Y');
                case 'datetime-short':
                    return $date->format('M d, Y H:i');
                case 'datetime':
                default:
                    return $date->format('F d, Y H:i');
            }
        });
    }
}
