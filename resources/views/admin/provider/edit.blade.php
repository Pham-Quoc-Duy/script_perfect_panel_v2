<!-- Modal chỉnh sửa provider -->
<div class="modal fade" id="editProviderModal" tabindex="-1" aria-labelledby="editProviderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProviderModalLabel">
                    <i class="bx bx-edit me-2"></i>Chỉnh sửa API Provider
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="editProviderModalBody">
                <!-- Edit form content -->
                <div id="editProviderFormContent" style="display: none;">
                    <form id="editProviderForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_provider_name" class="form-label">Tên Provider <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_provider_name" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_provider_type" class="form-label">Loại</label>
                                    <select class="form-select" id="edit_provider_type" name="type">
                                        <option value="smm">SMM Panel</option>
                                        <option value="other">Khác</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="edit_provider_link" class="form-label">API URL</label>
                                    <input type="url" class="form-control" id="edit_provider_link" name="link" placeholder="https://example.com/api/v2">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="edit_provider_api_key" class="form-label">API Key <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="edit_provider_api_key" name="api_key" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="toggleApiKeyVisibility()">
                                            <i class="bx bx-show" id="toggleApiKeyIcon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_provider_balance" class="form-label">Số dư</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="edit_provider_balance" name="balance" min="0" step="0.0001">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_provider_currency" class="form-label">Tiền tệ</label>
                                    <select class="form-select" id="edit_provider_currency" name="currency">
                                        <option value="USD">USD</option>
                                        <option value="VND">VND</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                        <option value="JPY">JPY</option>
                                        <option value="CNY">CNY</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="edit_provider_note" class="form-label">Ghi chú</label>
                                    <textarea class="form-control" id="edit_provider_note" name="note" rows="2"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="edit_provider_status" name="status">
                                        <label class="form-check-label" for="edit_provider_status">Kích hoạt provider</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Loading state -->
                <div id="editProviderLoadingState" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Đang tải...</span>
                    </div>
                    <p class="text-muted mt-2 mb-0">Đang tải form chỉnh sửa...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" id="saveProviderBtn" class="btn btn-primary" onclick="saveProvider()">
                    <i class="bx bx-save me-1"></i>Lưu thay đổi
                </button>
            </div>
        </div>
    </div>
</div>

<script>
const getEditProviderEl = id => document.getElementById(id);
const toggleEditProvider = (loading, content, show) => {
    const loadEl = getEditProviderEl(loading);
    const contEl = getEditProviderEl(content);
    if (loadEl) loadEl.style.display = show ? 'block' : 'none';
    if (contEl) contEl.style.display = show ? 'none' : 'block';
};

window.toggleApiKeyVisibility = function() {
    var input = getEditProviderEl('edit_provider_api_key');
    var icon = getEditProviderEl('toggleApiKeyIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bx bx-hide';
    } else {
        input.type = 'password';
        icon.className = 'bx bx-show';
    }
};

window.editProviderModal = function(providerId) {
    window.currentProviderId = providerId;
    var modal = getEditProviderEl('editProviderModal');
    
    if (!modal) {
        alertify.error('Modal không tìm thấy');
        return;
    }
    
    new bootstrap.Modal(modal).show();
    toggleEditProvider('editProviderLoadingState', 'editProviderFormContent', true);
    
    fetch('/admin/provider/' + providerId, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(r => r.json())
    .then(d => {
        var provider = d.success && d.data ? d.data : null;
        
        if (provider) {
            getEditProviderEl('edit_provider_name').value = provider.name || '';
            getEditProviderEl('edit_provider_type').value = provider.type || 'smm';
            getEditProviderEl('edit_provider_link').value = provider.link || '';
            getEditProviderEl('edit_provider_api_key').value = provider.api_key || '';
            getEditProviderEl('edit_provider_balance').value = provider.balance || 0;
            getEditProviderEl('edit_provider_currency').value = provider.currency || 'USD';
            getEditProviderEl('edit_provider_note').value = provider.note || '';
            getEditProviderEl('edit_provider_status').checked = Boolean(provider.status);
            
            toggleEditProvider('editProviderLoadingState', 'editProviderFormContent', false);
        } else {
            alertify.error('Không tìm thấy dữ liệu');
        }
    })
    .catch(e => {
        alertify.error('Lỗi tải dữ liệu');
        toggleEditProvider('editProviderLoadingState', 'editProviderFormContent', false);
    });
};

window.saveProvider = function() {
    var btn = getEditProviderEl('saveProviderBtn');
    
    if (!btn) return;
    
    var orig = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Đang lưu...';
    
    var formData = {
        name: getEditProviderEl('edit_provider_name').value,
        type: getEditProviderEl('edit_provider_type').value,
        link: getEditProviderEl('edit_provider_link').value,
        api_key: getEditProviderEl('edit_provider_api_key').value,
        balance: getEditProviderEl('edit_provider_balance').value,
        currency: getEditProviderEl('edit_provider_currency').value,
        note: getEditProviderEl('edit_provider_note').value,
        status: getEditProviderEl('edit_provider_status').checked
    };
    
    fetch('/admin/provider/' + window.currentProviderId, {
        method: 'PUT',
        body: JSON.stringify(formData),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(r => r.json())
    .then(d => {
        if (d.success) {
            alertify.success(d.message || 'Cập nhật thành công!');
            bootstrap.Modal.getInstance(getEditProviderEl('editProviderModal')).hide();
            setTimeout(function() { location.reload(); }, 1000);
        } else {
            alertify.error(d.message || d.error || 'Có lỗi xảy ra');
        }
    })
    .catch(e => alertify.error('Có lỗi xảy ra'))
    .finally(function() {
        btn.disabled = false;
        btn.innerHTML = orig;
    });
};
</script>
