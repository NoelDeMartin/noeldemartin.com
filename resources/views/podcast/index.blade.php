@extends('layouts.master')

@section('content')
    <article>
        <div class="flex flex-col relative mb-4">
            <h1 class="mb-0">@lang('podcast.title')</h1>

            <div class="flex flex-row gap-2 mt-2 md:flex-col md:absolute md:top-0 md:right-0">
                <a
                    class="
                        items-center justify-start opacity-75
                        bg-rss text-white p-1 rounded no-underline text-sm flex
                        hover:opacity-100 hover:text-white
                        focus:opacity-100
                    "
                    href="{{ route('podcast.feed') }}"
                    aria-label="Open RSS feed"
                    title="Open RSS feed"
                    target="_blank"
                >
                    @icon('rss', 'inline h-4 text-white fill-current')
                </a>
            </div>
        </div>

        <div class="max-w-readable">
            {!! markdown(trans('podcast.content')) !!}
        </div>
    </article>
@endsection
