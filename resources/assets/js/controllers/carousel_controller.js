import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = ['button', 'viewer', 'viewerImage'];

    initialize() {
        this.activeButton = null;
        this.keyboardListener = null;
    }

    show({ target: button }) {
        this.__setActiveButton(button);

        document.addEventListener('keydown', this.keyboardListener = event => {
            switch (event.code) {
                case 'ArrowLeft':
                    this.previous();
                    event.preventDefault();
                    break;
                case 'ArrowRight':
                    this.next();
                    event.preventDefault();
                    break;
                case 'Escape':
                    this.hide();
                    event.preventDefault();
                    break;
            }
        });

        this.viewerTarget.classList.add('flex');
        this.viewerTarget.classList.remove('hidden');
    }

    hide() {
        this.__setActiveButton(null);

        document.removeEventListener('keydown', this.keyboardListener);

        this.keyboardListener = null;

        this.viewerTarget.classList.add('hidden');
        this.viewerTarget.classList.remove('flex');
    }

    next() {
        this.__move(1);
    }

    previous() {
        this.__move(-1);
    }

    disconnect() {
        if (this.keyboardListener === null)
            return;

        document.removeEventListener('keydown', this.keyboardListener);

        this.keyboardListener = null;
    }

    __move(delta) {
        const index = this.buttonTargets.indexOf(this.activeButton);

        if (index === -1)
            return;

        this.__setActiveButton(this.buttonTargets[(this.buttonTargets.length + index + delta) % this.buttonTargets.length]);
    }

    __setActiveButton(button) {
        this.activeButton = button;

        if (button) {
            const image = JSON.parse(button.dataset.image);

            this.viewerImageTarget.src = image.url;
            this.viewerImageTarget.alt = image.description;
            this.viewerImageTarget.title = image.description;
        }
    }
}
