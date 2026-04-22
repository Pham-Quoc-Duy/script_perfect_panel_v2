<!-- Modal xóa ngôn ngữ -->
<div class="modal fade" id="deleteLanguageModal" tabindex="-1" aria-labelledby="deleteLanguageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom bg-danger bg-opacity-10">
                <h5 class="modal-title text-danger" id="deleteLanguageModalLabel">
                    <i class="bx bx-trash-alt me-2"></i>Xóa ngôn ngữ
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger mb-3">
                    <i class="bx bx-exclamation-circle me-2"></i>
                    <strong>Cảnh báo!</strong> Hành động này không thể hoàn tác.
                </div>
                <p>Bạn có chắc chắn muốn xóa ngôn ngữ <strong id="delete_language_name">-</strong>?</p>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-danger" onclick="confirmDeleteLanguage()">
                    <i class="bx bx-trash-alt me-1"></i>Xóa ngôn ngữ
                </button>
            </div>
        </div>
    </div>
</div>

<script>
window.currentDeleteLanguageId = null;

document.addEventListener('DOMContentLoaded', function() {
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        const languageId = $(this).data('language-id');
        const languageName = $(this).data('language-name');
        
        window.currentDeleteLanguageId = languageId;
        document.getElementById('delete_language_name').textContent = languageName;
        
        const modal = new bootstrap.Modal(document.getElementById('deleteLanguageModal'));
        modal.show();
    });
});

window.confirmDeleteLanguage = function() {
    if (!window.currentDeleteLanguageId) {
        alertify.error('Không tìm thấy ngôn ngữ');
        return;
    }
    
    const btn = document.getElementById('confirmDeleteBtn');
    const orig = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Đang xóa...';
    
    const form = document.getElementById(`delete-form-${window.currentDeleteLanguageId}`);
    if (form) {
        form.submit();
    } else {
        fetch(`/admin/language/${window.currentDeleteLanguageId}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                alertify.success(d.message || 'Xóa thành công!');
                setTimeout(() => location.reload(), 1000);
            } else {
                alertify.error(d.message || 'Có lỗi xảy ra');
                btn.disabled = false;
                btn.innerHTML = orig;
            }
        })
        .catch(e => {
            alertify.error('Có lỗi xảy ra: ' + e.message);
            btn.disabled = false;
            btn.innerHTML = orig;
        });
    }
};
</script>
