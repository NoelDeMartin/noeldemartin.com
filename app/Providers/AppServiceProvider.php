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
        Blade::component('components.card', 'card');
        Blade::component('components.carousel', 'carousel');
        Blade::component('components.comment', 'comment');
        Blade::component('components.content-card', 'contentcard');
        Blade::component('components.experiment', 'experiment');
        Blade::component('components.table-of-contents', 'tableofcontents');

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
        SemanticSEO::sitemap(url('sitemap.xml'), trans('seo.sitemap'));
    }

    protected function bootCarbon()
    {
        Carbon::macro('display', function ($format = 'datetime') {
            $date = $this;

            if (has_timezone_offset())
                $date = $date->copy()->subMinutes(get_timezone_offset());

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
}
