import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = ['nav'];

    toggle() {
        this.open = !this.open;
    }

    get open() {
        return this.data.get('open') === 'true';
    }

    set open(value) {
        this.data.set('open', value);
        this.navTarget.classList.toggle('open', value);
        document.body.classList.toggle('navigation-open', value);
    }
}
