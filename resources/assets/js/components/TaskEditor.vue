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
            v-model="name"
            name="name"
            placeholder="New Task"
            class="block appearance-none border rounded mb-4 py-2 px-3 text-grey-darker w-full focus:shadow"
        >

        <div class="w-full flex border border-grey-light">

            <textarea
                :class="{ 'hidden': mode === 'preview' }"
                v-model="description"
                name="description_markdown"
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
                name="description_html"
            >

        </div>

        <div class="flex justify-between items-center mt-4">

            <button
                type="submit"
                class="bg-blue-dark hover:bg-blue-darker text-white font-bold py-2 px-4 rounded"
            >
                Start
            </button>

        </div>

    </div>
</template>

<script>
import marked from 'marked';

export default {
    props: {
        oldName: {
            type: String,
            default: '',
        },
        oldDescription: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            mode: 'both',
            name: this.oldName || '',
            description: this.oldDescription || '',
        };
    },
    computed: {
        html() {
            return marked(this.description);
        },
    },
    methods: {
        capitalize(str) {
            return str[0].toUpperCase() + str.substr(1);
        },
    },
};
</script>
