@push('scripts')
<script>
    // Delete service function - Based on platform delete implementation
    window.deleteService = function(serviceId, serviceName = '') {
        window.currentServiceId = serviceId;

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
        alertify.confirm('Xác nhận xóa dịch vụ', `Bạn có chắc chắn muốn xóa dịch vụ "${serviceName}" không?`,
            function() {
                // User confirmed - submit delete form
                const form = document.getElementById('delete-form-' + window.currentServiceId);
                if (form) {
                    alertify.success('Đang xóa dịch vụ...');
                    form.submit();
                } else {
                    alertify.error('Không tìm thấy form xóa');
                }
            },
            function() {
                // User cancelled
                alertify.error('Đã hủy thao tác xóa');
            }
        );
    };

    // Alias for deleteServiceModal
    window.deleteServiceModal = window.deleteService;

    // Event delegation for delete buttons
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.delete-service-btn');
            if (btn) {
                e.preventDefault();
                const serviceId = btn.dataset.serviceId;
                const serviceName = btn.dataset.serviceName || 'dịch vụ này';
                window.deleteService(serviceId, serviceName);
            }
        });
    });
</script>
@endpush
