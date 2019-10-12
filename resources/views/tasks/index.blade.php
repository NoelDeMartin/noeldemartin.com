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

                <li class="text-lg mb-2 md:text-xl lg:text-xl xl:text-xl">
                    @if ($task->isCompleted())
                        <span>[Completed]</span>
                    @else
                        <span>[Ongoing]</span>
                    @endif
                    <a href="{{ $task->url }}">{{ $task->name }}</a>
                </li>

            @endforeach

        </ul>

    </article>
@endsection
