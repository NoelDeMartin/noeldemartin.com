@extends('layout', ['minimal' => true])

@section('main')
    <article class="max-w-readable">
        <h1>{{ $title }}</h1>

        <div class="text-blue-darker flex items-center text-xs font-normal">
            <s:partial src="icons/calendar" class="mr-2 h-4 fill-current" />
            <time
                class="mr-2"
                datetime="{{ $publication_date->toDateTimeString() }}"
            >
                {{ $publication_date->display('date') }}
            </time>

            @if (is_null($completion_date->value()))
                <span>(Ongoing)</span>
            @else
                <span class="mr-2">–</span>
                <time datetime="{{ $completion_date->toDateTimeString() }}">
                    {{ $completion_date->display('date') }}
                </time>
            @endif
        </div>

        @antlers
            {{ content }}
        @endantlers

        <hr class="border-grey mt-2 hidden w-full md:block" />

        <h2 class="mb-6 text-xl">Activity</h2>

        @foreach ($comments as $index => $comment)
            <x-comment
                :id="'comment-' . ($index + 1)"
                :date="$comment->publication_date"
                :short="is_null($comment->task->value())"
            >
                @antlers
                    {{ comment:content }}
                @endantlers
            </x-comment>
        @endforeach

        <x-table-of-contents
            :title="$title"
            :landmarks="$landmarks->value()"
        />
    </article>
@endsection
