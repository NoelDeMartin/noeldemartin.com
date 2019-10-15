@extends('layouts.master')

@section('content')
    <article>

        @auth()
            <a
                href="{{ route('tasks.create') }}"
                class="bg-blue-dark hover:bg-blue-darker hover:text-white text-white font-bold py-2 px-4 rounded float-right"
            >
                Create
            </a>
        @endauth

        <h1>All Tasks</h1>

        <ul class="list-disk pl-4">

            @foreach ($tasks as $task)

                <li class="flex items-center mb-4">
                    <div class="w-32 text-right">
                        <time
                            class="
                                px-2 py-1 mr-2 rounded-lg text-sm
                                {{
                                    $task->isCompleted()
                                        ? 'bg-jade-lighter text-jade-darker'
                                        : 'bg-blue-lighter text-blue-darker'
                                }}
                            "
                        >
                            {{ ($task->completed_at ?? $task->created_at)->display('month') }}
                        </time>
                    </div>

                    @icon(
                        $task->isCompleted() ? 'checkmark' : 'timer',
                        ($task->isCompleted() ? 'text-jade' : 'text-blue') .
                            ' mr-2 fill-current w-4 h-4 inline',
                        [
                            'title' => $task->isCompleted() ? 'Completed' : 'Ongoing',
                        ]
                    )

                    <a class="text-lg" href="{{ $task->url }}">
                        {{ $task->name }}
                    </a>
                </li>

            @endforeach

        </ul>

    </article>
@endsection
