@extends('layouts.master')

@section('content')
    <h1 class="hidden">Blog</h1>

    <a
        class="
            items-center justify-center float-right opacity-75
            bg-rss text-white p-1 rounded no-underline text-sm hidden
            md:flex hover:opacity-100 hover:text-white
        "
        href="{{ route('blog.rss') }}"
        title="Open RSS feed"
        target="_blank"
    >
        @icon('rss', 'inline h-4 text-white fill-current')
    </a>

    @foreach ($posts as $post)
        @contentcard([
            'url' => $post->url,
            'title' => $post->title,
        ])
            {!! $post->summary_html !!}
        @endcontentcard
    @endforeach

    <div class="flex justify-end">
        <a
            class="
                flex items-center bg-rss p-2 rounded text-white no-underline opacity-75
                hover:opacity-100
                md:hidden
            "
            href="{{ route('blog.rss') }}"
            title="Open RSS feed"
            target="_blank"
        >
            <span class="mr-1 text-white">Subscribe</span>
            @icon('rss', 'inline h-3 text-white fill-current')
        </a>
    </div>

@stop
