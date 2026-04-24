@if (! request()->hasCookie('hire_me_dismissed'))
    <aside
        id="hire-me"
        class="max-w-content mx-auto h-auto w-full overflow-hidden px-4 transition-all duration-300 data-[collapsed=true]:h-0 md:px-2"
        style="interpolate-size: allow-keywords"
        data-collapsed="{{ json_encode($collapsed) }}"
    >
        <div class="h-4"></div>
        <div
            class="text-blue-darkest border-blue-lighter/50 bg-blue-lightest flex items-center justify-between gap-3 rounded border-1 px-4 py-3"
        >
            <!-- prettier-ignore -->
            <span>
            <strong>Hire me:</strong>
                I'm available for work. If you're hiring or want to work with me,
                <a href="mailto:{{ sglobal('contact.email') }}?subject=Work+with+me" class="underline">let me know</a>!
            </span>

            <button
                type="button"
                class="text-blue-darkest flex size-6 items-center justify-center rounded-full hover:bg-black/20"
                title="Dismiss"
            >
                <s:partial src="icons/close" class="size-3" />
                <span class="sr-only">Dismiss</span>
            </button>
        </div>
    </aside>
@endif
