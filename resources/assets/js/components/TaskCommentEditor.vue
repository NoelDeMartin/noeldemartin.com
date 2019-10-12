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

            <button
                type="submit"
                class="bg-blue-dark hover:bg-blue-darker text-white font-bold py-2 px-4 rounded"
            >
                Comment
            </button>

        </div>

    </div>
</template>

<script>
import marked from 'marked';

export default {
    props: {
        oldText: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            mode: 'both',
            text: this.oldText || '',
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
