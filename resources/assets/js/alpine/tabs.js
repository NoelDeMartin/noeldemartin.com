import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

Alpine.plugin(focus);

Alpine.data('tabs', (namespace = 'tab') => ({
    namespace,
    selectedId: null,

    init() {
        this.$nextTick(() => this.select(this.$id(this.namespace, 1)));
    },

    select(id) {
        this.selectedId = id;
    },

    isSelected(id) {
        return this.selectedId === id;
    },

    whichChild(el, parent) {
        return Array.from(parent.children).indexOf(el) + 1;
    },
}));

Alpine.bind('tablist', () => ({
    ['x-ref']: 'tablist',
    ['@keydown.right.prevent.stop']() {
        this.$focus.wrap().next();
    },
    ['@keydown.home.prevent.stop']() {
        this.$focus.first();
    },
    ['@keydown.page-up.prevent.stop']() {
        this.$focus.first();
    },
    ['@keydown.left.prevent.stop']() {
        this.$focus.wrap().prev();
    },
    ['@keydown.end.prevent.stop']() {
        this.$focus.last();
    },
    ['@keydown.page-down.prevent.stop']() {
        this.$focus.last();
    },
}));

Alpine.bind('tab', () => ({
    [':id']() {
        return this.$id(
            this.namespace,
            this.whichChild(this.$el.parentElement, this.$refs.tablist),
        );
    },
    ['@click']() {
        this.select(this.$el.id);
    },
    ['@focus']() {
        this.select(this.$el.id);
    },
    [':tabindex']() {
        return this.isSelected(this.$el.id) ? 0 : -1;
    },
    [':aria-selected']() {
        return this.isSelected(this.$el.id);
    },
}));
