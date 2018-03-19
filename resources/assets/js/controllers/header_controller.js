import { Controller } from 'stimulus';

export default class extends Controller {
    connect() {
        this.active = true;
        const update = () => {
            this.updateColor();
            if (this.active) requestAnimationFrame(update);
        };
        requestAnimationFrame(update);
    }

    disconnect() {
        this.active = false;
    }

    updateColor() {
        this.element.style.backgroundColor = 'hsl(' + ((Date.now() / 100) % 360) + ', 40%, 80%)';
    }
}
