@php($tag = $tag ?? 'div')
@php($short = $short ?? false)

<{{ $tag }}
    class="{{ $short ? 'md:mb-2 md:flex-row md:items-center' : '' }} mb-4 flex flex-col items-start"
    {{ $attributes->only('id') }}
>
    <time
        class="bg-blue-lighter text-blue-darker flex-shrink-0 self-start rounded-lg px-2 py-1 font-mono text-sm"
        datetime="{{ $date->toDateTimeString() }}"
    >
        @if ($short)
            <span class="block md:hidden">
                {{ $date->display('datetime') }}
            </span>
            <span class="hidden md:block">
                {{ $date->display('datetime-short') }}
            </span>
        @else
            {{ $date->display('datetime') }}
        @endif
    </time>

    <div
        class="{{ $short ? '' : 'md:ml-4' }} ml-2 [&_pre]:max-w-[calc(100vw-2*theme('spacing.4')-theme('spacing.2'))]"
    >
        {!! $slot !!}
    </div>
</{{ $tag }}>
