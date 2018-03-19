import { Controller } from 'stimulus';
import { toast } from '../utils/toast';

export default class extends Controller {
    copy(event) {
        event.preventDefault();
        const url = this.element.href;
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(url);
        } else {
            try {
                const input = document.createElement('input');
                input.value = url;
                input.style = 'position:fixed; top: -9999px';
                document.body.appendChild(input);
                input.focus();
                input.select();
                document.execCommand('copy');
                input.remove();
                toast('Link copied to clipboard!');
            } catch (e) {
                window.prompt('Copy this link:', url);
            }
        }
    }
}
