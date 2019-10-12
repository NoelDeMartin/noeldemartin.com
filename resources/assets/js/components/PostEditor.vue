<template>
    <div>

        <ul class="flex justify-end">
            <li
                v-for="_mode in ['both', 'editor', 'preview']"
                :key="_mode"
            >
                <a
                    :class="{ 'bg-grey-lighter': mode === _mode }"
                    class="block p-2 mb-2 underline cursor-pointer hover:bg-overlay"
                    @click="mode = _mode"
                >
                    {{ capitalize(_mode) }}
                </a>
            </li>
        </ul>

        <input
            v-model="title"
            name="title"
            placeholder="My Awesome Blog Post"
            class="block appearance-none border rounded mb-4 py-2 px-3 text-grey-darker w-full focus:shadow"
        >

        <div class="w-full flex border border-grey-light">

            <textarea
                :class="{ 'hidden': mode === 'preview' }"
                v-model="text"
                name="text_markdown"
                class="flex-1 p-6 min-h-editor bg-grey-lighter"
            />

            <div
                v-if="mode !== 'editor'"
                class="flex-1 px-6 min-h-editor"
                v-html="html"
            />
            <input
                :value="html"
                type="hidden"
                name="text_html"
            >

        </div>

        <div class="flex justify-between items-center mt-4">

            <datetime
                v-model="date"
                type="datetime"
                placeholder="Publication date"
                input-class="appearance-none border rounded mb-4 py-2 px-3 text-grey-darker focus:shadow"
            />
            <input
                :value="date"
                type="hidden"
                name="published_at"
            >

            <button
                type="submit"
                class="bg-blue-dark hover:bg-blue-darker text-white font-bold py-2 px-4 rounded"
            >
                Publish
            </button>

        </div>

    </div>
</template>

<script>
import 'vue-datetime/dist/vue-datetime.css';

import marked from 'marked';
import { Datetime } from 'vue-datetime';

export default {
    components: {
        Datetime,
    },
    props: {
        oldTitle: {
            type: String,
            default: '',
        },
        oldText: {
            type: String,
            default: '',
        },
        oldDate: {
            type: String,
            default: null,
        },
    },
    data() {
        return {
            mode: 'both',
            title: this.oldTitle || '',
            text: this.oldText || '',
            date: this.oldDate || null,
        };
    },
    computed: {
        html() {
            return marked(this.text);
        },
    },
    methods: {
        capitalize(str) {
            return str[0].toUpperCase() + str.substr(1);
        },
    },
};
</script>

<style lang="scss">
    .vdatetime-popup__header,
    .vdatetime-calendar__month__day--selected > span > span,
    .vdatetime-calendar__month__day--selected:hover > span > span {
        background: theme('colors.blue-dark');
    }

    .vdatetime-popup__actions__button {
        text-transform: uppercase;
        color: theme('colors.blue-dark');

        &:hover {
            color: theme('colors.blue-darker');
            background: theme('colors.overlay');
        }

    }
</style>
