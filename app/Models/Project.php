<?php

namespace App\Models;

use Illuminate\Support\Facades\File;

/**
 * @method string id()
 * @method string value(string $key)
 */
class Project extends StatamicModel
{
    public function stateClasses(): string
    {
        switch ($this->value('state')) {
            case 'live':
                return 'bg-jade-lighter text-jade-darker';
            case 'archived':
            case 'experimental':
                return 'bg-yellow-lighter text-yellow-darker';
            default:
                return 'bg-blue-lighter text-blue-darker';
        }
    }

    /**
     * @return array<array{url: string, description: string}>
     */
    public function images(): array
    {
        $id = $this->id();
        $project = substr($id, 0, strlen($id) - 8);
        $imagesPath = "img/projects/{$project}/images";

        if (! File::exists(public_path($imagesPath))) {
            return [];
        }

        /** @var array<array{url: string, description: string}> */
        $images = collect(File::files(public_path($imagesPath)))
            ->map(function ($file, $index) use ($imagesPath) {
                $filename = $file->getFilename();
                $number = $index + 1;

                return [
                    'url' => "/{$imagesPath}/{$filename}",
                    'description' => "Project image ({$number})",
                ];
            })
            ->sortBy('url')
            ->toArray();

        return $images;
    }
}
