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
       @icon('rss', 'inline h-4 fill-current')
    </a>

    @foreach ($posts as $post)
        @contentcard([
            'url' => $post->url,
            'title' => $post->title,
        ])
            {!! $post->summary_html !!}
        @endcontentcard
    @endforeach

    <div class="alert mt-4">
        <p>
            @icon('rss', 'inline h-4 fill-current') You can add
            <a href="{{ route('blog.rss') }}">this</a> to your rss feed to keep up to date.
        </p>
    </div>

@stop
