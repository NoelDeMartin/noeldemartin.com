@extends('layout')

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

        <s:collection
            from="comments"
            sort="publication_date:asc"
            :task:is="'entry::' . $id"
            as="comments"
        >
            <x-comment id="comment-1" :date="$publication_date" :short="true">
                <p class="flex items-center md:m-0">
                    Task started
                    <s:partial src="icons/task-started" class="ml-2 size-4" />
                </p>
            </x-comment>

            @foreach ($comments as $index => $comment)
                <x-comment
                    :id="'comment-' . ($index + 2)"
                    :date="$comment->publication_date"
                >
                    @antlers
                        {{ comment:content }}
                    @endantlers
                </x-comment>
            @endforeach

            @if (! is_null($completion_date->value()))
                <x-comment
                    :id="'comment-' . ($comments->count() + 2)"
                    :date="$publication_date"
                    :short="true"
                >
                    <p class="flex items-center md:m-0">
                        Task completed
                        <s:partial
                            src="icons/task-completed"
                            class="ml-2 size-4"
                        />
                    </p>
                </x-comment>
            @endif
        </s:collection>
    </article>
@endsection
