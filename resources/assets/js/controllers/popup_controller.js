import { Controller } from 'stimulus';

export default class extends Controller {
    show(event) {
        event.preventDefault();

        if (this.twitter && this.twitterPlatformLoaded) {
            return;
        }

        const width = Math.min(window.screen.width * 0.8, 600);
        const height = Math.min(window.screen.height * 0.6, 600);
        const left = (window.screen.width / 2) - (width / 2);
        const top = (window.screen.height / 2) - (height / 2);
        window.open(
            this.data.get('url'),
            '',
            `menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=${width},height=${height},top=${top},left=${left}`
        );
    }

    get twitterPlatformLoaded() {
        return !!window.twttr;
    }

    get twitter() {
        return this.data.get('twitter') === 'true';
    }
}
