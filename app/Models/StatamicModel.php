<?php

namespace App\Models;

use Illuminate\Support\Str;
use Statamic\Entries\Entry;
use Statamic\Facades\Collection;

abstract class StatamicModel
{
    private Entry $entry;

    public function __construct(Entry $entry)
    {
        $this->entry = $entry;
    }

    public static function boot(): void
    {
        $methods = array_diff(get_class_methods(static::class), ['__construct', '__get', '__call', 'boot']);
        $collection = Str::snake(Str::pluralStudly(class_basename(static::class)));

        foreach ($methods as $method) {
            Collection::computed($collection, $method, function (Entry $entry) use ($method) {
                // @phpstan-ignore-next-line
                return (new static($entry))->{$method}();
            });
        }
    }

    public function __get(string $key): mixed
    {
        return $this->entry->{$key};
    }

    /**
     * @param  array<mixed>  $arguments
     */
    public function __call(string $method, array $arguments): mixed
    {
        return $this->entry->{$method}(...$arguments);
    }
}
