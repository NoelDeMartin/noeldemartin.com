<div
    class="expandable-item"
    data-controller="expandable-item"
    data-expandable-item-animation-duration="300"
>

    <h2
        class="my-0 p-3 flex items-center justify-between cursor-pointer hover:bg-overlay"
        data-action="click->expandable-item#toggle"
    >
        <div class="flex flex-grow">
            <span class="text-2xl font-medium">
                {{ $name }}
            </span>
            <time class="ml-2">
                @icon('calendar', 'h-4 fill-current')
                <span class="ml-2">{{ $date }}</span>
            </time>
        </div>
        @icon('arrow-right', 'arrow h-4 fill-current')
    </h2>

    <div class="overflow-hidden" style="height:0" data-target="expandable-item.content">
        <div class="px-4 pt-2">
            <div class="flex items-center justify-end">
                Find it here:
                @if(isset($extras))
                    @foreach($extras as $extra)
                        <a
                            href="{{ $extra->url }}"
                            target="_blank"
                            title="{{ $name }} on {{ $extra->name }}"
                            class="flex items-center text-blue-darkest ml-2 hover:text-blue"
                        >
                            @icon($extra->icon, 'h-8 fill-current')
                        </a>
                    @endforeach
                @endif
                <a
                    href="{{ $url }}"
                    target="_blank"
                    title="{{ $name }}"
                    class="flex items-center text-blue-darkest ml-2 hover:text-blue"
                >
                    @icon('link-round', 'h-8 fill-current')
                </a>
            </div>
            {{ $slot }}
        </div>
    </div>

</div>