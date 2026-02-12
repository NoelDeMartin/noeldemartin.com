@extends('layout', ['minimal' => true])

@push('head')
    @vite(['resources/assets/css/code.css', 'resources/assets/js/code.js'])
@endpush

@section('main')
    <article>
        <div class="max-w-readable">
            <h1>{{ $title }}</h1>

            <div class="mb-4 flex">
                <time
                    class="text-blue-darker flex items-center text-xs font-normal"
                    datetime="{{ $publication_date->toDateTimeString() }}"
                >
                    <s:partial src="icons/calendar" class="h-4 fill-current" />
                    <span class="ml-1">
                        {{ $publication_date->toFormattedDateString() }}
                    </span>
                </time>

                <time
                    class="text-blue-darker ml-2 flex items-center text-xs font-normal"
                    datetime="{{ $duration }}M"
                >
                    <s:partial src="icons/timer" class="h-4 fill-current" />
                    <span class="ml-1">{{ $duration }} min.</span>
                </time>
            </div>

            @antlers
                {{ content | wrap_emoji }}
            @endantlers

            <x-table-of-contents
                :title="$title"
                :landmarks="$landmarks->value()"
            />
        </div>
    </article>

    <hr class="border-grey mt-12 w-full" />

    <!-- prettier-ignore -->
    <p class="mt-1.5 text-sm opacity-75">
        Found any typos? You can fix them
        <a
            href="{{ 'https://github.com/NoelDeMartin/noeldemartin.com/tree/main/content/collections/posts/' . $slug->value() . '.md' }}"
            target="_blank"
        >on github</a>!
    </p>
@endsection
