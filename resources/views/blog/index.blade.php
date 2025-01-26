@extends('layout')

@section('main')
    <h1 class="mb-0">{{ $title }}</h1>

    <div class="max-w-readable">
        @antlers
            {{ content }}
        @endantlers
    </div>

    <a
        class="bg-rss top-8 right-2 mt-2 flex items-center justify-center rounded-sm p-1 text-sm text-white no-underline opacity-75 hover:text-white hover:opacity-100 focus:opacity-100 md:absolute"
        href="{{ route('blog.rss') }}"
        title="Open RSS feed"
        target="_blank"
    >
        <span class="mr-1 text-white">Subscribe with RSS</span>
        <s:partial src="icons/rss" class="inline h-3 fill-current text-white" />
    </a>

    <h2 class="text-blue-darker mt-8 flex items-center justify-start space-x-1">
        <s:partial src="icons/seedling" class="size-5" />
        <span>Most recent</span>
    </h2>

    <s:collection :from="$mount" sort="publication_date:desc" limit="1">
        <x-content-card heading="3" :$title :$url :date="$publication_date">
            {!! $summary !!}
        </x-content-card>
    </s:collection>

    <h2 class="text-blue-darker mt-8 flex items-center justify-start space-x-1">
        <s:partial src="icons/favorite" class="size-5" />
        <span>My favorites</span>
    </h2>

    <s:collection
        :from="$mount"
        sort="publication_date:desc"
        favorite:is="true"
    >
        <x-content-card heading="3" :$title :$url :date="$publication_date">
            {!! $summary !!}
        </x-content-card>
    </s:collection>

    <h2 class="text-blue-darker mt-8 flex items-center justify-start space-x-1">
        <s:partial src="icons/list-bullet" class="size-5" />
        <span>All posts</span>
    </h2>

    <ul class="list-none">
        <s:collection :from="$mount" sort="publication_date:desc">
            <li class="mb-4 flex items-center md:mb-2">
                <time
                    class="bg-blue-lighter text-blue-darker mr-2 shrink-0 self-start rounded-lg px-2 py-1 font-mono text-sm"
                    datetime="{{ $publication_date->toDateTimeString() }}"
                >
                    <span
                        class="ml-1"
                        x-datetime:month-short="{{ $publication_date->getTimestamp() }}"
                    >
                        {{ $publication_date->display('month-short') }}
                    </span>
                </time>
                <span class="items-center md:flex">
                    @if ($favorite->value())
                        <s:partial
                            src="icons/favorite"
                            class="size-5 md:mr-1"
                        />
                    @endif

                    <a
                        href="{{ $url }}"
                        class="no-underline hover:underline focus:underline"
                    >
                        {{ $title }}
                    </a>
                </span>
            </li>
        </s:collection>
    </ul>
@endsection
