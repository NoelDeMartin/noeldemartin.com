import { Controller } from 'stimulus';

export default class extends Controller {
    connect() {
        Promise.all([
            import(/* webpackChunkName: "task-comment-editor" */ 'vue'),
            import(/* webpackChunkName: "task-comment-editor" */ '../components/TaskCommentEditor.vue'),
        ]).then(([Vue, { default: TaskCommentEditor }]) => {
            new Vue({
                render: h => h(TaskCommentEditor, {
                    props: {
                        'old-text': this.data.get('text'),
                    },
                }),
            }).$mount(this.element);
        });
    }
}
