<?php

namespace App\Http\Controllers\Concerns;

use App\Support\Facades\Activity;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;
use Statamic\Entries\Entry;
use Statamic\Facades\Entry as Entries;

trait BroadcastsSiteContent
{
    /**
     * @return Collection<int, Entry>
     */
    protected function getPosts(): Collection
    {
        /** @var Collection<int, Entry> */
        return collect(Entries::whereCollection('posts')->all())
            ->sortByDesc('publication_date')
            ->values();
    }

    /**
     * @return Collection<int, Entry>
     */
    protected function getTasks(): Collection
    {
        /** @var Collection<int, Entry> */
        return collect(Entries::whereCollection('tasks')->all())
            // @phpstan-ignore-next-line
            ->each(fn ($task) => $task->modification_date = $task->completion_date ?? $task->publication_date)
            ->sortByDesc('modification_date')
            ->values();
    }

    /**
     * @return Collection<int, Entry>
     */
    protected function getTalks(): Collection
    {
        /** @var Collection<int, Entry> */
        return collect(Entries::whereCollection('talks')->all())
            ->sortByDesc('presentation_date')
            ->values();
    }

    /**
     * @return Collection<int, Entry>
     */
    protected function getProjects(): Collection
    {
        /** @var Collection<int, Entry> */
        return collect(Entries::whereCollection('projects')->all())->values();
    }

    /**
     * @return array{
     *     posts: Collection<int, Entry>,
     *     tasks: Collection<int, Entry>,
     *     talks: Collection<int, Entry>,
     *     projects: Collection<int, Entry>,
     *     lastModificationDate: CarbonInterface
     * }
     */
    protected function getSiteContent(): array
    {
        return [
            'posts' => $this->getPosts(),
            'tasks' => $this->getTasks(),
            'talks' => $this->getTalks(),
            'projects' => $this->getProjects(),
            'lastModificationDate' => Activity::lastModificationDate(),
        ];
    }
}
