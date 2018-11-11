<?php

namespace App\Http\Controllers;

use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        // TODO SEO

        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    public function show($slug)
    {
        // TODO SEO

        $task = Task::with('comments')->findBySlug($slug);

        if (is_null($task)) {
            abort(404);
        }

        return view('tasks.show', compact('task'));
    }
}
