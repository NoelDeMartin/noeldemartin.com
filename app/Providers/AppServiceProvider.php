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
            // TODO adjust date for frontend timezone

            switch($format) {
                case 'date-short':
                    return $this->format('M d, Y');
                case 'date':
                    return $this->format('F d, Y');
                case 'time':
                    return $this->format('H:i');
                case 'datetime-short':
                    return $this->format('M d, Y H:i');
                case 'datetime':
                default:
                    return $this->format('F d, Y H:i');
            }
        });
    }
}
