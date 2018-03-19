import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = ['content'];

    initialize() {
        this.collapsed = true;
        this.animating = false;
        this.contentHeight = this.__calculateContentHeight();
    }

    toggle() {
        if (!this.animating) {
            this.element.dispatchEvent(new Event('toggle'));
            this.animating = true;
            this.collapsed = !this.collapsed;

            const start = Date.now();
            const duration = this.animationDuration;
            const update = () => {
                const progress = (Date.now() - start) / duration;
                if (progress < 1) {
                    this.contentTarget.style.height = this.collapsed
                        ? this.contentHeight * (1 - progress) + 'px'
                        : this.contentHeight * progress + 'px';
                    requestAnimationFrame(update);
                } else {
                    this.contentTarget.style.height = this.collapsed ? '0' : 'auto';
                    this.animating = false;
                }
            };

            requestAnimationFrame(update);
        }
    }

    __calculateContentHeight() {
        const initialStyles = {
            visibility: this.contentTarget.style.visibility,
            height: this.contentTarget.style.height,
            position: this.contentTarget.style.position,
        };

        this.contentTarget.style.visibility = 'hidden';
        this.contentTarget.style.height = 'auto';
        this.contentTarget.style.position = 'fixed';

        const height = this.contentTarget.clientHeight;

        this.contentTarget.style.visibility = initialStyles.visibility;
        this.contentTarget.style.height = initialStyles.height;
        this.contentTarget.style.position = initialStyles.position;

        return height;
    }

    get animationDuration() {
        return this.data.get('animationDuration');
    }

    get collapsed() {
        return this.data.get('collapsed') === 'true';
    }

    set collapsed(value) {
        this.data.set('collapsed', value);
        this.element.classList.toggle('collapsed', value);
        this.element.classList.toggle('expanded', !value);
    }
}
