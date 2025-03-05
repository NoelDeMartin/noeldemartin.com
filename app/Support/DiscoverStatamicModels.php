<?php

namespace App\Support;

use App\Models\StatamicModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionException;
use SplFileInfo;

class DiscoverStatamicModels
{
    /**
     * @return ReflectionClass<StatamicModel>[]
     */
    public static function within(string $path): array
    {
        $models = [];
        $files = File::allFiles($path);

        foreach ($files as $file) {
            try {
                // @phpstan-ignore-next-line
                $model = new ReflectionClass(static::classFromFile($file));
            } catch (ReflectionException) {
                continue;
            }

            if (! $model->isInstantiable() || ! $model->isSubclassOf(StatamicModel::class)) {
                continue;
            }

            $models[] = $model;
        }

        return $models;
    }

    protected static function classFromFile(SplFileInfo $file): string
    {
        $class = trim(Str::replaceFirst(base_path(), '', $file->getRealPath()), DIRECTORY_SEPARATOR);

        return ucfirst(Str::camel(str_replace(
            [DIRECTORY_SEPARATOR, ucfirst(basename(app()->path())) . '\\'],
            ['\\', app()->getNamespace()],
            ucfirst(Str::replaceLast('.php', '', $class))
        )));
    }
}
