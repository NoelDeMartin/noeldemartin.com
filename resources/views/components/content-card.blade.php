<article class="content-card mb-4 md:mb-8">

    <div class="title flex flex-col max-w-readable md:flex-row md:justify-between">

        <h2 class="my-0 font-bold text-blue-darkest">
            @isset($url)
                <a
                    href="{{ $url }}"
                    class="no-underline hover:text-blue-darkest hover:underline visited:text-blue-darkest focus:underline"
                >
                    {{ $title }}
                </a>
            @else
                {{ $title }}
            @endisset
        </h2>

        @isset($date)
            <time
                class="
                    flex flex-shrink-0 items-center text-blue-darker font-normal text-xs my-2
                    md:my-0
                "
                datetime="{{ $date->toDateTimeString() }}"
            >
                @icon('calendar', 'h-4 fill-current')
                <span class="ml-1">{{ $date->toFormattedDateString() }}</span>
            </time>
        @endisset

    </div>

    <div class="max-w-readable">
        {!! $slot !!}

        @isset($links)
            <span class="flex gap-1">
                @foreach ($links as $linkText => $linkUrl)
                    <a
                        href="{{ $linkUrl }}"
                        target="_blank"
                        class="
                            bg-blue text-white px-2 py-1 rounded no-underline text-sm
                            hover:bg-blue-darker hover:text-white
                            visited:text-white
                        "
                    >
                        {{ $linkText }}
                    </a>
                @endforeach
            </span>
        @endisset

        @isset($url)
            <a href="{{ $url }}" aria-hidden="true">Read more</a>
        @endisset
    </div>

</article>
