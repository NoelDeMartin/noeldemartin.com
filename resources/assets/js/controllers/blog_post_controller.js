import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = ['tableOfContents', 'overlay'];

    initialize() {
        this.scrollListener = null;
        this.tableOfContentsOpen = false;
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
        this.tableOfContentsOpen = !this.tableOfContentsOpen;
        this.tableOfContentsTarget.classList.toggle('-translate-x-full');

        if (this.tableOfContentsOpen) {
            this.overlayTarget.classList.remove('hidden');

            setTimeout(() => {
                this.overlayTarget.classList.remove('opacity-0');
                this.overlayTarget.classList.add('opacity-100');
            });
        } else {
            this.overlayTarget.classList.add('opacity-0');
            this.overlayTarget.classList.remove('opacity-100');

            setTimeout(() => {
                this.overlayTarget.classList.add('hidden');
            }, 300);
        }
    }

    __updateProgress() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
        const progress = (100 * scrollTop / (document.body.clientHeight - window.innerHeight)).toFixed(2);

        this.element.style.setProperty('--progress', `${progress}%`);
    }
}
