import { Controller } from 'stimulus';

export default class extends Controller {
    connect() {
        Promise.all([
            import(/* webpackChunkName: "task-editor" */ 'vue'),
            import(/* webpackChunkName: "task-editor" */ '../components/TaskEditor.vue'),
        ]).then(([Vue, { default: TaskEditor }]) => {
            new Vue({
                render: h => h(TaskEditor, {
                    props: {
                        'old-name': this.data.get('name'),
                        'old-description': this.data.get('description'),
                    },
                }),
            }).$mount(this.element);
        });
    }
}
