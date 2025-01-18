@extends('layout')

@php
    $events = \App\Support\Facades\Activity::events()->groupBy(fn ($event) => $event->date->year);
    $lastModificationDate = \App\Support\Facades\Activity::lastModificationDate();
@endphp

@section('main')
    <div class="relative mb-4 flex flex-col">
        <h1 class="mb-0">What I'm doing now</h1>

        <span class="text-blue-darker text-sm">
            Last updated
            <time datetime="{{ $lastModificationDate->toDateTimeString() }}">
                {{ $lastModificationDate->display('date') }}
            </time>
        </span>

        <div
            class="mt-2 flex flex-row gap-2 md:absolute md:top-0 md:right-0 md:flex-col"
        >
            <a
                class="bg-rss flex items-center justify-start rounded p-1 text-sm text-white no-underline opacity-75 hover:text-white hover:opacity-100 focus:opacity-100"
                href="{{ route('now.rss') }}"
                aria-label="Open RSS feed"
                title="Open RSS feed"
                target="_blank"
            >
                <s:partial
                    src="icons/rss"
                    class="inline h-4 fill-current text-white"
                />
            </a>
        </div>
    </div>

    <div class="max-w-readable">
        @antlers
            {{ content }}
        @endantlers
    </div>

    <s:collection
        from="tasks"
        completion_date:exists="false"
        sort="publication_date:desc"
        as="tasks"
    >
        @if ($tasks->isEmpty())
            <div
                class="bg-grey-lighter border-grey-light flex w-full flex-col items-center justify-center rounded-lg border p-8"
            >
                <s:partial src="icons/task-completed" class="size-20" />

                <!-- prettier-ignore -->
                <p class="mt-8 mb-0 text-center text-lg">
                    Seems like I have completed all my tasks! Come back later or check out my <a href="{{ sroute('tasks') }}">previous tasks</a>.
                </p>
            </div>
        @else
            @foreach ($tasks as $task)
                <x-content-card :url="$task->url" :title="$task->title">
                    @antlers
                        {{ task:content }}
                    @endantlers
                </x-content-card>
            @endforeach

            <div class="mt-0 text-left md:-mt-8 md:text-right">
                <a href="{{ sroute('tasks') }}">See previous tasks →</a>
            </div>

            <hr class="border-grey mt-4 hidden w-full md:block" />
        @endif
    </s:collection>

    <h2>Past activity</h2>

    @foreach ($events as $year => $yearEvents)
        <details {{ $loop->first ? 'open' : '' }} class="mb-4">
            <summary
                class="hover:text-blue-darkest focus:text-blue-darkest mb-2 hover:cursor-pointer"
            >
                {{ $year }}
            </summary>

            <ul class="ml-0 list-none p-0">
                @foreach ($yearEvents as $event)
                    <x-comment tag="li" :date="$event->date" short="true">
                        <p class="md:m-0">{!! $event->description !!}</p>
                    </x-comment>
                @endforeach
            </ul>
        </details>
    @endforeach

    <!-- prettier-ignore -->
    <p>
        Do you think this is cool? This is a <a href="https://nownownow.com/about" target="_blank">now page</a>,
        and you should have one too ;).
    </p>
@endsection
