@extends('layout')

@section('main')
    @antlers
        <h1>{{ title }}</h1>

        {{ content }}
    @endantlers

    <s:collection from="talks" sort="presentation_date:desc">
        <div
            class="flex border-gray-200 pt-6 md:mb-6 md:border-t [&:first-of-type]:border-0 [&:first-of-type]:pt-0"
        >
            <a
                href="{{ $video_url->value() ?: $slides }}"
                target="_blank"
                class="group relative mr-6 hidden w-80 shrink-0 self-center md:block"
            >
                <div
                    class="absolute inset-0 hidden rounded bg-black/50 group-hover:block"
                >
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white"
                    >
                        @if (empty($video_url->value()))
                            <s:partial
                                src="icons/slides"
                                class="size-16 fill-current"
                            />
                        @else
                            <s:partial
                                src="icons/play"
                                class="size-16 fill-current"
                            />
                        @endif
                    </div>
                </div>
                <img
                    src="/img/talks/{{ $id }}.png"
                    alt=""
                    class="m-0 w-full self-center rounded border border-gray-200"
                />
            </a>
            <div>
                <h2 class="mt-0 mb-1">{{ $title }}</h2>

                <div
                    class="text-blue-darker flex space-x-2 text-xs font-normal"
                >
                    <time
                        class="flex items-center"
                        datetime="{{ $presentation_date->toDateTimeString() }}"
                    >
                        <s:partial
                            src="icons/calendar"
                            class="h-4 fill-current"
                            aria-label="Date"
                        />
                        <span class="ml-1">
                            {{ $presentation_date->toFormattedDateString() }}
                        </span>
                    </time>

                    @if (! empty($conference->value()))
                        <div class="flex items-center">
                            <s:partial
                                src="icons/conference"
                                class="size-4 fill-current"
                                aria-label="Conference"
                            />

                            @if ($conference_url->value())
                                <a
                                    href="{{ $conference_url }}"
                                    target="_blank"
                                    class="text-blue-darker ml-0.5 no-underline hover:underline focus:underline"
                                >
                                    {{ $conference }}
                                </a>
                            @else
                                <span class="ml-0.5">{{ $conference }}</span>
                            @endif
                        </div>
                    @endif

                    <div class="flex items-center">
                        <s:partial
                            src="icons/location"
                            class="size-4 fill-current"
                            aria-label="Location"
                        />
                        <span class="ml-0.5">{{ $location }}</span>
                    </div>
                </div>

                <div
                    class="prose mt-2.5 [&>p:first-of-type]:mt-0 [&>p:last-of-type]:mb-0"
                >
                    @antlers
                        {{ content }}
                    @endantlers
                </div>

                <div class="mt-4 flex space-x-2">
                    @if (! empty($video_url->value()))
                        <a
                            href="{{ $video_url }}"
                            target="_blank"
                            class="flex items-center rounded bg-white px-2 py-1 text-sm text-gray-900 no-underline ring-1 ring-gray-300 ring-inset hover:bg-gray-50"
                        >
                            <s:partial
                                src="icons/video"
                                class="size-5 fill-current"
                            />
                            <span class="ml-1">
                                Video
                                @if (! empty($video_duration->value()))
                                        ({{ $video_duration }})
                                @endif
                            </span>
                        </a>
                    @endif

                    @if (! empty($slides->value()))
                        <a
                            href="{{ $slides }}"
                            target="_blank"
                            class="flex items-center rounded bg-white px-2 py-1 text-sm text-gray-900 no-underline ring-1 ring-gray-300 ring-inset hover:bg-gray-50"
                        >
                            <s:partial
                                src="icons/slides"
                                class="size-5 fill-current"
                            />
                            <span class="ml-1">Slides</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </s:collection>
@endsection
