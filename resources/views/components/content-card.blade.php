<article class="content-card mb-4 md:mb-8">

    <div class="title flex flex-col max-w-readable md:flex-row md:justify-between">

        <h2 class="my-0">
            <a
                href="{{ $url }}"
                class="
                    font-bold text-blue-darkest no-underline
                    hover:text-blue-darkest hover:underline
                    visited:text-blue-darkest
                    focus:underline
                "
            >
                {{ $title }}
            </a>
        </h2>

        @if (isset($date))
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
        @endif

    </div>

    <div class="max-w-readable">
        {!! $slot !!}

        <a href="{{ $url }}" aria-hidden="true">Read more</a>
    </div>

</article>
