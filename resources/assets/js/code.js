let Prism;

async function loadPrism() {
    if (Prism) {
        return;
    }

    Prism = await import('prismjs');
    await import('prismjs/components/prism-javascript');
    await import('prismjs/components/prism-json');
    await import('prismjs/components/prism-markup-templating');
    await import('prismjs/components/prism-php');
    await import('prismjs/components/prism-scss');
    await import('prismjs/components/prism-turtle');
    await import('prismjs/components/prism-typescript');
}

function getLanguage(element) {
    for (const className of element.classList) {
        if (!className.startsWith('language-')) {
            continue;
        }

        return className.substr(9);
    }
}

function highlightCodeElement(element, language) {
    if (
        element.parentElement &&
        element.parentElement.tagName &&
        element.parentElement.tagName.toLowerCase() === 'pre'
    ) {
        element.parentElement.classList.add(`language-${language}`);
    }

    element.innerHTML = Prism.highlight(
        element.innerText,
        Prism.languages[language],
        language,
    );
}

async function highlightCode() {
    const codeElements = document.querySelectorAll('code');

    if (codeElements.length === 0) {
        return;
    }

    await loadPrism();

    for (const codeElement of codeElements) {
        const language = getLanguage(codeElement);

        if (!language) {
            continue;
        }

        highlightCodeElement(codeElement, language);
    }
}

if (document.readyState === 'complete') {
    highlightCode();
} else {
    document.addEventListener('DOMContentLoaded', highlightCode);
}
