@extends('layouts.master', ['header' => false])

@section('content')
    <article class="max-w-readable">

        <h1>{{ $task->name }}</h1>

        <div class="flex items-center text-blue-darker font-normal text-xs">
            @icon('calendar', 'h-4 mr-2 fill-current')
            <time
                class="mr-2"
                datetime="{{ $task->created_at->toDateTimeString() }}"
            >
                {{ $task->created_at->display('date') }}
            </time>
            @if ($task->isOngoing())
                <span>(Ongoing)</span>
            @else
                <span class="mr-2">–</span>
                <time datetime="{{ $task->completed_at->toDateTimeString() }}">
                    {{ $task->completed_at->display('date') }}
                </time>
            @endif
        </div>

        {!! $task->description_html !!}

        <hr class="w-full mt-2 bg-grey-lighter hidden md:block">

        <h2 class="text-xl mb-6">Activity</h2>

        @taskcomment([
            'id' => 1,
            'date' => $task->created_at,
        ])
            <p>Started working on it.</p>
        @endtaskcomment

        @foreach ($task->comments as $i => $comment)

            @taskcomment([
                'id' => $loop->index + 2,
                'date' => $comment->created_at,
            ])
                {!! $comment->text_html !!}
            @endtaskcomment

        @endforeach

        @if ($task->isCompleted())

            @taskcomment([
                'id' => $task->comments->count() + 2,
                'date' => $task->completed_at,
            ])
                <p>Task completed 🎉</p>
            @endtaskcomment

        @endif

    </article>
@endsection
