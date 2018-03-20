import { Controller } from 'stimulus';
import { toast } from '../utils/toast';

export default class extends Controller {
    copy(event) {
        event.preventDefault();
        const data = this.data.get('data');
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(data);
        } else {
            try {
                const input = document.createElement('input');
                input.value = data;
                input.style = 'position:fixed; top: -9999px';
                document.body.appendChild(input);
                input.focus();
                input.select();
                document.execCommand('copy');
                input.remove();
                toast(this.data.get('success'));
            } catch (e) {
                window.prompt('Copy this:', data);
            }
        }
    }
}
