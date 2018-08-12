<?php

namespace App\Providers;

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
        Blade::component('components.experiment', 'experiment');

        Blade::directive('class', function ($args) {
            return "<?php echo blade_class({$args}); ?>";
        });

        Blade::directive('icon', function ($args) {
            return "<?php echo blade_icon({$args}); ?>";
        });

        SemanticSEO::titleSuffix(trans('seo.title_suffix'));
        SemanticSEO::rss(url('blog/rss.xml'), trans('seo.rss'));
        SemanticSEO::sitemap(url('sitemap.xml'), trans('seo.sitemap'));
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
}
