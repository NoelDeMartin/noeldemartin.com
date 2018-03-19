import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = ['sidebar', 'overlay'];

    toggle() {
        this.collapsed = !this.collapsed;
    }

    get collapsed() {
        return this.data.get('collapsed') === 'true';
    }

    set collapsed(value) {
        this.data.set('collapsed', value);
        this.sidebarTarget.style.transform = value ? 'translateX(-100%)' : 'translateX(0)';
        this.overlayTarget.classList.toggle('hidden', value);
    }
}
