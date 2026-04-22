<!-- Modal -->
<div class="modal fade" id="modal-category" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modal-category-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-category-label">Thêm mới danh mục</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-5">
                    <div class="mb-5" data-select2-id="select2-data-5-bt20">
                        <label class="required form-label" data-lang="Social Media Platform">Nền tảng</label>
                        <!-- Sửa phần select này -->
                        <select class="form-control form-control-solid sl-platform select2-hidden-accessible"
                            name="platform_id" data-select2-id="select2-data-1-0s0w" tabindex="-1" aria-hidden="true">
                            @foreach ($plat as $platform)
                                <option value="{{ $platform->id }}" data-icon="{{ $platform->image }}">
                                    {{ $platform->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="required form-label" data-lang="">Tên</label>
                    <input type="text" class="form-control form-control-solid ipt-name">
                </div>

                <div id="div-translated-name"></div>
                @if (isset($languages) && $languages->count() > 0)
                    <a class="btn btn-secondary btn-sm px-4 py-2" href="javascript:void(0);" role="button"
                        data-bs-toggle="dropdown" data-page="/services" data-lang="Add translated name">Thêm tên ngôn
                        ngữ
                        khác</a>
                    <div class="dropdown-menu dropdown-menu-end">
                        @foreach ($languages as $lang)
                            <a href="javascript:;" class="dropdown-item ai-icon"
                                onclick="addTranslatedName('{{ $lang->code ?? '' }}')">
                                <span
                                    class="rounded-1 fi fi-{{ $lang->code === 'vi' ? 'vn' : $lang->code }} fs-4"></span>
                                <span class="ms-2">{{ $lang->name ?? '' }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif

                <div class="separator separator-dashed my-5"></div>

                <!-- Hiển thị dịch vụ dưới dạng -->
                <div class="d-flex mt-5">
                    <span class="me-10 fs-6" data-lang="">Hiển thị dịch vụ dưới dạng</span>
                    <div class="form-check form-check-custom form-check-solid me-10">
                        <input class="form-check-input h-20px w-20px" type="radio" value="0" name="display"
                            checked>
                        <label class="form-check-label">
                            <span data-lang="">Mặc định</span> <i class="fa-solid fa-list-ul"></i>
                        </label>
                    </div>
                    <div class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input h-20px w-20px" type="radio" value="1" name="display">
                        <label class="form-check-label">
                            <span data-lang="">Bảng</span> <i class="fa-solid fa-table"></i>
                        </label>
                    </div>
                </div>

                <div class="separator separator-dashed my-5"></div>

                <!-- Kích hoạt -->
                <div class="form-check form-switch form-check-custom mt-5">
                    <input class="form-check-input h-20px w-30px cb-status" type="checkbox" name="status"
                        value="1" checked>
                    <label class="form-check-label" data-lang="Active">Kích hoạt</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"
                    data-lang="button::Close">Đóng</button>
                <button type="button" class="btn btn-primary btn-sm btn-add-category">
                    <span class="btn-text">Thêm</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- CSS thích ứng light/dark (dùng biến CSS hoặc class dark) -->
<style>
    /* Ẩn nút clear vĩnh viễn */
    .select2-selection__clear {
        display: none !important;
    }

    [data-bs-theme="dark"] .modal-title,
    [data-bs-theme="dark"] .form-label,
    [data-bs-theme="dark"] .text-muted,
    [data-bs-theme="dark"] .form-check-label {
        color: #e0e0ff !important;
    }

    [data-bs-theme="dark"] .select2-dropdown {
        border-color: #444466 !important;
        color: #e0e0ff !important;
    }

    [data-bs-theme="dark"] .select2-results__option--highlighted {
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .select2-results__option[aria-selected="true"] {}
</style>

<script>
    // Format icon + text (dùng chung cho selection và result)
    function formatPlatform(item) {
        if (!item.id) return item.text;

        const icon = $(item.element).data('icon') || '';
        let prefix = '';

        if (icon.match(/^(fa|fas|fab|far)-/i)) {
            prefix = `<i class="${icon} me-2"></i>`;
        } else if (icon.match(/^https?:\/\//)) {
            prefix =
                `<img src="${icon}" alt="${item.text}" loading="lazy" class="me-2" style="width:20px;height:20px;object-fit:contain;border-radius:3px;" />`;
        }

        return $(`<span>${prefix}${item.text}</span>`);
    }

    // Helper function to show validation error with loader
    const showCategoryValidationError = (message) => {
        showFullScreenLoader('', '#modal-category');
        setTimeout(() => {
            hideFullScreenLoader();
            showToast(message, 'error');
        }, 300);
    };

    // Validation function
    const validateCategoryForm = () => {
        const platformSelect = document.querySelector('.sl-platform');
        const nameInput = document.querySelector('.ipt-name');

        // Check platform first
        if (!platformSelect.value) {
            showCategoryValidationError('Vui lòng chọn nền tảng');
            return false;
        }

        // Then check name
        if (!nameInput.value.trim()) {
            showCategoryValidationError('Vui lòng nhập tên danh mục');
            return false;
        }

        return true;
    };

    document.addEventListener('DOMContentLoaded', function() {
        const $select = $('.sl-platform').select2({
            templateResult: formatPlatform,
            templateSelection: formatPlatform,
            allowClear: false,
            minimumResultsForSearch: 0,
            width: '100%',
            escapeMarkup: function(m) {
                return m;
            },
            dropdownParent: $('#modal-category')
        });

        // Re-render khi modal mở (đảm bảo icon hiện ở phần đã chọn)
        $('#modal-category').on('shown.bs.modal', function() {
            $select.trigger('change.select2');
            // Ensure Select2 dropdown is properly positioned
            setTimeout(() => {
                $select.select2('open').select2('close');
            }, 100);
        });

        // Add category button click handler
        const btn = document.querySelector('.btn-add-category');
        const modal = document.getElementById('modal-category');

        btn.addEventListener('click', async (e) => {
            e.preventDefault();

            if (!validateCategoryForm()) return;

            showFullScreenLoader('', '#modal-category');
            btn.disabled = true;

            try {
                const platformId = document.querySelector('.sl-platform').value;
                const name = document.querySelector('.ipt-name').value.trim();
                const display = document.querySelector('input[name="display"]:checked').value;
                const status = document.querySelector('.cb-status').checked;
                const categoryId = btn.getAttribute('data-category-id');
                const mode = btn.getAttribute('data-mode') || 'add';

                // Prepare name data - collect all translated names
                const nameData = {
                    en: name
                };

                // Collect translated names
                const translatedInputs = document.querySelectorAll(
                    '#div-translated-name input.ipt-service-translated-name');
                translatedInputs.forEach(input => {
                    const langCode = input.getAttribute('data-lang');
                    const value = input.value.trim();
                    if (value) {
                        nameData[langCode] = value;
                    }
                });

                let url, method;
                if (mode === 'update' && categoryId) {
                    // Update mode
                    url = '{{ route('admin.categories.update', ':id') }}'.replace(':id',
                        categoryId);
                    method = 'PUT';
                } else {
                    // Add mode
                    url = '{{ route('admin.categories.store') }}';
                    method = 'POST';
                }

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .content
                    },
                    body: JSON.stringify({
                        platform_id: platformId,
                        name: nameData,
                        display: display,
                        status: status
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Hide loader
                    hideFullScreenLoader();

                    const successMsg = mode === 'update' ?
                        'Danh mục đã được cập nhật thành công!' :
                        'Danh mục đã được tạo thành công!';

                    // Only show toast for add mode
                    if (mode !== 'update') {
                        showToast(successMsg, 'success');
                    }

                    // Reset form
                    document.querySelector('.ipt-name').value = '';
                    document.querySelector('#div-translated-name').innerHTML = '';
                    document.querySelector('input[name="display"][value="0"]').checked = true;
                    document.querySelector('.cb-status').checked = true;
                    $select.val('').trigger('change');

                    // Clear update mode
                    btn.removeAttribute('data-category-id');
                    btn.removeAttribute('data-mode');

                    // Close modal
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }

                    // Reload page after 2 seconds
                    setTimeout(() => {
                        location.reload();
                    });
                } else {
                    throw new Error(data.message || 'Có lỗi xảy ra');
                }
            } catch (error) {
                // Hide loader and show error toast
                hideFullScreenLoader();
                showToast(error.message, 'error');
            } finally {
                btn.disabled = false;
            }
        });

        // Reset form when modal is hidden
        modal.addEventListener('hidden.bs.modal', () => {
            document.querySelector('.ipt-name').value = '';
            document.querySelector('#div-translated-name').innerHTML = '';
            document.querySelector('input[name="display"][value="0"]').checked = true;
            document.querySelector('.cb-status').checked = true;
            $select.val('').trigger('change');
            btn.disabled = false;
            // Clear update mode
            btn.removeAttribute('data-category-id');
            btn.removeAttribute('data-mode');
            // Reset modal title
            document.querySelector('#modal-category-label').textContent = 'Thêm mới danh mục';
        });
    });
</script>
