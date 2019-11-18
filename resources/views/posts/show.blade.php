@inject('links', 'App\Social\LinksGenerator')

@extends('layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ mix('css/code-highlighter.css') }}">
@endpush

@section('content')
    <article class="max-w-readable" data-controller="code-highlighter">

        <h1>{{ $post->title }}</h1>

        <div class="flex mb-4">

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

        {!! $post->text_html !!}

    </article>

    <div class="my-8 text-left md:text-right">
        <a href="{{ route('blog') }}">
            Read more posts →
        </a>
    </div>
@endsection
