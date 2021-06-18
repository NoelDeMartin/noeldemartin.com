let headerCollapsed = false;

function prepareRequest({ data: { xhr } }) {
    xhr.setRequestHeader('X-Header-Collapsed', headerCollapsed);
}

function updateHeader() {
    const header = document.querySelector('header');

    headerCollapsed = JSON.parse(header.dataset.collapsed);
    headerCollapsed ? header.classList.add('collapsed') : header.classList.remove('collapsed');
}

export function animateHeaderCollapse() {
    document.addEventListener('turbolinks:request-start', prepareRequest);
    document.addEventListener('turbolinks:render', updateHeader);

    updateHeader();
}
