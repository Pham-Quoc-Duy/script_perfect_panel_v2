<script>
    // Delete currency function - Based on exact t.html AlertifyJS confirm implementation
    window.deleteCurrency = function(currencyId, currencyName = '') {
        window.currentCurrencyId = currencyId;

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
        alertify.confirm('Xác nhận xóa tiền tệ', `Bạn có chắc chắn muốn xóa tiền tệ "${currencyName}" không?`,
            function() {
                // User confirmed - exactly like t.html success callback
                // Create form dynamically
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/currency/${window.currentCurrencyId}`;
                form.innerHTML = `
                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                    <input type="hidden" name="_method" value="DELETE">
                `;
                document.body.appendChild(form);
                alertify.success('Đang xóa tiền tệ...');
                form.submit();
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
            const btn = e.target.closest('.delete-currency-btn');
            if (btn) {
                e.preventDefault();
                const currencyId = btn.dataset.currencyId;
                const currencyName = btn.dataset.currencyName || 'tiền tệ này';
                window.deleteCurrency(currencyId, currencyName);
            }
        });
    });
</script>