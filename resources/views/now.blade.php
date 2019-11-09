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

    <h3>Activity</h3>

    <ul class="list-none ml-0 pl-0">

        @foreach ($events as $event)

            @comment([
                'tag' => 'li',
                'date' => $event->date,
            ])
                <p class="md:m-0">{!! $event->description !!}</p>
            @endcomment

        @endforeach

    </ul>
@endsection
