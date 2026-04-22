/**
 * Full Screen Loader Helper
 * Quản lý loader toàn màn hình khi thực hiện các thao tác
 * Tối màn hình trừ modal
 */

class FullScreenLoader {
    constructor() {
        this.loader = null;
        this.overlay = null;
        this.init();
    }

    init() {
        // Tạo loader element nếu chưa tồn tại
        if (!document.getElementById('fullscreen-loader-global')) {
            const loaderHTML = `
                <div id="fullscreen-loader-overlay" class="fullscreen-loader-overlay d-none"></div>
                <div id="fullscreen-loader-global" class="fullscreen-loader d-none">
                    <div class="loader-content">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', loaderHTML);
        }
        this.loader = document.getElementById('fullscreen-loader-global');
        this.overlay = document.getElementById('fullscreen-loader-overlay');
    }

    show(message = 'Đang xử lý...', excludeModal = null) {
        if (!this.loader) this.init();

        // Hiển thị overlay
        if (this.overlay) {
            this.overlay.classList.remove('d-none');
            this.overlay.classList.remove('fade-out');
        }

        // Hiển thị loader
        this.loader.classList.remove('d-none');
        this.loader.classList.remove('fade-out');

        // Nếu có modal, đặt z-index cao hơn overlay
        if (excludeModal) {
            const modal = document.querySelector(excludeModal);
            if (modal) {
                modal.style.zIndex = '10000';
            }
        }

        // Disable body scroll
        document.body.style.overflow = 'hidden';
    }

    hide() {
        if (!this.loader) return;

        // Fade out animation
        if (this.overlay) {
            this.overlay.classList.add('fade-out');
        }
        this.loader.classList.add('fade-out');

        setTimeout(() => {
            this.loader.classList.add('d-none');
            this.loader.classList.remove('fade-out');

            if (this.overlay) {
                this.overlay.classList.add('d-none');
                this.overlay.classList.remove('fade-out');
            }

            // Reset z-index
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                modal.style.zIndex = '';
            });

            // Enable body scroll
            document.body.style.overflow = 'auto';
        }, 300);
    }

    hideImmediately() {
        if (!this.loader) return;

        this.loader.classList.add('d-none');
        if (this.overlay) {
            this.overlay.classList.add('d-none');
        }

        // Reset z-index
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.style.zIndex = '';
        });

        document.body.style.overflow = 'auto';
    }
}

// Tạo instance global
const fullScreenLoader = new FullScreenLoader();

// Helper function để sử dụng dễ dàng
function showFullScreenLoader(message = 'Đang xử lý...', excludeModal = null) {
    fullScreenLoader.show(message, excludeModal);
}

function hideFullScreenLoader() {
    fullScreenLoader.hide();
}

function hideFullScreenLoaderImmediately() {
    fullScreenLoader.hideImmediately();
}