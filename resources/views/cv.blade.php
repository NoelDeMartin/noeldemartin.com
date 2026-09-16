@extends('layout', ['bare' => true])

@section('main')
    <article
        class="text-black-light isolate mx-auto max-w-[80ch] space-y-10 sm:py-6"
    >
        <header
            class="relative z-10 m-0 flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between sm:bg-white"
        >
            <div class="flex flex-1 flex-col justify-center">
                <h1
                    class="text-blue-darkest m-0 text-3xl font-medium tracking-tight sm:text-4xl"
                >
                    {{ $basics['name'] }}
                </h1>
                <p class="text-blue-darker m-0 text-lg">
                    {{ $basics['label'] }}
                </p>
            </div>

            <div
                class="text-blue-darkest grid w-fit grid-cols-[auto_auto] gap-x-1.5 gap-y-1.5 sm:mr-0 sm:ml-auto sm:text-sm"
            >
                <div class="col-span-2 grid grid-cols-subgrid items-center">
                    <span class="sr-only">Location:</span>
                    <s:partial
                        src="icons/location"
                        class="inline size-5 fill-current"
                    />
                    <span>
                        {{ $basics['location']['city'] . ', ' . $basics['location']['country'] }}
                    </span>
                </div>

                <div class="col-span-2 grid grid-cols-subgrid items-center">
                    <span class="sr-only">Website:</span>
                    <s:partial
                        src="icons/link"
                        class="inline size-5 fill-current"
                    />
                    <a
                        href="{{ $basics['url'] }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-blue-darkest underline"
                    >
                        {{ preg_replace('#^https?://#', '', rtrim($basics['url'], '/')) }}
                    </a>
                </div>

                <div
                    class="col-span-2 grid grid-cols-subgrid items-center pt-1"
                >
                    <s:partial
                        src="icons/download"
                        class="inline size-5 fill-current"
                    />
                    <a
                        href="{{ route('cv.pdf') }}"
                        target="_blank"
                        class="text-blue-darkest underline"
                    >
                        Download PDF
                    </a>
                </div>
            </div>
        </header>

        <x-table-of-contents
            title="Noel De Martin"
            button-class="z-20 sm:z-0 mt-10! sm:mt-16! sm:mr-22!"
            :landmarks="$landmarks"
        />

        <p class="text-grey-darker mt-4 mb-0">
            {!! inline_markdown($basics['summary']) !!}
        </p>

        <section aria-labelledby="work-history" class="mt-4 max-w-[70ch]">
            <x-cv-heading id="work-history" class="mb-0">
                Work History
            </x-cv-heading>

            <p
                class="text-grey-darker [&_a]:text-blue-darkest mt-1 text-sm italic [&_a]:underline"
            >
                {!! inline_markdown($cv['workIntro']) !!}
            </p>

            <div class="space-y-8">
                @foreach ($work as $job)
                    <x-cv-card
                        anchor-prefix="work"
                        :name="$job['name']"
                        :note="$job['note'] ?? ''"
                        :position="$job['position']"
                        :image="$job['image']"
                        :url="$job['url']"
                        :period="$job['dateDisplay'] ?? $job['period']"
                        :location="$job['location']"
                        :summary="$job['summary'] ?? ''"
                        :highlights="$job['highlights'] ?? []"
                        :technologies="$job['technologies']"
                    />
                @endforeach
            </div>
        </section>

        <section aria-labelledby="side-projects" class="mt-8 max-w-prose">
            <x-cv-heading id="side-projects">
                Side Projects & Open Source
            </x-cv-heading>

            <x-cv-card
                anchor-prefix="side-projects"
                :name="preg_replace('#^https?://#', '', rtrim($sideProjects['url'], '/'))"
                :position="$sideProjects['name']"
                :image="$sideProjects['image']"
                :url="$sideProjects['url']"
                :summary="$sideProjects['description']"
                :highlights="$sideProjects['highlights']"
                :technologies="$sideProjects['technologies']"
            />
        </section>

        <section aria-labelledby="education" class="mt-8 max-w-prose">
            <x-cv-heading id="education">Education</x-cv-heading>

            <div class="mt-4 space-y-8">
                @foreach ($education as $edu)
                    <x-cv-card
                        anchor-prefix="education"
                        :name="$edu['institution']"
                        :position="$edu['studyType']"
                        :image="$edu['image']"
                        :url="$edu['url']"
                        :period="$edu['dateDisplay'] ?? $edu['period']"
                        :location="$edu['location'] ?? ''"
                        :summary="$edu['summary'] ?? ''"
                        :highlights="$edu['highlights'] ?? []"
                    />
                @endforeach
            </div>
        </section>
    </article>
@endsection
