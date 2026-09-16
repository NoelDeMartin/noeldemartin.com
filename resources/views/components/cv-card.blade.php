<article
    class="space-y-3"
    aria-labelledby="{{ $anchorPrefix }}-{{ Str::slug($name) }}"
>
    <div
        class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between"
    >
        <div class="mt-2 flex items-start gap-2 sm:mt-0">
            <img
                src="{{ $image }}"
                alt=""
                class="m-0 size-14 shrink-0 object-contain"
            />

            <div class="flex flex-col self-center">
                <h3
                    class="text-blue-darkest m-0 scroll-mt-8 text-base leading-snug font-semibold sm:text-lg"
                    id="{{ $anchorPrefix }}-{{ Str::slug($name) }}"
                >
                    {{ $position }}
                </h3>

                <div class="flex gap-1">
                    <a
                        href="{{ $url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-blue-darkest text-sm underline"
                    >
                        {{ $name }}
                    </a>

                    @if (isset($note) && ! empty($note))
                        <span class="text-sm">({{ $note }})</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="text-grey-darker shrink-0 text-sm sm:text-right">
            @if (isset($period) && ! empty($period))
                <div class="sm:text-blue-darker font-medium sm:font-normal">
                    {{ $period }}
                </div>
            @endif

            @if (isset($location) && ! empty($location))
                <div
                    class="text-grey-darker mt-1 flex items-center gap-0.5 sm:justify-end"
                >
                    <s:partial
                        src="icons/location"
                        class="inline size-3.5 fill-current"
                    />
                    <span>{{ $location }}</span>
                </div>
            @endif
        </div>
    </div>

    <div class="prose">
        @if (isset($summary) && ! empty($summary))
            <p class="text-black-light text-sm leading-relaxed">
                {!! inline_markdown($summary) !!}
            </p>
        @endif

        @if (isset($highlights) && ! empty($highlights))
            <ul
                class="text-black-light marker:text-grey-dark [&_a]:text-blue-darkest ml-0 list-outside list-disc space-y-1.5 text-sm [&_a]:underline"
            >
                @foreach ($highlights as $highlight)
                    <li class="leading-relaxed">
                        {!! inline_markdown($highlight) !!}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    @if (isset($technologies) && ! empty($technologies))
        <p class="text-black-light mt-2 text-sm leading-normal">
            <span class="text-blue-darkest font-semibold">Technologies:</span>
            {{ implode(', ', $technologies) }}
        </p>
    @endif
</article>
