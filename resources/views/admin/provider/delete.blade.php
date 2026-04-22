<script>
    // Delete provider function - Based on exact admin user delete implementation
    window.deleteProviderModal = function(providerId, providerName = '') {
        window.currentProviderId = providerId;

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

        // AlertifyJS confirm implementation
        alertify.confirm('Xác nhận xóa Provider', `Bạn có chắc chắn muốn xóa provider "${providerName}" không?`,
            function() {
                // User confirmed
                alertify.success('Đang xóa provider...');
                
                fetch('/admin/provider/' + window.currentProviderId, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(r => r.json())
                .then(d => {
                    if (d.success) {
                        alertify.success('Xóa provider thành công!');
                        setTimeout(function() { location.reload(); }, 1000);
                    } else {
                        alertify.error(d.error || 'Có lỗi xảy ra khi xóa');
                    }
                })
                .catch(e => alertify.error('Có lỗi xảy ra khi xóa'));
            },
            function() {
                // User cancelled
                alertify.error('Đã hủy thao tác xóa');
            }
        );
    };

    // Event delegation for delete buttons
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.delete-provider-btn');
            if (btn) {
                e.preventDefault();
                const providerId = btn.dataset.providerId;
                const providerName = btn.dataset.providerName || 'provider này';
                window.deleteProviderModal(providerId, providerName);
            }
        });
    });
</script>
