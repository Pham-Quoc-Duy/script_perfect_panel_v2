<div class="modal fade" tabindex="-1" id="modal-platform" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm mới nền tảng</h4>
            </div>
            <div class="modal-body">
                <div class="mb-5">
                    <label class="required form-label" data-lang="Name">Tên</label>
                    <input type="text" class="form-control form-control-solid ipt-platform-name">
                </div>
                <div class="mb-5">
                    <label class="required form-label" data-lang="Icon">Biểu tượng hoặc hình ảnh</label>
                    <div class="input-group input-group-solid">
                        <input type="text" class="form-control ipt-platform-icon"
                            placeholder="fa-brands fa-youtube hoặc https://example.com/icon.png">
                        <span class="input-group-text platform-icon" style="min-width: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image text-muted" style="font-size: 1.2rem;"></i>
                        </span>
                    </div>
                    <div class="form-text text-muted mt-2">
                        <small>Nhập Font Awesome class (vd: fa-brands fa-facebook) hoặc URL hình ảnh</small>
                    </div>
                </div>
                <div class="text-muted fst-italic"><span data-lang="">Tham khảo biểu tượng mẫu</span>: <a
                        href="https://fontawesome.com/search?o=r&amp;m=free" target="_blank" data-lang="">Tại đây</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"
                    data-lang="button::Close">Đóng</button>
                <button type="button" class="btn btn-primary btn-sm btn-add-platform">
                    <span class="btn-text">Thêm</span>
                </button>
            </div>
        </div>
    </div>
</div>




<script>
    const renderIcon = (value) => {
        const iconEl = document.querySelector('.platform-icon');
        iconEl.innerHTML = '';
        iconEl.style.display = 'flex';
        iconEl.style.alignItems = 'center';
        iconEl.style.justifyContent = 'center';
        iconEl.style.minWidth = '50px';
        iconEl.style.minHeight = '38px';

        if (!value || !value.trim()) {
            // Default icon when empty
            const defaultIcon = document.createElement('i');
            defaultIcon.className = 'fas fa-image text-muted';
            defaultIcon.style.fontSize = '1.2rem';
            iconEl.appendChild(defaultIcon);
            return;
        }

        const trimmedValue = value.trim();

        if (trimmedValue.includes('fa-') || trimmedValue.startsWith('fas ') || trimmedValue.startsWith('fab ') || trimmedValue.startsWith('far ')) {
            // Font Awesome icon
            const i = document.createElement('i');
            i.className = trimmedValue;
            i.style.fontSize = '1.3rem';
            i.style.color = '#495057';
            iconEl.appendChild(i);
        } else if (trimmedValue.match(/^https?:\/\/.+/i)) {
            // Image URL
            const img = document.createElement('img');
            img.src = trimmedValue;
            img.alt = 'Platform icon';
            img.style.width = '24px';
            img.style.height = '24px';
            img.style.objectFit = 'contain';
            img.style.borderRadius = '4px';
            
            // Handle image load error
            img.onerror = function() {
                iconEl.innerHTML = '';
                const errorIcon = document.createElement('i');
                errorIcon.className = 'fas fa-exclamation-triangle text-warning';
                errorIcon.style.fontSize = '1.2rem';
                errorIcon.title = 'Không thể tải hình ảnh';
                iconEl.appendChild(errorIcon);
            };
            
            iconEl.appendChild(img);
        } else {
            // Invalid format
            const errorIcon = document.createElement('i');
            errorIcon.className = 'fas fa-question-circle text-muted';
            errorIcon.style.fontSize = '1.2rem';
            errorIcon.title = 'Định dạng không hợp lệ';
            iconEl.appendChild(errorIcon);
        }
    };

    // Helper function to show error with loader
    const showPlatformValidationError = (message) => {
        showFullScreenLoader('', '#modal-platform');
        setTimeout(() => {
            hideFullScreenLoader();
            showToast(message, 'error');
        }, 300);
    };

    // Validation function
    const validatePlatformForm = () => {
        const name = document.querySelector('.ipt-platform-name').value.trim();
        const icon = document.querySelector('.ipt-platform-icon').value.trim();
        
        // Check name first
        if (!name) {
            showPlatformValidationError('Vui lòng nhập tên nền tảng');
            return false;
        }
        
        // Then check icon
        if (!icon) {
            showPlatformValidationError('Vui lòng nhập biểu tượng hoặc hình ảnh');
            return false;
        }

        // Validate icon format
        const trimmedIcon = icon.trim();
        const isFontAwesome = trimmedIcon.includes('fa-') || trimmedIcon.startsWith('fas ') || trimmedIcon.startsWith('fab ') || trimmedIcon.startsWith('far ');
        const isImageUrl = trimmedIcon.match(/^https?:\/\/.+/i);
        
        if (!isFontAwesome && !isImageUrl) {
            showPlatformValidationError('Không phải hình ảnh hoặc icon. Vui lòng nhập Font Awesome class hoặc URL hình ảnh');
            return false;
        }
        
        return true;
    };

    document.addEventListener('DOMContentLoaded', () => {
        const iconInput = document.querySelector('.ipt-platform-icon');
        const nameInput = document.querySelector('.ipt-platform-name');
        const btn = document.querySelector('.btn-add-platform');
        const modal = document.getElementById('modal-platform');

        // Real-time icon preview
        iconInput.addEventListener('input', (e) => {
            renderIcon(e.target.value);
        });

        nameInput.addEventListener('input', (e) => {});

        renderIcon('');

        btn.addEventListener('click', async (e) => {
            e.preventDefault();

            if (!validatePlatformForm()) return;

            const name = nameInput.value.trim();
            const icon = iconInput.value.trim();

            showFullScreenLoader('', '#modal-platform');
            btn.disabled = true;

            try {
                const response = await fetch('{{ route('admin.platform.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ name, image: icon })
                });

                const data = await response.json();

                if (data.success) {
                    hideFullScreenLoader();
                    showToast(data.message || 'Nền tảng đã được tạo thành công!', 'success');
                    nameInput.value = '';
                    iconInput.value = '';
                    renderIcon('');
                    setTimeout(() => location.reload());
                } else {
                    throw new Error(data.message || 'Có lỗi xảy ra');
                }
            } catch (error) {
                hideFullScreenLoader();
                showToast(error.message, 'error');
            } finally {
                btn.disabled = false;
            }
        });

        modal.addEventListener('hidden.bs.modal', () => {
            nameInput.value = '';
            iconInput.value = '';
            renderIcon('');
            btn.disabled = false;
        });
    });
</script>
