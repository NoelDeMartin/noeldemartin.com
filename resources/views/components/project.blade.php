<li>
    <a
        href="{{ $url }}"
        aria-label="{{ $title }}"
        target="_blank"
        class="
            relative flex h-full p-4 rounded-lg shadow-md bg-grey-lightest border border-grey-light no-underline
            transform transition-all duration-300 hover:scale-105 hover:shadow-lg
        "
    >
        @if(isset($icon) || isset($image))
            <div class="flex-shrink-0 w-20 h-20 mr-2">
                @isset($icon)
                    @icon($icon, 'w-full h-full ' . ($iconClasses ?? ''))
                @endisset
                @isset($image)
                    <img class="w-full h-full object-contain {{ $imageClasses ?? '' }}" src="{{ $image }}" alt="{{ $title }}">
                @endisset
            </div>
        @else
            <div class="flex items-center justify-center flex-shrink-0 w-20 h-20 mr-2">
                @icon('projects', 'w-10 h-10 fill-current text-grey-dark')
            </div>
        @endif

        <div>
            <div class="flex mb-2">
                <h3 class="font-medium text-xl mr-2 my-0">{{ $title }}</h3>
                @isset($status)
                    <span
                        class="
                            px-2 py-1 rounded-full font-semibold tracking-widest text-xs self-start
                            {{
                                ($statusColor ?? 'green') === 'green'
                                    ? 'bg-jade-lighter text-jade-darker'
                                    : (
                                        $statusColor === 'yellow'
                                            ? 'bg-yellow-lighter text-yellow-darker'
                                            : 'bg-blue-lighter text-blue-darker'
                                    )
                            }}
                        "
                    >
                        {{ $status }}
                    </span>
                @endisset
            </div>

            <p class="m-0 text-sm text-grey-darker">
                {!! $slot !!}
            </p>

            @isset($platform)
                <span
                    class="
                        absolute px-2 py-1 m-1 bottom-0 right-0 rounded-full
                        uppercase font-medium tracking-widest text-xs opacity-50
                    "
                >
                    {{ $platform }}
                </span>
            @endisset
        </div>
    </a>
</li>
