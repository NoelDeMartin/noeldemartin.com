<?php

namespace App\Support\Facades;

use App\Services\AlternateUrlsService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static AlternateUrlsService add(string $url, ?string $type = null, ?string $title = null)
 * @method static AlternateUrlsService markdown(string $url)
 * @method static array<int, array{url: string, type: ?string, title: ?string}> all()
 * @method static bool has(string $url)
 * @method static AlternateUrlsService clear()
 * @method static string render()
 *
 * @see AlternateUrlsService
 */
class AlternateUrls extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'alternate-urls';
    }
}
