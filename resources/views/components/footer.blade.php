<footer class="p-4 bg-grey-light">
    <div class="flex flex-col max-w-content mx-auto text-sm items-center md:flex-row">
        <div class="flex items-center">
            Build with
            <span class="flex items-center mr-2" title="Time, Brains & Passion">
                @icon('time', 'w-4 h-4 ml-1')
                @icon('brains', 'w-4 h-4 ml-1')
                @icon('passion', 'w-4 h-4 ml-1')
            </span>
            by Noel De Martin
        </div>
        <div class="flex-grow"></div>
        <a href="{{ route('site') }}" class="underline mt-4 md:mt-0 hover:text-blue-darkest">
            about this site
        </a>
    </div>
</footer>