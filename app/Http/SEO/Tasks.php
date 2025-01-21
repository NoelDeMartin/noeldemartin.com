<?php

namespace App\Http\SEO;

use App\SemanticSEO\ItemList;
use App\SemanticSEO\Logo;
use App\SemanticSEO\Task;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;
use Statamic\Entries\Entry;
use Statamic\Facades\Entry as Entries;

class Tasks
{
    public function index(): void
    {
        $tasks = collect(Entries::whereCollection('tasks')->all());

        SemanticSEO::meta(trans('seo.tasks'));

        SemanticSEO::is(ItemList::class)
            ->setAttributes(trans('seo.schema:tasks'))
            ->url(sroute('tasks'))
            ->items($tasks->map(fn ($task) => new Task($task))->all())
            ->numberOfItems($tasks->count())
            ->image(Logo::class);
    }

    public function show(Entry $task): void
    {
        SemanticSEO::is(new Task($task));
    }
}
