import { Controller } from 'stimulus';

let Prism;

function getLanguage(element) {
    for (const className of element.classList) {
        if (className.startsWith('language-'))
            return className.substr(9);
    }
}

async function loadPrism() {
    if (Prism)
        return;

    Prism = await import(/* webpackChunkName: "code-highlighter" */ 'prismjs');
    await import(/* webpackChunkName: "code-highlighter" */ 'prismjs/components/prism-php');
    await import(/* webpackChunkName: "code-highlighter" */ 'prismjs/components/prism-scss');
    await import(/* webpackChunkName: "code-highlighter" */ 'prismjs/components/prism-json');
    await import(/* webpackChunkName: "code-highlighter" */ 'prismjs/components/prism-markup-templating');
    await import(/* webpackChunkName: "code-highlighter" */ 'prismjs/components/prism-turtle');
}

async function highlightCodeElement(element, language) {
    await loadPrism();

    if (
        element.parentElement &&
        element.parentElement.tagName &&
        element.parentElement.tagName.toLowerCase() === 'pre'
    ) {
        element.parentElement.classList.add(`language-${language}`);
    }

    element.innerHTML = Prism.highlight(element.innerText, Prism.languages[language], language);
}

export default class extends Controller {
    connect() {
        const codeElements = this.element.querySelectorAll('code');

        for (const codeElement of codeElements) {
            const language = getLanguage(codeElement);

            if (!language)
                continue;

            highlightCodeElement(codeElement, language);
        }
    }
}
