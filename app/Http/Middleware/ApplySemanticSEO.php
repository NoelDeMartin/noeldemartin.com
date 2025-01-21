<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;
use Statamic\Contracts\Entries\Entry;
use Statamic\Facades\Entry as Entries;
use Symfony\Component\HttpFoundation\Response;

class ApplySemanticSEO
{
    public function handle(Request $request, Closure $next): Response
    {
        $entry = Entries::findByUri('/' . rtrim(request()->path(), '/'));

        if (! is_null($entry)) {
            $this->applyEntry($entry);
        }

        return $next($request);
    }

    protected function applyEntry(Entry $entry): void
    {
        SemanticSEO::titleSuffix(trans('seo.title_suffix'));
        SemanticSEO::openGraph('site_name', trans('seo.site_name'));
        SemanticSEO::sitemap(url('sitemap.xml'), trans('seo.sitemap'));
        SemanticSEO::title(trim($entry->value('title') ?? '') ?: trans('seo.site_name'));

        $uriParts = array_values(array_filter(explode('/', rtrim(request()->path(), '/'))));
        $handlerClass = 'App\Http\SEO\\' . Str::studly($uriParts[0] ?? 'home');

        if (! class_exists($handlerClass)) {
            return;
        }

        $handler = app($handlerClass);

        if (is_callable($handler)) {
            $handler();

            return;
        }

        if (count($uriParts) === 1 && method_exists($handler, 'index')) {
            $handler->index();

            return;
        }

        if (method_exists($handler, 'show')) {
            $handler->show($entry);

            return;
        }
    }
}
