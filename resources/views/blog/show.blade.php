@extends('layout')

{{--
    TODO minimal => true
    TODO code highlighter
    TODO landmarks / navigation
--}}

@section('main')
    <article>
        <div class="max-w-readable overflow-hidden">
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
                {{ content }}
            @endantlers
        </div>
    </article>

    <div class="my-8 text-left md:text-right">
        <a href="/blog">Read more posts →</a>
    </div>
@endsection
