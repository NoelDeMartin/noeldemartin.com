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

    <h2>My favorites</h2>

    <s:collection
        :from="$mount"
        sort="publication_date:desc"
        favorite:is="true"
    >
        <x-content-card heading="3" :$title :$url :date="$publication_date">
            {!! $summary !!}
        </x-content-card>
    </s:collection>

    <h2>All posts</h2>

    <ul class="list-none">
        <s:collection :from="$mount" sort="publication_date:desc">
            <li class="mb-2 flex">
                <time
                    class="bg-blue-lighter text-blue-darker mr-2 rounded-lg px-2 py-1 font-mono text-sm"
                    datetime="{{ $publication_date->toDateTimeString() }}"
                >
                    <span
                        class="ml-1"
                        x-datetime:month-short="{{ $publication_date->getTimestamp() }}"
                    >
                        {{ $publication_date->display('month-short') }}
                    </span>
                </time>
                @if ($favorite->value())
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="32"
                        height="32"
                        viewBox="0 0 20 20"
                        class="mr-1 size-5"
                    >
                        <path
                            fill="#888888"
                            d="m10 15l-5.878 3.09l1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955l6.572.955l-4.756 4.635l1.123 6.545z"
                        />
                    </svg>
                @endif

                <a
                    href="{{ $url }}"
                    class="no-underline hover:underline focus:underline"
                >
                    {{ $title }}
                </a>
            </li>
        </s:collection>
    </ul>
@endsection
