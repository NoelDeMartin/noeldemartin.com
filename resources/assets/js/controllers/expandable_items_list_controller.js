import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = ['item'];

    connect() {
        this.listener = (event) => this.onItemToggled(event);

        for (let item of this.itemTargets) {
            item.addEventListener('toggle', this.listener);
        }
    }

    disconnect() {
        for (let item of this.itemTargets) {
            item.removeEventListener('toggle', this.listener);
        }
    }

    onItemToggled(event) {
        for (let item of this.itemTargets) {
            if (item !== event.target) {
                const controller = this.application.getControllerForElementAndIdentifier(item, 'expandable-item');
                if (controller) {
                    controller.collapse();
                }
            }
        }
    }
}
