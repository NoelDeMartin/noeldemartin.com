@extends('layouts.master')

@section('content')

    <h1 class="hidden">Blog</h1>

    @foreach ($posts as $post)

        <a href="{{ route('posts.show', $post->tag) }}" title="Read &quot;{{ $post->title }}&quot;">
            <article class="summary p-2 rounded hover:bg-overlay">

                <h2>{{ $post->title }}</h2>

                {!! $post->summary_html !!}

                <div class="flex justify-end mt-2">

                    <time
                        class="flex items-center text-blue-darker font-normal text-xs"
                        datetime="{{ $post->published_at->toDateTimeString() }}"
                    >
                        @icon('calendar', 'h-4 fill-current')
                        <span class="ml-1">{{ $post->published_at->toFormattedDateString() }}</span>
                    </time>

                    <time
                        class="flex items-center text-blue-darker font-normal text-xs ml-2"
                        datetime="{{ $post->duration }}M"
                    >
                        @icon('timer', 'h-4 fill-current')
                        <span class="ml-1">{{ $post->duration }} min.</span>
                    </time>

                </div>

            </article>
        </a>

        <hr class="my-2 h-px bg-grey-lightest">

    @endforeach

    <div class="alert mt-4">
        <p>
            @icon('rss', 'h-4 fill-current') You can add <a href="{!! route('blog.rss') !!}">this</a> to your rss feed to keep up to date.
        </p>
    </div>

@stop
