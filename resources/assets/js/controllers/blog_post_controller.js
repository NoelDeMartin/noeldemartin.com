import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = ['tableOfContents'];

    initialize() {
        this.scrollListener = null;
    }

    connect() {
        document.addEventListener('scroll', this.scrollListener = () => this.__updateProgress());
        window.addEventListener('load', () => this.__updateProgress());

        this.__updateProgress();
    }

    disconnect() {
        if (this.keyboardListener === null)
            return;

        document.removeEventListener('scroll', this.scrollListener);

        this.scrollListener = null;
    }

    toggleTableOfContents() {
        this.tableOfContentsTarget.classList.toggle('-translate-x-full');
    }

    __updateProgress() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
        const progress = (100 * scrollTop / (document.body.clientHeight - window.innerHeight)).toFixed(2);

        this.element.style.setProperty('--progress', `${progress}%`);
    }
}
