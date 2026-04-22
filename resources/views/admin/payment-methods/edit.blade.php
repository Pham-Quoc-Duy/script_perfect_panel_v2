<!-- Modal chỉnh sửa payment method -->
<div class="modal fade" id="editPaymentMethodModal" tabindex="-1" aria-labelledby="editPaymentMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPaymentMethodModalLabel">Chỉnh sửa phương thức thanh toán</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPaymentMethodForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_name_en" class="form-label">Tên tiếng Anh <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_name_en" name="name[en]" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_name_vi" class="form-label">Tên tiếng Việt <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_name_vi" name="name[vi]" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Loại phương thức <span class="text-danger">*</span></label>
                        <select class="form-select" id="edit_type" name="type" required>
                            <option value="">-- Chọn loại phương thức --</option>
                            @foreach(\App\Models\PaymentMethod::getTypes() as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">Chọn loại phương thức thanh toán phù hợp</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_image" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                                <div class="form-text">Chấp nhận: JPG, PNG, GIF. Tối đa 2MB.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Trạng thái</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="edit_payment_method_status" name="status" value="1">
                                    <label class="form-check-label" for="edit_payment_method_status">
                                        Kích hoạt phương thức thanh toán
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Image -->
                    <div class="row" id="currentImageContainer">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh hiện tại</label>
                                <div class="border rounded p-3 text-center">
                                    <img id="currentImage" src="" alt="Current Image" 
                                         style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- New Image Preview -->
                    <div class="row" id="newImagePreview" style="display: none;">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Xem trước hình ảnh mới</label>
                                <div class="border rounded p-3 text-center">
                                    <img id="newPreviewImg" src="" alt="New Preview" 
                                         style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-check me-1"></i>Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editPaymentMethodModal(id) {
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('editPaymentMethodModal'));
    modal.show();
    
    // Fetch payment method data
    fetch(`/admin/payment-methods/${id}`)
        .then(response => response.json())
        .then(data => {
            // Fill form
            document.getElementById('edit_name_en').value = data.name?.en || '';
            document.getElementById('edit_name_vi').value = data.name?.vi || '';
            document.getElementById('edit_type').value = data.type || '';
            document.getElementById('edit_payment_method_status').checked = data.status;
            
            // Show current image
            const currentImageContainer = document.getElementById('currentImageContainer');
            const currentImage = document.getElementById('currentImage');
            if (data.image_url) {
                currentImage.src = data.image_url;
                currentImageContainer.style.display = 'block';
            } else {
                currentImageContainer.style.display = 'none';
            }
            
            // Set form action
            document.getElementById('editPaymentMethodForm').action = `/admin/payment-methods/${id}`;
            
            // Store ID
            window.editingPaymentMethodId = id;
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'Có lỗi xảy ra khi tải thông tin');
        });
}

// Handle form submission
document.getElementById('editPaymentMethodForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const paymentMethodId = window.editingPaymentMethodId;
    
    fetch(`/admin/payment-methods/${paymentMethodId}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        if (response.ok) {
            showToast('success', 'Phương thức thanh toán đã được cập nhật thành công!');
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            throw new Error('Update failed');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Có lỗi xảy ra khi cập nhật phương thức thanh toán');
    });
});

// Image preview for edit form
document.getElementById('edit_image').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('newPreviewImg').src = e.target.result;
            document.getElementById('newImagePreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('newImagePreview').style.display = 'none';
    }
});
</script>