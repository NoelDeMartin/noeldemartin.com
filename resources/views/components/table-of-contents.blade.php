<div
    x-data="{
        isOpen: false,
        progress: 0,
        open() {
            this.isOpen = true
        },
        close() {
            this.isOpen = false
        },
        updateProgress(progress) {
            const scrollTop =
                window.pageYOffset ||
                document.documentElement.scrollTop ||
                document.body.scrollTop ||
                0

            this.progress = (
                (100 * scrollTop) /
                (document.body.clientHeight - window.innerHeight)
            ).toFixed(2)
        },
    }"
    x-init="updateProgress()"
    :style="`--progress: ${progress}%`"
    @scroll.document="updateProgress()"
    @keydown.escape.document="close()"
>
    <aside
        class="fixed inset-y-0 left-0 z-40 w-screen -translate-x-full transform overflow-y-auto bg-white px-8 pt-4 shadow-md transition-transform duration-200 md:w-auto"
        :class="{
            'translate-x-0': isOpen,
            '-translate-x-full': !isOpen,
        }"
    >
        <button
            type="button"
            aria-label="Close"
            class="absolute top-0 right-0 mt-5 mr-4 md:hidden"
            @click="close()"
        >
            <s:partial src="icons/close" class="size-4" />
        </button>
        <nav aria-label="Table of contents">
            <a
                href="#main"
                class="text-blue-darkest mb-3 block pr-2 text-lg font-semibold no-underline hover:underline focus:underline md:pr-0"
                aria-hidden="true"
                @click="close()"
            >
                {{ $title }}
            </a>

            <x-table-of-contents-list :$landmarks />
        </nav>
    </aside>

    <div
        x-show="isOpen"
        x-transition.opacity
        class="bg-overlay-dark fixed inset-0 z-10"
        @click="close()"
    ></div>

    <button
        type="button"
        class="group fixed top-0 right-[calc(max(0px,(100vw-(var(--max-width-content)))/2))] mt-4 mr-4 flex h-12 w-12 items-center justify-center md:mt-16 md:h-8 md:w-8"
        @click="open()"
    >
        <div
            class="bg-grey-light absolute inset-0 hidden rounded-full group-hover:block"
        ></div>
        <div
            class="absolute inset-0 rounded-full p-1 md:p-[.125rem]"
            style="
                background-image: conic-gradient(
                    var(--color-blue-darker) var(--progress),
                    transparent 0
                );
            "
        >
            <div
                class="group-hover:bg-grey-light h-full w-full rounded-full bg-white"
            ></div>
        </div>

        <s:partial src="icons/list-bullet" class="relative size-6 md:size-5" />
    </button>
</div>
