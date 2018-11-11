@extends('layouts.master')

@section('content')
    <article>

        <span class="float-right text-sm italic">
            Last update: <time datetime="{{ $events->first()->date->toDateTimeString() }}">
                {{ $events->first()->date->display('date') }}
            </time>
        </span>

        <h1>What I'm doing now</h1>

        <p>I practice <a href="{{ url('blog/open-productivity') }}">Open Productivity</a>, and here you can see what I'm up to these days.</p>

        <ul class="list-reset">

            @foreach ($tasks as $task)

                <li class="flex flex-col mb-4 border-b-1 border-grey">
                    <div class="flex justify-between">
                        <h2 class="text-2xl m-0 font-normal">
                            <a href="{{ $task->url }}">
                                {{ $task->name }}
                            </a>
                        </h2>
                        <span class="text-sm italic">
                            Started {{ $task->created_at->diffForHumans() }}
                        </span>
                    </div>
                    {!! $task->description_html !!}
                </li>

            @endforeach

            <li class="text-center">
                <a href="{{ route('tasks.index') }}">See all tasks</a>
            </li>

        </ul>

        <h3>Activity log</h3>

        <ul class="list-reset">

            @foreach ($events as $event)

                <li class="mb-2 flex items-center">
                    <time
                        class="font-mono mr-2 text-sm"
                        datetime="{{ $event->date->toDateTimeString() }}"
                    >
                        {{ $event->date->display('datetime-short') }}
                    </time>
                    <span class="mr-2">|</span>
                    <span>{!! $event->description !!}</span>
                </li>

            @endforeach

        </ul>

    </article>
@endsection
