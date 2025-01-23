@extends('layout')

@section('main')
    <h1 class="sr-only">Blog</h1>

    <a
        class="bg-rss float-right hidden items-center justify-center rounded-sm p-1 text-sm text-white no-underline opacity-75 hover:text-white hover:opacity-100 focus:opacity-100 md:flex"
        href="{{ route('blog.rss') }}"
        title="Open RSS feed"
        target="_blank"
    >
        <s:partial src="icons/rss" class="inline h-4 fill-current text-white" />
    </a>

    <s:collection :from="$mount" sort="publication_date:desc">
        <x-content-card :$title :$url :date="$publication_date">
            {!! $summary !!}
        </x-content-card>
    </s:collection>

    <div class="flex justify-end">
        <a
            class="bg-rss flex items-center rounded-sm p-2 text-white no-underline opacity-75 hover:opacity-100 md:hidden"
            href="{{ route('blog.rss') }}"
            title="Open RSS feed"
            target="_blank"
        >
            <span class="mr-1 text-white">Subscribe</span>
            <s:partial
                src="icons/rss"
                class="inline h-3 fill-current text-white"
            />
        </a>
    </div>
@endsection
