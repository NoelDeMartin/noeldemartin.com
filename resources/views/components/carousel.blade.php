<div class="carousel" data-controller="carousel">

    <ul class="list-none m-0 p-0">
        @foreach ($images as $image)
            <li class="outline-none">
                <button
                    type="button"
                    data-action="click->carousel#show"
                    data-target="carousel.button"
                    data-image="{{ json_encode($image) }}"
                    aria-label="Open {{ $image['description'] }}"
                    class="opacity-75 w-full pt-full hover:opacity-100 focus:opacity-100 bg-cover bg-center"
                    style="background-image: url('{{ $image['url'] }}')"
                >
                </button>
            </li>
        @endforeach
    </ul>

    <aside class="fixed inset-0 z-50 hidden items-center justify-center" data-target="carousel.viewer">
        <div class="flex z-10 items-center justify-center space-x-2 md:space-x-6">
            <button
                class="bg-grey-lighter w-10 h-20 shadow opacity-50 hover:opacity-100 focus:opacity-100"
                type="button"
                aria-label="Move to next image"
                data-action="click->carousel#next"
            >
                @icon('chevron-left', 'w-10 h-10 m-auto')
            </button>

            <img data-target="carousel.viewerImage">

            <button
                class="bg-grey-lighter w-10 h-20 shadow opacity-50 hover:opacity-100 focus:opacity-100"
                type="button"
                aria-label="Move to previous image"
                data-action="click->carousel#previous"
            >
                @icon('chevron-right', 'w-10 h-10 m-auto')
            </button>
        </div>

        <div class="absolute inset-0 bg-black opacity-75 z-0" data-action="click->carousel#hide"></div>
    </aside>

</div>
