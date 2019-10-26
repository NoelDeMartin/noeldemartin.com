@inject('links', 'App\Social\LinksGenerator')

@extends('layouts.master')

@section('content')
    <article class="max-w-readable">

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
@endsection
