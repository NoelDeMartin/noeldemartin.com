import { Controller } from 'stimulus';

export default class extends Controller {
    connect() {
        this.items = Array.from(this.element.children)
            .map((child) => this.application.getControllerForElementAndIdentifier(child, 'expandable-item'))
            .filter((controller) => !!controller);
        this.listener = (event) => this.onItemToggled(event);

        this.active = this.items[0];
        this.active.toggle();

        for (let item of this.items) {
            item.element.addEventListener('toggle', this.listener);
        }
    }

    disconnect() {
        for (let item of this.items) {
            item.element.removeEventListener('toggle', this.listener);
        }
    }

    onItemToggled(event) {
        const item = this.application.getControllerForElementAndIdentifier(event.target, 'expandable-item');
        if (item !== this.active) {
            if (this.active) {
                this.active.toggle();
            }
            this.active = item;
        } else {
            this.active = null;
        }
    }
}
