@extends('layouts.master')

@section('content')
    <div class="flex flex-col mb-4">
        <h1 class="mb-0">What I'm doing now</h1>

        <span class="text-sm text-blue-darker">
            Last updated <time datetime="{{ $events->first()->date->toDateTimeString() }}">
                {{ $events->first()->date->display('date') }}
            </time>
        </span>
    </div>

    <p class="mt-2">I practice <a href="{{ url('blog/open-productivity') }}">Open Productivity</a>, and here you can see what I'm up to these days.</p>

    @foreach ($tasks as $task)
        @contentcard([
            'url' => $task->url,
            'title' => $task->name,
        ])
            {!! $task->description_html !!}
        @endcontentcard
    @endforeach

    <div class="mt-0 text-left md:text-right md:-mt-8">
        <a href="{{ route('tasks.index') }}">
            See previous tasks →
        </a>
    </div>

    <hr class="w-full mt-2 bg-grey-lighter hidden md:block">

    <h3>Activity</h3>

    <ul>

        @foreach ($events as $event)

            <li class="
                mb-2 flex flex-col items-start border-grey-light border-b
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
@endsection
