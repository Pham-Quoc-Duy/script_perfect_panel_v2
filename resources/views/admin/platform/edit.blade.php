<!-- Modal chỉnh sửa platform -->
<div class="modal fade" id="editPlatformModal" tabindex="-1" aria-labelledby="editPlatformModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPlatformModalLabel">
                    <i class="bx bx-edit me-2"></i>Chỉnh sửa nền tảng
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="editPlatformModalBody">
                <!-- Edit form content -->
                <div id="editFormContent" style="display: none;">
                    <form id="editPlatformForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_name" class="form-label">
                                        Tên nền tảng <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="edit_name" name="name" 
                                           required placeholder="Nhập tên nền tảng">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_position" class="form-label">Vị trí</label>
                                    <input type="number" class="form-control" id="edit_position" name="position" min="0">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_image" class="form-label">Hình ảnh</label>
                                    <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                                    <div class="invalid-feedback"></div>
                                    <small class="text-muted">Chọn file hình ảnh mới (nếu muốn thay đổi)</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="edit_status" name="status">
                                        <label class="form-check-label" for="edit_status">Kích hoạt nền tảng</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="edit_description" class="form-label">Mô tả</label>
                                    <textarea class="form-control" id="edit_description" name="description" 
                                              rows="3" placeholder="Nhập mô tả nền tảng (tùy chọn)"></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Current Image Preview -->
                        <div class="row" id="currentImagePreview" style="display: none;">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Hình ảnh hiện tại</label>
                                    <div>
                                        <img id="currentImage" src="" alt="" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Loading state -->
                <div id="editLoadingState" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Đang tải...</span>
                    </div>
                    <p class="text-muted mt-2 mb-0">Đang tải form chỉnh sửa...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" id="savePlatformBtn" class="btn btn-primary" onclick="savePlatform()">
                    <i class="bx bx-save me-1"></i>Lưu thay đổi
                </button>
            </div>
        </div>
    </div>
</div>

<script>
const getEditEl = id => document.getElementById(id);
const toggleEdit = (loading, content, show) => {
    const loadEl = getEditEl(loading);
    const contEl = getEditEl(content);
    if (loadEl) loadEl.style.display = show ? 'block' : 'none';
    if (contEl) contEl.style.display = show ? 'none' : 'block';
};

window.editPlatformModal = function(platformId) {
    window.currentPlatformId = platformId;
    const modal = getEditEl('editPlatformModal');
    
    if (!modal) {
        alertify.error('Modal không tìm thấy');
        return;
    }
    
    new bootstrap.Modal(modal).show();
    toggleEdit('editLoadingState', 'editFormContent', true);
    
    fetch(`/admin/platform/${platformId}`, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(r => r.json())
    .then(d => {
        const platform = d.success && d.platform ? d.platform : (d.id ? d : null);
        
        if (platform) {
            // Populate form fields
            getEditEl('edit_name').value = platform.name || '';
            getEditEl('edit_position').value = platform.position || '0';
            getEditEl('edit_description').value = platform.description || '';
            getEditEl('edit_status').checked = Boolean(platform.status);
            
            // Show current image if exists
            const currentImagePreview = getEditEl('currentImagePreview');
            const currentImage = getEditEl('currentImage');
            
            if (platform.image) {
                currentImage.src = platform.image;
                currentImage.alt = platform.name;
                currentImagePreview.style.display = 'block';
            } else {
                currentImagePreview.style.display = 'none';
            }
            
            toggleEdit('editLoadingState', 'editFormContent', false);
        } else {
            alertify.error('Không tìm thấy dữ liệu');
        }
    })
    .catch(e => {
        alertify.error('Lỗi tải dữ liệu');
        toggleEdit('editLoadingState', 'editFormContent', false);
    });
};

window.savePlatform = function() {
    const form = getEditEl('editPlatformForm');
    const btn = getEditEl('savePlatformBtn');
    
    if (!form || !btn) return;
    
    const orig = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Đang lưu...';
    
    fetch(`/admin/platform/${window.currentPlatformId}`, {
        method: 'POST',
        body: new FormData(form),
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(r => r.json())
    .then(d => {
        if (d.success) {
            alertify.success(d.message || 'Cập nhật thành công!');
            bootstrap.Modal.getInstance(getEditEl('editPlatformModal')).hide();
            setTimeout(() => location.reload(), 1000);
        } else {
            alertify.error(d.message || 'Có lỗi xảy ra');
        }
    })
    .catch(e => alertify.error('Có lỗi xảy ra'))
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = orig;
    });
};
</script>