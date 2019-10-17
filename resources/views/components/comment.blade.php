@php($tag = $tag ?? 'div')
@php($short = $short ?? true)
@php($attributes = $attributes ?? [])

<{{ $tag }}
    class="
        mb-4 flex flex-col items-start
        {{ $short ? 'md:mb-2 md:flex-row md:items-center' : '' }}
    "
    @attrs($attributes)
>
    <time
        class="
            flex-shrink-0 self-start text-sm font-mono rounded-lg
            bg-blue-lighter text-blue-darker px-2 py-1
        "
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

    <div class="ml-2 {{ $short ? '' : 'md:ml-4' }}">
        {!! $slot !!}
    </div>
</{{ $tag }}>
