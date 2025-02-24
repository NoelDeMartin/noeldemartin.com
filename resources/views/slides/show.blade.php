<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        @vite(['resources/assets/js/slides.js'])
        @vite(['resources/assets/css/main.css', 'resources/assets/js/main.js'])
        @semanticSEO
    </head>
    <body
        x-data="slides"
        x-init="initialize('{{ $slides }}')"
        class="flex h-screen w-screen items-center justify-center overflow-hidden bg-black"
    >
        <s:partial
            x-ref="loading"
            src="icons/loading"
            class="size-20 text-white"
        />
        <div
            x-ref="slides-container"
            class="absolute h-(--slides-height) w-(--slides-width)"
            @keydown.right.document="nextSlide()"
            @keydown.left.document="previousSlide()"
        ></div>
        <nav
            class="invisible absolute inset-x-0 bottom-0 z-10 bg-black/75 text-white transition-transform duration-1000"
            :class="!showNav && 'translate-y-full'"
            x-ref="nav"
        >
            <div
                class="portrait-slides:[grid-template:'title_title'_'previous_next'] mx-auto grid max-w-[calc(max(var(--slides-width),75vw))] grid-cols-[auto_1fr_auto] px-2 py-4 [grid-template:'previous_title_next']"
            >
                <div class="flex justify-start" style="grid-area: previous">
                    <button
                        type="button"
                        @click="previousSlide()"
                        class="inline-flex items-start rounded px-3 py-2 text-[clamp(var(--text-xs),1vw+.25rem,var(--text-sm))] font-medium hover:bg-white/25 focus:bg-white/25"
                        :class="currentPage === 1 && 'invisible'"
                        :disabled="currentPage === 1"
                    >
                        <s:partial src="icons/arrow-left" class="size-5" />
                        <span class="ml-1">Previous</span>
                    </button>
                </div>
                <div
                    class="portrait-slides:mb-0 mb-2 flex flex-wrap items-center justify-center"
                    style="grid-area: title"
                >
                    <a href="{{ $slides }}" target="_blank" class="mr-1.5">
                        <s:partial
                            src="icons/download"
                            class="size-4 md:size-6"
                        />
                        <span class="sr-only">Download</span>
                    </a>
                    <h1
                        class="text-center text-[clamp(var(--text-sm),2vw+.5rem,var(--text-xl))]"
                    >
                        {{ $talk->title }}
                        <span x-text="pagination"></span>
                    </h1>
                </div>
                <div class="flex justify-end" style="grid-area: next">
                    <button
                        type="button"
                        @click="nextSlide()"
                        class="inline-flex items-center rounded px-3 py-2 text-[clamp(var(--text-xs),1vw+.25rem,var(--text-sm))] font-medium hover:bg-white/25 focus:bg-white/25"
                        :class="currentPage === totalPages && 'invisible'"
                        :disabled="currentPage === totalPages"
                    >
                        <span class="mr-1">Next</span>
                        <s:partial src="icons/arrow-right" class="size-5" />
                    </button>
                </div>
            </div>
        </nav>
    </body>
</html>
