@extends('layouts.master')

@section('content')
    <article>

        <span class="float-right text-sm italic">
            Last Update: <time datetime="{{ $events->first()->date->toDateTimeString() }}">
                {{ $events->first()->date->display('date') }}
            </time>
        </span>

        <h1>What I'm doing now</h1>

        <p>Here I practice <a href="{{ url('blog/open-productivity') }}">Open Productivity</a>.</p>

        <ul class="list-reset">

            @foreach ($tasks as $task)

                <li class="flex flex-col mb-4">
                    <a
                        class="mb-2"
                        href="{{ $task->url }}"
                    >
                        {{ $task->name }}
                    </a>
                    {!! $task->description_html !!}
                </li>

            @endforeach

            <li>
                <a href="{{ route('tasks.index') }}">See all tasks</a>
            </li>

        </ul>

        <hr>

        <h2>Activity log</h2>

        <ul class="list-reset">

            @foreach ($events as $event)

                <li class="flex">
                    <time class="mr-2" datetime="{{ $event->date->toDateTimeString() }}">
                        [{{ $event->date->display('datetime') }}]
                    </time>
                    {!! $event->description !!}
                </li>

                @if (!is_null($event->contents))

                    <li class="italic text-sm">
                        {!! $event->contents !!}
                    </li>

                @endif

            @endforeach

        </ul>

    </article>
@endsection
