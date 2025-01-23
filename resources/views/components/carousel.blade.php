<div
    x-data="{
        activeImage: null,
        images: {{ json_encode($images) }},
        show(index) {
            this.activeImage = index
        },
        hide() {
            this.activeImage = null
        },
        next() {
            this.__move(1)
        },
        previous() {
            this.__move(-1)
        },
        __move(delta) {
            if (this.activeImage === null) {
                return
            }

            this.activeImage =
                (this.images.length + this.activeImage + delta) % this.images.length
        },
    }"
    @keydown.right.document="next()"
    @keydown.left.document="previous()"
    @keydown.escape.document="hide()"
>
    <ul
        class="m-0 grid list-none grid-cols-[repeat(auto-fill,minmax(--spacing(24),1fr))] gap-2 p-0"
    >
        @foreach ($images as $index => $image)
            <li class="outline-hidden">
                <button
                    type="button"
                    aria-label="Open {{ $image['description'] }}"
                    class="aspect-square w-full bg-cover bg-center opacity-75 hover:opacity-100 focus:opacity-100"
                    style="background-image: url('{{ $image['url'] }}')"
                    @click="show({{ $index }})"
                ></button>
            </li>
        @endforeach
    </ul>

    <aside
        class="fixed inset-0 z-50 items-center justify-center"
        :class="activeImage === null ? 'hidden' : 'flex'"
    >
        <div
            class="z-10 flex items-center justify-center space-x-2 md:space-x-6"
        >
            <button
                class="bg-grey-lighter h-20 w-10 opacity-50 shadow-sm hover:opacity-100 focus:opacity-100"
                type="button"
                aria-label="Move to next image"
                @click="next()"
            >
                <s:partial src="icons/chevron-left" class="m-auto size-10" />
            </button>

            <img
                class="max-h-[90vh] max-w-[calc(100%-2*(--spacing(10))-4*(--spacing(2)))]"
                :src="images[activeImage]?.url"
                :alt="images[activeImage]?.alt"
                :title="images[activeImage]?.description"
            />

            <button
                class="bg-grey-lighter h-20 w-10 opacity-50 shadow-sm hover:opacity-100 focus:opacity-100"
                type="button"
                aria-label="Move to previous image"
                @click="previous()"
            >
                <s:partial src="icons/chevron-right" class="m-auto size-10" />
            </button>
        </div>

        <div
            class="absolute inset-0 z-0 bg-black opacity-75"
            @click="hide()"
        ></div>
    </aside>
</div>
