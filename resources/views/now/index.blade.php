@extends('layouts.master')

@section('content')
    <div class="flex flex-col relative mb-4">
        <h1 class="mb-0">What I'm doing now</h1>

        <span class="text-sm text-blue-darker">
            Last updated <time datetime="{{ $updatedAt->toDateTimeString() }}">
                {{ $updatedAt->display('date') }}
            </time>
        </span>

        <div class="absolute top-0 right-0 flex flex-col gap-2">
            <a
                class="
                    items-center justify-start opacity-75
                    bg-hey text-white px-2 py-1 rounded no-underline text-sm flex
                    hover:opacity-100 hover:text-white
                    focus:opacity-100
                "
                href="https://world.hey.com/noeldemartin"
                aria-label="Subscribe to Newsletter"
                title="Subscribe to newsletter"
                target="_blank"
            >
                @icon('email', 'inline h-4 text-white fill-current')
                <span class="text-white ml-1 font-medium">Newsletter</span>
            </a>

            <a
                class="
                    items-center justify-start opacity-75
                    bg-rss text-white px-2 py-1 rounded no-underline text-sm flex
                    hover:opacity-100 hover:text-white
                    focus:opacity-100
                "
                href="{{ route('now.rss') }}"
                aria-label="Open RSS feed"
                title="Open RSS feed"
                target="_blank"
            >
                @icon('rss', 'inline h-4 text-white fill-current')
                <span class="text-white ml-1 font-medium">RSS</span>
            </a>
        </div>
    </div>

    <p class="mt-2 max-w-readable">
        I am currently based in <a href="https://en.wikipedia.org/wiki/Barcelona" target="_blank">Barcelona</a>, working
        at <a href="https://moodle.com/" target="_blank">Moodle</a>
        4 days a week, and doing side projects the rest of the time. I practice
        <a href="{{ url('blog/open-productivity') }}">Open Productivity</a>, and here
        you can see what I'm up to these days:
    </p>

    @if($tasks->isEmpty())
        <div class="flex flex-col items-center justify-center w-full bg-grey-lighter p-8 rounded-lg border border-grey-light">
            @icon('task-completed', 'w-20 h-20')
            <p class="text-lg text-center mt-8 mb-0">
                Seems like I have completed all my tasks! Come back later or check out my
                <a href="{{ route('tasks.index') }}">previous tasks</a>.
            </p>
        </div>
    @else
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

        <hr class="w-full mt-4 bg-grey-lighter hidden md:block">
    @endif

    <h2>Past activity</h2>

    @foreach ($events as $year => $yearEvents)

        <details {{ $loop->first ? 'open' : '' }} class="mb-4">

            <summary class="mb-2 hover:cursor-pointer hover:text-blue-darkest focus:text-blue-darkest">
                {{ $year }}
            </summary>

            <ul class="list-none ml-0 p-0">

                @foreach ($yearEvents as $event)

                    @comment([
                        'tag' => 'li',
                        'date' => $event->date,
                    ])
                        <p class="md:m-0">{!! $event->description !!}</p>
                    @endcomment

                @endforeach

            </ul>

        </details>

    @endforeach

@endsection
