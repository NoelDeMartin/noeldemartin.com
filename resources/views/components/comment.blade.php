@php($tag = $tag ?? 'div')
@php($heading = isset($heading) ? 'h' . $heading : 'div')
@php($short = $short ?? false)
@php($inline = $inline ?? false)
@php($day = $day ?? false)

<{{ $tag }}
    class="{{ $inline ? '' : ($short ? 'flex-col md:mb-2 md:flex-row md:items-center' : 'flex-col') }} mb-4 flex items-start"
    {{ $attributes->only('id') }}
>
    <{{ $heading }} class="m-0 flex shrink-0">
        <time
            class="bg-blue-lighter text-blue-darker shrink-0 self-start rounded-lg px-2 py-1 font-mono text-sm"
            datetime="{{ $date->toDateTimeString() }}"
        >
            @if ($day)
                <span x-datetime:day="{{ $date->getTimestamp() }}">
                    {{ $date->display('day') }}
                </span>
            @elseif ($short)
                <span
                    class="block md:hidden"
                    x-datetime:datetime="{{ $date->getTimestamp() }}"
                >
                    {{ $date->display('datetime') }}
                </span>
                <span
                    class="hidden md:block"
                    x-datetime:datetime-short="{{ $date->getTimestamp() }}"
                >
                    {{ $date->display('datetime-short') }}
                </span>
            @else
                <span x-datetime:datetime="{{ $date->getTimestamp() }}">
                    {{ $date->display('datetime') }}
                </span>
            @endif
        </time>
    </{{ $heading }}>

    <div
        class="{{ $short ? '' : 'md:ml-4' }} {{ $inline ? 'overflow-hidden' : '' }} ml-2 [&_pre]:max-w-[calc(100vw-2*(--spacing(4))-(--spacing(2)))]"
    >
        {!! $slot !!}
    </div>
</{{ $tag }}>
