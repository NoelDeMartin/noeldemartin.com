@php($heading = isset($heading) ? 'h' . $heading : 'h2')

<article class="mb-4 md:mb-8">
    <div
        class="title max-w-readable flex flex-col md:flex-row md:justify-between"
    >
        <{{ $heading }} class="text-blue-darkest my-0 font-bold">
            @isset($url)
                <a
                    href="{{ $url }}"
                    class="hover:text-blue-darkest visited:text-blue-darkest no-underline hover:underline focus:underline"
                >
                    {{ $title }}
                </a>
            @else
                {{ $title }}
            @endisset
        </{{ $heading }}>

        @isset($date)
            <time
                class="text-blue-darker my-2 flex shrink-0 items-center text-xs font-normal md:my-0 md:h-[28px]"
                datetime="{{ $date->toDateTimeString() }}"
            >
                <s:partial src="icons/calendar" class="h-4 fill-current" />
                <span class="ml-1">{{ $date->toFormattedDateString() }}</span>
            </time>
        @endisset
    </div>

    <div class="max-w-readable [&>p]:my-3">
        {!! $slot !!}

        @isset($links)
            <span class="flex gap-1">
                @foreach ($links as $linkText => $linkUrl)
                    <a
                        href="{{ $linkUrl }}"
                        target="_blank"
                        class="bg-blue hover:bg-blue-darker rounded-sm px-2 py-1 text-sm text-white no-underline visited:text-white hover:text-white"
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
