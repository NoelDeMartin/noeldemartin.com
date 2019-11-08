<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\SemanticSEO\ItemList;
use App\SemanticSEO\Task as TaskSEO;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all()->sort(function ($task1, $task2) {
            $date1 = $task1->completed_at ?? $task1->created_at;
            $date2 = $task2->completed_at ?? $task2->created_at;

            return $date1 > $date2 ? -1 : 1;
        });

        SemanticSEO::meta(trans('seo.tasks'));

        SemanticSEO::is(ItemList::class)
            ->setAttributes(trans('seo.schema:tasks'))
            ->url(route('tasks.index'))
            ->items($tasks->map(function ($task) {
                return new TaskSEO($task);
            })->all())
            ->numberOfItems($tasks->count())
            ->image(Logo::class);

        return view('tasks.index', compact('tasks'));
    }

    public function show($slug)
    {
        $task = Task::with('comments')->findBySlug($slug);

        if (is_null($task)) {
            abort(404);
        }

        SemanticSEO::is(new TaskSEO($task));

        return view('tasks.show', compact('task'));
    }
}
