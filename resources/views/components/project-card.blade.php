<li>
    <a
        href="{{ $link }}"
        aria-label="{{ $title }}"
        class="bg-grey-lightest border-grey-light relative flex h-full transform rounded-lg border p-4 no-underline shadow-md transition-all duration-300 hover:scale-105 hover:shadow-lg focus:scale-105 focus:shadow-lg"
    >
        @if (! empty($logo->value()))
            <div class="mr-2 h-20 w-20 flex-shrink-0">
                <s:partial
                    :src="'icons/' . $logo"
                    :class="'w-full h-full ' . $logoClasses"
                />
            </div>
        @else
            <div
                class="mr-2 flex h-20 w-20 flex-shrink-0 items-center justify-center"
            >
                <s:partial
                    src="icons/project"
                    class="text-grey-dark h-10 w-10 fill-current"
                />
            </div>
        @endif

        <div>
            <div class="mb-2 flex">
                <h3 class="my-0 mr-2 text-xl font-medium">{{ $title }}</h3>
                <span
                    class="{{ $stateClasses }} self-start rounded-full px-2 py-1 text-xs font-semibold tracking-widest"
                >
                    {{ $state->label() }}
                </span>
            </div>

            <div class="text-grey-darker text-sm [&_p]:m-0">
                {!! $slot !!}
            </div>

            @if (! empty($platform->value()))
                <span
                    class="absolute right-0 bottom-0 m-1 rounded-full px-2 py-1 text-xs font-medium tracking-widest uppercase opacity-50"
                >
                    {{ $platform }}
                </span>
            @endif
        </div>
    </a>
</li>
