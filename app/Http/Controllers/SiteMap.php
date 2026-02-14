<?php

namespace App\Http\Controllers;

use App\Support\Facades\Activity;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Statamic\Entries\Entry;
use Statamic\Facades\Entry as Entries;

class SiteMap extends Controller
{
    public function __invoke(): Response
    {
        /**
         * @var string
         */
        $xml = Cache::remember('sitemap', 3600, function () {
            $posts = Entries::whereCollection('posts')->all();
            $tasks = collect(Entries::whereCollection('tasks')->all())
                // @phpstan-ignore-next-line
                ->each(fn ($task) => $task->modification_date = $task->completion_date ?? $task->publication_date)
                ->sortBy('modification_date');
            $talks = collect(Entries::whereCollection('talks')->all())
                ->sortBy('presentation_date');
            $projects = Entries::whereCollection('projects')
                // @phpstan-ignore-next-line
                ->map(fn ($project) => $project->link->value())
                ->filter(fn ($project): bool => $project instanceof Entry);
            $lastModificationDate = Activity::lastModificationDate();

            return view('sitemap.index', ['posts' => $posts, 'tasks' => $tasks, 'projects' => $projects, 'talks' => $talks, 'lastModificationDate' => $lastModificationDate])->render();
        });

        return response($xml)->header('Content-Type', 'application/xml');
    }
}
