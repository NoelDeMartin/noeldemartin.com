@extends('layout')

@section('main')
    <article>
        <h1>All Tasks</h1>

        <ul class="ml-0 list-none pl-0">
            <s:collection
                from="tasks"
                sort="completion_date:desc|publication_date:desc"
            >
                <li
                    class="mb-4 flex flex-col items-start md:flex-row md:items-center"
                >
                    <div
                        class="flex shrink-0 flex-row-reverse items-center md:flex-row"
                    >
                        <time
                            class="{{
                                $completion_date->value()
                                    ? 'bg-jade-lighter text-jade-darker'
                                    : 'bg-blue-lighter text-blue-darker'
                            }} mr-2 rounded-lg px-2 py-1 font-mono text-sm"
                        >
                            <span
                                class="block md:hidden"
                                x-datetime:month="{{ ($completion_date->value() ?? $publication_date->value())->getTimestamp() }}"
                            >
                                {{ ($completion_date->value() ?? $publication_date->value())->display('month') }}
                            </span>
                            <span
                                class="hidden md:block"
                                x-datetime:month-short="{{ ($completion_date->value() ?? $publication_date->value())->getTimestamp() }}"
                            >
                                {{ ($completion_date->value() ?? $publication_date->value())->display('month-short') }}
                            </span>
                        </time>

                        <s:partial
                            :src="$completion_date->value() ? 'icons/checkmark' : 'icons/timer'"
                            :class="($completion_date->value() ? 'text-jade' : 'text-blue') . ' mr-2 inline h-4 w-4 fill-current'"
                            :title=" $completion_date->value() ? 'Completed' : 'Ongoing'"
                        />
                    </div>

                    <a class="mt-2 ml-2 text-lg md:m-0" href="{{ $url }}">
                        {{ $title }}
                    </a>
                </li>
            </s:collection>
        </ul>
    </article>
@endsection
