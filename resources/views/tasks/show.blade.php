@extends('layouts.master')

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

        @comment([
            'date' => $task->created_at,
            'short' => false,
            'attributes' => [
                'id' => 'comment-1',
            ],
        ])
            <p>Started working on it.</p>
        @endcomment

        @foreach ($task->comments as $i => $comment)

            @comment([
                'date' => $comment->created_at,
                'short' => false,
                'attributes' => [
                    'id' => 'comment-' . ($loop->index + 2),
                ],
            ])
                {!! $comment->text_html !!}
            @endcomment

        @endforeach

        @if ($task->isCompleted())

            @comment([
                'date' => $task->completed_at,
                'short' => false,
                'attributes' => [
                    'id' => 'comment-' . $task->comments->count() + 2,
                ],
            ])
                <p>Task completed 🎉</p>
            @endcomment

        @endif

    </article>
@endsection
