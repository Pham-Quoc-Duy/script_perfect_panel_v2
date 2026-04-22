<script>
    // Delete platform function - Based on exact t.html AlertifyJS confirm implementation
    window.deletePlatform = function(platformId, platformName = '') {
        window.currentPlatformId = platformId;

        // Check if dark mode is active
        const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark' ||
            document.body.classList.contains('dark-mode') ||
            document.querySelector('[data-bs-theme="dark"]');

        // Apply dark mode styles if needed
        if (isDark && !document.getElementById('alertify-dark-style')) {
            const style = document.createElement('style');
            style.id = 'alertify-dark-style';
            style.textContent = `
            .alertify .ajs-dialog { background: #212529 !important; color: #f8f9fa !important; border: 1px solid #495057 !important; }
            .alertify .ajs-body { background: #212529 !important; color: #f8f9fa !important; }
            .alertify .ajs-footer { background: #343a40 !important; border-top: 1px solid #495057 !important; }
            .alertify .ajs-dimmer { background: rgba(0,0,0,0.7) !important; }
        `;
            document.head.appendChild(style);
        }

        // Exact AlertifyJS confirm implementation from t.html
        alertify.confirm('Xác nhận xóa nền tảng', `Bạn có chắc chắn muốn xóa nền tảng "${platformName}" không?`,
            function() {
                // User confirmed - exactly like t.html success callback
                const form = document.getElementById('delete-form-' + window.currentPlatformId);
                if (form) {
                    alertify.success('Đang xóa nền tảng...');
                    form.submit();
                } else {
                    alertify.error('Không tìm thấy form xóa');
                }
            },
            function() {
                // User cancelled - exactly like t.html cancel callback
                alertify.error('Đã hủy thao tác xóa');
            }
        );
    };

    // Event delegation for delete buttons
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.delete-platform-btn');
            if (btn) {
                e.preventDefault();
                const platformId = btn.dataset.platformId;
                const platformName = btn.dataset.platformName || 'nền tảng này';
                window.deletePlatform(platformId, platformName);
            }
        });
    });
</script>