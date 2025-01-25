<footer class="bg-grey-light p-4 print:hidden">
    <div
        class="max-w-content mx-auto flex flex-col items-center text-sm md:flex-row"
    >
        <div class="flex items-center">
            Built with
            <span class="mr-2 flex items-center" title="Time, Brains & Passion">
                <s:partial src="icons/time" class="ml-1 size-4" />
                <s:partial src="icons/brains" class="ml-1 size-4" />
                <s:partial src="icons/passion" class="ml-1 size-4" />
            </span>
            by Noel De Martin
        </div>
        <div class="grow"></div>
        <a
            href="{{ sroute('site') }}"
            class="hover:text-blue-darkest mt-4 underline md:mt-0"
            data-turbo-frame="mainframe"
        >
            about this site
        </a>
    </div>
</footer>
