import { Controller } from 'stimulus';

export default class extends Controller {
    connect() {
        Promise.all([
            import(/* webpackChunkName: "post-editor" */ 'vue'),
            import(/* webpackChunkName: "post-editor" */ '../components/PostEditor.vue'),
        ]).then(([Vue, { default: PostEditor }]) => {
            new Vue({
                render: h => h(PostEditor, {
                    props: {
                        'old-title': this.data.get('title'),
                        'old-text': this.data.get('text'),
                        'old-date': this.data.get('date'),
                    },
                }),
            }).$mount(this.element);
        });
    }
}
