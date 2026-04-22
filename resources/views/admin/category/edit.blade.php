<!-- Modal chỉnh sửa category -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">
                    <i class="bx bx-edit me-2"></i>Chỉnh sửa danh mục
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="editCategoryModalBody">
                <!-- Edit form content -->
                <div id="editFormContent" style="display: none;">
                    <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_platform_id" class="form-label">Nền tảng <span class="text-danger">*</span></label>
                                    <select class="form-select" id="edit_platform_id" name="platform_id" required>
                                        <option value="">Chọn nền tảng</option>
                                        @if(isset($platforms))
                                            @foreach($platforms as $platform)
                                                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
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
                                    <label for="edit_name_en" class="form-label">
                                        Tên tiếng Anh <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="edit_name_en" name="name[en]" 
                                           required placeholder="Nhập tên tiếng Anh">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_name_vi" class="form-label">
                                        Tên tiếng Việt <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="edit_name_vi" name="name[vi]" 
                                           required placeholder="Nhập tên tiếng Việt">
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
                                        <label class="form-check-label" for="edit_status">Kích hoạt danh mục</label>
                                    </div>
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
                <button type="button" id="saveCategoryBtn" class="btn btn-primary" onclick="saveCategory()">
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

// Helper function to get localized text from JSON
const getLocalizedText = (data, lang = 'en', defaultValue = '') => {
    if (!data) return defaultValue;
    if (typeof data === 'string') return data;
    if (typeof data === 'object') {
        return data[lang] || data['en'] || Object.values(data)[0] || defaultValue;
    }
    return defaultValue;
};

window.editCategoryModal = function(categoryId) {
    window.currentCategoryId = categoryId;
    const modal = getEditEl('editCategoryModal');
    
    if (!modal) {
        alertify.error('Modal không tìm thấy');
        return;
    }
    
    new bootstrap.Modal(modal).show();
    toggleEdit('editLoadingState', 'editFormContent', true);
    
    fetch(`/admin/category/${categoryId}`, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(r => r.json())
    .then(d => {
        const category = d.success && d.category ? d.category : (d.id ? d : null);
        
        if (category) {
            // Get user language
            const userLang = '{{ auth()->user()->lang ?? "en" }}';
            
            // Populate form fields
            getEditEl('edit_platform_id').value = category.platform_id || '';
            getEditEl('edit_position').value = category.position || '0';
            getEditEl('edit_name_en').value = category.name?.en || '';
            getEditEl('edit_name_vi').value = category.name?.vi || '';
            getEditEl('edit_status').checked = Boolean(category.status);
            
            // Get localized name for display using helper function
            const localizedName = getLocalizedText(category.name, userLang, 'Unnamed');
            
            // Show current image if exists
            const currentImagePreview = getEditEl('currentImagePreview');
            const currentImage = getEditEl('currentImage');
            
            if (category.image_url) {
                currentImage.src = category.image_url;
                currentImage.alt = localizedName;
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

window.saveCategory = function() {
    const form = getEditEl('editCategoryForm');
    const btn = getEditEl('saveCategoryBtn');
    
    if (!form || !btn) return;
    
    const orig = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Đang lưu...';
    
    fetch(`/admin/category/${window.currentCategoryId}`, {
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
            bootstrap.Modal.getInstance(getEditEl('editCategoryModal')).hide();
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