@extends('layouts.master')

@section('content')
    <article>

        <div class="flex flex-col justify-between md:flex-row lg:flex-row xl:flex-row">
            <h1 class="mb-2 md:mb-4 lg:mb-4 xl:mb-4">What I'm doing now</h1>

            <span class="mb-2 text-sm italic md:mb-0 lg:mb-0 xl:mb-0">
                Last update: <time datetime="{{ $events->first()->date->toDateTimeString() }}">
                    {{ $events->first()->date->display('date') }}
                </time>
            </span>
        </div>

        <p class="mt-2">I practice <a href="{{ url('blog/open-productivity') }}">Open Productivity</a>, and here you can see what I'm up to these days.</p>

        <ul class="list-reset">

            @foreach ($tasks as $task)

                <li class="flex flex-col mb-4 border-b-1 border-grey">
                    <div class="flex flex-col justify-between items-center md:flex-row lg:flex-row xl:flex-row">
                        <h2 class="text-2xl m-0 font-normal underline text-blue">
                            <a href="{{ $task->url }}">
                                {{ $task->name }}
                            </a>
                        </h2>
                        <span class="text-sm italic mt-2 md:mt-0 lg:mt-0 xl:mt-0">
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

                <li class="
                    mb-2 flex flex-col items-start border-grey-light border-b-1
                    md:items-center lg:items-center xl:items-center
                    md:border-b-0 lg:border-b-0 xl:border-b-0
                    md:flex-row lg:flex-row xl:flex-row
                ">
                    <time
                        class="font-mono mr-2 text-sm"
                        datetime="{{ $event->date->toDateTimeString() }}"
                    >
                        {{ $event->date->display('datetime-short') }}
                    </time>
                    <span class="mr-2 hidden md:block lg:block xl:block">|</span>
                    <span class="my-2 md:my-0 lg:my-0 xl:my-0">{!! $event->description !!}</span>
                </li>

            @endforeach

        </ul>

    </article>
@endsection
