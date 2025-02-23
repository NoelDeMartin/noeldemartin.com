import 'pdfjs-dist/web/pdf_viewer.css';
import 'pdfjs-dist/build/pdf.worker.mjs';

import Alpine from 'alpinejs';
import * as pdfjsLib from 'pdfjs-dist';
import * as pdfjsViewer from 'pdfjs-dist/web/pdf_viewer.mjs';

async function initializeViewer(url, container) {
    const document = await pdfjsLib.getDocument({ url }).promise;
    const linkService = new pdfjsViewer.PDFLinkService();
    const eventBus = new pdfjsViewer.EventBus();

    await initializeContainer(container, document);

    const viewer = new pdfjsViewer.PDFSinglePageViewer({
        container,
        linkService,
        eventBus,
        removePageBorders: true,
    });

    viewer.setDocument(document);
    linkService.setViewer(viewer);
    linkService.setDocument(document, null);

    return new Promise((resolve) => {
        eventBus.on('pagesinit', () => {
            viewer.currentScaleValue = 'page-width';

            resolve(viewer);
        });
    });
}

async function initializeContainer(container, pdfDocument) {
    const viewer = document.createElement('div');

    viewer.classList.add('pdfViewer');

    container.appendChild(viewer);

    const firstPage = await pdfDocument.getPage(1);
    const slidesAspectRatio = firstPage.view[2] / firstPage.view[3];
    const pageAspectRatio =
        document.body.clientWidth / document.body.clientHeight;

    if (slidesAspectRatio > pageAspectRatio) {
        document.body.style.setProperty(
            '--slides-width',
            `${document.body.clientWidth}px`,
        );
        document.body.style.setProperty(
            '--slides-height',
            `${document.body.clientWidth / slidesAspectRatio}px`,
        );
    } else {
        document.body.style.setProperty(
            '--slides-width',
            `${document.body.clientHeight * slidesAspectRatio}px`,
        );
        document.body.style.setProperty(
            '--slides-height',
            `${document.body.clientHeight}px`,
        );
    }

    return container;
}

function initializeNav(setShowNav) {
    if (window.matchMedia('(any-hover: none)').matches) {
        return;
    }

    let timeout;
    const duration = 5000;
    const showNav = () => {
        setShowNav(true);

        timeout && clearTimeout(timeout);
        timeout = setTimeout(() => setShowNav(false), duration);
    };

    document.addEventListener('mousemove', (e) => {
        if (e.clientY < document.body.clientHeight * 0.95) {
            return;
        }

        showNav();
    });

    showNav();
}

document.addEventListener('alpine:init', () => {
    let viewer;

    Alpine.data('slides', () => ({
        currentPage: 0,
        totalPages: 0,
        showNav: true,
        async initialize(url) {
            viewer = await initializeViewer(
                url,
                this.$refs['slides-container'],
            );

            initializeNav((show) => (this.showNav = show));

            this.currentPage = 1;
            this.totalPages = viewer.pagesCount;
        },
        get pagination() {
            return `(${this.currentPage}/${this.totalPages})`;
        },
        nextSlide() {
            if (!viewer) {
                return;
            }

            viewer.nextPage();

            this.currentPage = viewer.currentPageNumber;
        },
        previousSlide() {
            if (!viewer) {
                return;
            }

            viewer.previousPage();

            this.currentPage = viewer.currentPageNumber;
        },
    }));
});
