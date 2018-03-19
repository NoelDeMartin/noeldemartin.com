import { Controller } from 'stimulus';

const skins = [];
let colorAnimationRunning = false;

function updateSkinsColor() {
    for (let skin of skins) {
        skin.style.backgroundColor = 'hsl(' + ((Date.now() / 100) % 360) + ', 40%, 80%)';
    }
    requestAnimationFrame(updateSkinsColor);
}

export default class extends Controller {
    static targets = ['skin'];

    connect() {
        if (!colorAnimationRunning) {
            colorAnimationRunning = true;
            updateSkinsColor();
        }

        skins.push(...this.skinTargets);
    }

    disconnect() {
        for (let skin of this.skinTargets) {
            const index = skins.indexOf(skin);
            if (index !== -1) {
                skins.splice(index, 1);
            }
        }
    }
}
