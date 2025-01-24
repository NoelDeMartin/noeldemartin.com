<li>
    <a
        href="{{ $link }}"
        aria-label="{{ $title }}"
        {{ str_starts_with($link, '/') ? '' : 'target="_blank"' }}
        class="bg-grey-lightest border-grey-light relative flex h-full transform rounded-lg border p-4 no-underline shadow-md transition-all duration-300 hover:scale-105 hover:shadow-lg focus:scale-105 focus:shadow-lg"
    >
        @if (! empty($image))
            <div
                class="{{ $imageWrapperClasses ?? 'mr-2' }} h-20 w-20 shrink-0"
            >
                @if (str_starts_with($image, '/img/') || str_starts_with($image, 'https://'))
                    <img
                        class="{{ $imageClasses ?? '' }} h-full w-full object-contain"
                        src="{{ $image }}"
                        alt=""
                    />
                @else
                    <s:partial
                        :src="'icons/' . $image"
                        :class="'w-full h-full ' . ($imageClasses ?? '')"
                    />
                @endif
            </div>
        @else
            <div
                class="mr-2 flex h-20 w-20 shrink-0 items-center justify-center"
            >
                <s:partial
                    src="icons/project"
                    class="text-grey-dark h-10 w-10 fill-current"
                />
            </div>
        @endif

        <div>
            <div class="mb-1 flex md:mb-2">
                <h3 class="my-0 mr-2 text-xl font-medium">{{ $title }}</h3>
                @isset($state)
                    <span
                        class="{{ $stateClasses }} hidden self-start rounded-full px-2 py-1 text-xs font-semibold tracking-widest uppercase md:block"
                    >
                        {{ $state->label() }}
                    </span>

                    @if ($state->raw() === 'live')
                        <div
                            aria-label="{{ $state->label() }}"
                            class="absolute top-4 right-4 size-3 md:hidden"
                        >
                            <span
                                class="bg-jade absolute inset-0 rounded-full"
                            ></span>
                            <span
                                class="bg-jade absolute inset-0 animate-ping rounded-full"
                            ></span>
                        </div>
                    @else
                        <span
                            aria-label="{{ $state->label() }}"
                            class="{{ $stateClasses }} absolute top-3 right-3 flex size-7 items-center justify-center rounded-full md:hidden"
                        >
                            <s:partial
                                :src="'icons/state-' . $state->raw()"
                                class="size-4"
                            />
                        </span>
                    @endif
                @endisset
            </div>

            <div class="text-grey-darker text-sm [&_p]:m-0">
                {!! $slot !!}
            </div>

            @if (! empty($platform))
                <span
                    class="absolute right-0 bottom-0 m-1 rounded-full px-2 py-1 text-xs font-medium tracking-widest uppercase opacity-50"
                >
                    {{ $platform }}
                </span>
            @endif
        </div>
    </a>
</li>
