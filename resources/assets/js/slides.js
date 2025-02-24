import 'pdfjs-dist/web/pdf_viewer.css';

import Alpine from 'alpinejs';
import * as pdfjsLib from 'pdfjs-dist';
import * as pdfjsViewer from 'pdfjs-dist/web/pdf_viewer.mjs';
import {
    getLocationQueryParameter,
    updateLocationQueryParameters,
} from '@noeldemartin/utils';

pdfjsLib.GlobalWorkerOptions.workerSrc = '/build/assets/slides.worker.js';

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

    window.addEventListener('resize', () => {
        viewer.currentScaleValue = 'page-width';
    });

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
    const updateDimensions = () => {
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
    };

    updateDimensions();
    window.addEventListener('resize', () => updateDimensions());

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
            const initialSlide = parseInt(
                getLocationQueryParameter('slide') ?? 1,
            );

            viewer = await initializeViewer(
                url,
                this.$refs['slides-container'],
            );

            initializeNav((show) => (this.showNav = show));

            this.currentPage = initialSlide;
            this.totalPages = viewer.pagesCount;
            viewer.currentPageNumber = initialSlide;
            updateLocationQueryParameters({ slide: this.currentPage });

            this.$refs['nav'].classList.remove('invisible');
            this.$refs['loading'].remove();
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

            updateLocationQueryParameters({ slide: this.currentPage });
        },
        previousSlide() {
            if (!viewer) {
                return;
            }

            viewer.previousPage();

            this.currentPage = viewer.currentPageNumber;

            updateLocationQueryParameters({ slide: this.currentPage });
        },
    }));
});
