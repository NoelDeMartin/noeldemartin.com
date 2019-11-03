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

                <li
                    class="
                        flex flex-col items-start mb-4
                        md:flex-row md:items-center
                    "
                >

                    <div
                        class="
                            flex flex-shrink-0 flex-row-reverse items-center
                            md:flex-row
                        "
                    >
                        <time
                            class="
                                px-2 py-1 mr-2 rounded-lg text-sm font-mono
                                {{
                                    $task->isCompleted()
                                        ? 'bg-jade-lighter text-jade-darker'
                                        : 'bg-blue-lighter text-blue-darker'
                                }}
                            "
                        >
                            <span class="block md:hidden">
                                {{ ($task->completed_at ?? $task->created_at)->display('month') }}
                            </span>
                            <span class="hidden md:block">
                                {{ ($task->completed_at ?? $task->created_at)->display('month-short') }}
                            </span>
                        </time>

                        @icon(
                            $task->isCompleted() ? 'checkmark' : 'timer',
                            ($task->isCompleted() ? 'text-jade' : 'text-blue') .
                                ' mr-2 fill-current w-4 h-4 inline',
                            [
                                'title' => $task->isCompleted() ? 'Completed' : 'Ongoing',
                            ]
                        )
                    </div>

                    <a class="text-lg mt-2 ml-2 md:m-0" href="{{ $task->url }}">
                        {{ $task->name }}
                    </a>
                </li>

            @endforeach

        </ul>

    </article>
@endsection
