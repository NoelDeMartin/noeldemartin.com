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
    class="m-0"
>
    <aside
        class="border-grey-light fixed inset-y-0 left-0 z-40 w-screen max-w-full -translate-x-full transform overflow-y-auto border-r bg-white px-6 py-6 shadow-lg transition-transform duration-200 md:w-auto"
        :class="{
            'translate-x-0': isOpen,
            '-translate-x-full': !isOpen,
        }"
    >
        <button
            type="button"
            aria-label="Close"
            class="text-grey-darker hover:text-blue-darkest absolute top-5 right-4 md:hidden"
            @click="close()"
        >
            <s:partial src="icons/close" class="size-4" />
        </button>
        <nav aria-label="Table of contents" class="min-w-0 md:min-w-max">
            <a
                href="#main"
                class="text-blue-darkest mb-2 block text-2xl font-semibold tracking-tight no-underline hover:underline focus:underline md:whitespace-nowrap"
                aria-hidden="true"
                data-turbo="false"
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
        class="group {{ $buttonClass ?? '' }} fixed top-0 right-[calc(max(0px,(100vw-(var(--max-width-content)))/2))] mt-4 mr-4 flex h-12 w-12 items-center justify-center md:mt-16 md:h-8 md:w-8"
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
