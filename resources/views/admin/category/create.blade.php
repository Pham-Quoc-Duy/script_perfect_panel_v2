@extends('admin.layouts.app')

@section('title', 'Thêm danh mục mới')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Thêm danh mục mới',
                    'breadcrumb' => 'Danh mục',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Thông tin danh mục</h4>
                                <p class="text-muted mb-0 mt-1">Nhập thông tin chi tiết của danh mục dịch vụ</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.category.store') }}" method="POST" id="createCategoryForm"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="platform_id" class="form-label">Nền tảng <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('platform_id') is-invalid @enderror"
                                            id="platform_id" name="platform_id" required>
                                            <option value="">Chọn nền tảng</option>
                                            @foreach ($platforms as $platform)
                                                <option value="{{ $platform->id }}"
                                                    {{ old('platform_id') == $platform->id ? 'selected' : '' }}>
                                                    {{ $platform->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('platform_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Category Name Multi-Language -->
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="form-label mb-0">Tên danh mục <span
                                                    class="text-danger">*</span></label>
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                id="createAddLanguageBtn">
                                                <i class="bx bx-plus me-1"></i>Thêm tên ngôn ngữ khác
                                            </button>
                                        </div>
                                        <small class="text-muted mb-3 d-block">
                                            Tiếng Anh là bắt buộc. Click "Thêm tên ngôn ngữ khác" để thêm tên danh mục bằng
                                            các ngôn ngữ khác.
                                            @if (config('app.debug'))
                                                <br><strong>Debug:</strong> Có {{ $languages->count() }} ngôn ngữ khả dụng
                                            @endif
                                        </small>

                                        <div id="createLanguageFields">
                                            <!-- Default English field -->
                                            <div class="language-field mb-3" data-lang="en">
                                                <div class="input-group">
                                                    <span class="input-group-text language-flag">
                                                        <img src="https://flagcdn.com/w20/us.png" alt="EN"
                                                            class="flag-icon">
                                                        <span class="ms-1">EN</span>
                                                    </span>
                                                    <input type="text"
                                                        class="form-control @error('name.en') is-invalid @enderror"
                                                        name="name[en]" id="create-name-en" required
                                                        value="{{ old('name.en') }}"
                                                        placeholder="Ví dụ: Followers, Likes, Views">
                                                    @error('name.en')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Language Selection Modal -->
                                        <div class="language-selector" id="createLanguageSelector" style="display: none;">
                                            <div class="language-selector-content">
                                                <div class="language-selector-header">
                                                    <h6 class="mb-0">Chọn ngôn ngữ để thêm</h6>
                                                    <button type="button" class="btn-close-selector"
                                                        id="createCloseLangSelector">
                                                        <i class="bx bx-x"></i>
                                                    </button>
                                                </div>
                                                <div class="language-search-container">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="createLanguageSearch" placeholder="Tìm kiếm ngôn ngữ...">
                                                </div>
                                                <div class="language-options" id="createLanguageOptions">
                                                    @foreach ($languages as $language)
                                                        <div class="language-option" data-lang="{{ $language->code }}"
                                                            data-name="{{ $language->name }}"
                                                            data-flag="{{ $language->flag }}"
                                                            data-search="{{ strtolower($language->name . ' ' . $language->code) }}">
                                                            <div class="language-option-content">
                                                                <img src="https://flagcdn.com/w20/{{ $language->flag }}.png"
                                                                    alt="{{ strtoupper($language->code) }}"
                                                                    class="flag-icon">
                                                                <div class="language-info">
                                                                    <span
                                                                        class="language-name">{{ $language->name }}</span>
                                                                    <span
                                                                        class="language-code">({{ strtoupper($language->code) }})</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="position" class="form-label">Vị trí</label>
                                                <input type="number"
                                                    class="form-control @error('position') is-invalid @enderror"
                                                    id="position" name="position" value="{{ old('position', 0) }}"
                                                    min="0" placeholder="0">
                                                <small class="text-muted">Thứ tự hiển thị (tùy chọn)</small>
                                                @error('position')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Trạng thái</label>
                                                <div class="form-check form-switch mt-2">
                                                    <input class="form-check-input @error('status') is-invalid @enderror"
                                                        type="checkbox" id="category_status" name="status"
                                                        {{ old('status', true) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="category_status">
                                                        Kích hoạt danh mục
                                                    </label>
                                                </div>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Image Upload Section -->
                                    <div class="mb-3">
                                        <label class="form-label">Hình ảnh danh mục</label>

                                        <!-- Image Type Selection -->
                                        <div class="mb-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="image_type"
                                                    id="image_type_url" value="url" checked>
                                                <label class="form-check-label" for="image_type_url">URL</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="image_type"
                                                    id="image_type_file" value="file">
                                                <label class="form-check-label" for="image_type_file">Tải lên file</label>
                                            </div>
                                        </div>

                                        <!-- URL Input -->
                                        <div id="url_input_section">
                                            <input type="url"
                                                class="form-control @error('image') is-invalid @enderror"
                                                id="category_image" name="image" value="{{ old('image') }}"
                                                placeholder="https://example.com/image.png">
                                            <small class="text-muted">Nhập URL của hình ảnh danh mục</small>
                                        </div>

                                        <!-- File Upload -->
                                        <div id="file_input_section" style="display: none;">
                                            <input type="file"
                                                class="form-control @error('image_file') is-invalid @enderror"
                                                id="category_image_file" name="image_file"
                                                accept="image/jpeg,image/png,image/jpg,image/gif">
                                            <small class="text-muted">Chọn file hình ảnh (JPEG, PNG, JPG, GIF - tối đa
                                                2MB)</small>
                                        </div>

                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @error('image_file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                                            <i class="bx bx-x me-1"></i>Hủy
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-save me-1"></i>Tạo danh mục
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Xem trước</h4>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <div id="imagePreview" style="display: none;">
                                        <img id="previewImg" src="" alt="Preview" class="img-fluid rounded"
                                            style="max-height: 200px;">
                                    </div>
                                    <div id="noImagePreview" class="text-muted">
                                        <i class="bx bx-image display-4"></i>
                                        <p>Nhập URL hình ảnh để xem trước</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Hướng dẫn</h4>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info mb-0">
                                    <h6 class="alert-heading mb-2">Lưu ý khi tạo:</h6>
                                    <ul class="mb-0 small">
                                        <li>Chọn nền tảng phù hợp</li>
                                        <li>Tên phải có cả tiếng Anh và Việt</li>
                                        <li>Hình ảnh nên có chất lượng cao</li>
                                        <li>Vị trí để sắp xếp thứ tự</li>
                                        <li>Kích hoạt khi sẵn sàng</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Utility functions
            const isValidUrl = (string) => {
                try {
                    new URL(string);
                    return true;
                } catch (_) {
                    return false;
                }
            };

            const showImagePreview = (url) => {
                if (url && isValidUrl(url)) {
                    $('#previewImg').attr('src', url).on('error', function() {
                        hideImagePreview('Không thể tải hình ảnh từ URL này');
                    });
                    $('#imagePreview').show();
                    $('#noImagePreview').hide();
                } else {
                    hideImagePreview('Nhập URL hình ảnh để xem trước');
                }
            };

            const hideImagePreview = (message = 'Nhập URL hình ảnh để xem trước') => {
                $('#imagePreview').hide();
                $('#noImagePreview').show().find('p').text(message);
            };

            // Image type switching
            $('input[name="image_type"]').on('change', function() {
                const selectedType = $(this).val();
                if (selectedType === 'url') {
                    $('#url_input_section').show();
                    $('#file_input_section').hide();
                    $('#category_image_file').val(''); // Clear file input
                    showImagePreview($('#category_image').val());
                } else {
                    $('#url_input_section').hide();
                    $('#file_input_section').show();
                    $('#category_image').val(''); // Clear URL input
                    hideImagePreview('Chọn file hình ảnh để xem trước');
                }
            });

            // Image preview functionality for URL
            $('#category_image').on('input', function() {
                showImagePreview(this.value);
            });

            // File preview functionality
            $('#category_image_file').on('change', function() {
                const file = this.files[0];
                if (file) {
                    // Validate file type
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                    if (!allowedTypes.includes(file.type)) {
                        alert('Vui lòng chọn file hình ảnh hợp lệ (JPEG, PNG, JPG, GIF)');
                        $(this).val('');
                        hideImagePreview('Chọn file hình ảnh để xem trước');
                        return;
                    }

                    // Validate file size (2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('File hình ảnh không được vượt quá 2MB');
                        $(this).val('');
                        hideImagePreview('Chọn file hình ảnh để xem trước');
                        return;
                    }

                    // Show preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImg').attr('src', e.target.result);
                        $('#imagePreview').show();
                        $('#noImagePreview').hide();
                    };
                    reader.readAsDataURL(file);
                } else {
                    hideImagePreview('Chọn file hình ảnh để xem trước');
                }
            });

            // Form validation and submission
            $('#createCategoryForm').on('submit', function(e) {
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();

                // Validate image URL if provided
                const imageUrl = $('#category_image').val();
                if (imageUrl && !isValidUrl(imageUrl)) {
                    e.preventDefault();
                    $('#category_image').addClass('is-invalid');
                    return;
                }

                // Show loading state
                submitBtn.prop('disabled', true).html(
                    '<i class="bx bx-loader-alt bx-spin me-1"></i>Đang tạo...'
                );
            });

            // Remove validation errors on input
            $('.form-control').on('input', function() {
                $(this).removeClass('is-invalid');
            });

            // Initialize preview
            showImagePreview($('#category_image').val());

            // ===== Multi-Language Functionality =====
            const getEl = id => document.getElementById(id);
            const $q = selector => document.querySelector(selector);
            const $qa = selector => document.querySelectorAll(selector);

            const initLanguageFields = () => {
                const addBtn = getEl('createAddLanguageBtn');
                const languageSelector = getEl('createLanguageSelector');
                const languageFields = getEl('createLanguageFields');
                const closeBtn = getEl('createCloseLangSelector');

                addBtn?.addEventListener('click', () => {
                    updateAvailableLanguages();
                    languageSelector.style.display = 'flex';
                    getEl('createLanguageSearch')?.focus();
                });

                closeBtn?.addEventListener('click', () => {
                    languageSelector.style.display = 'none';
                    getEl('createLanguageSearch').value = '';
                    showAllLanguageOptions();
                });

                getEl('createLanguageSearch')?.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    $qa('#createLanguageOptions .language-option').forEach(opt => {
                        const searchData = opt.dataset.search || '';
                        opt.style.display = searchData.includes(searchTerm) ? '' : 'none';
                    });
                });

                languageSelector?.addEventListener('click', (e) => {
                    const option = e.target.closest('.language-option');
                    if (!option) return;

                    const lang = option.dataset.lang;
                    const name = option.dataset.name;
                    const flag = option.dataset.flag;

                    addLanguageField(lang, name, flag);
                    languageSelector.style.display = 'none';
                    getEl('createLanguageSearch').value = '';
                    showAllLanguageOptions();
                });

                languageFields?.addEventListener('click', (e) => {
                    const removeBtn = e.target.closest('.remove-language');
                    if (removeBtn) {
                        removeBtn.closest('.language-field')?.remove();
                        updateAddButtonVisibility();
                    }
                });

                updateAddButtonVisibility();
            };

            const addLanguageField = (lang, name, flag, value = '') => {
                const languageFields = getEl('createLanguageFields');
                const placeholder = `Nhập tên danh mục bằng ${name}`;

                const fieldHtml = `
                    <div class="language-field mb-3" data-lang="${lang}">
                        <div class="input-group">
                            <span class="input-group-text language-flag">
                                <img src="https://flagcdn.com/w20/${flag}.png" alt="${lang.toUpperCase()}" class="flag-icon">
                                <span class="ms-1">${lang.toUpperCase()}</span>
                            </span>
                            <input type="text" class="form-control" name="name[${lang}]" value="${value}" placeholder="${placeholder}">
                            <button type="button" class="btn btn-outline-danger remove-language">
                                <i class="bx bx-x"></i>
                            </button>
                        </div>
                    </div>
                `;

                languageFields.insertAdjacentHTML('beforeend', fieldHtml);
                updateAvailableLanguages();
                updateAddButtonVisibility();
            };

            const updateAvailableLanguages = () => {
                const existingLangs = [];
                $qa('#createLanguageFields .language-field').forEach(field => {
                    existingLangs.push(field.dataset.lang);
                });

                let availableCount = 0;
                $qa('#createLanguageOptions .language-option').forEach(opt => {
                    const lang = opt.dataset.lang;
                    const shouldHide = existingLangs.includes(lang);
                    opt.style.display = shouldHide ? 'none' : '';
                    if (!shouldHide) availableCount++;
                });

                return availableCount;
            };

            const updateAddButtonVisibility = () => {
                const addBtn = getEl('createAddLanguageBtn');
                if (!addBtn) return;

                const allAdded = $qa('#createLanguageFields .language-field').length >= $qa('#createLanguageOptions .language-option').length;
                addBtn.disabled = allAdded;
                addBtn.innerHTML = allAdded 
                    ? '<i class="bx bx-check me-1"></i>Đã thêm tất cả ngôn ngữ'
                    : '<i class="bx bx-plus me-1"></i>Thêm tên ngôn ngữ khác';
            };

            const showAllLanguageOptions = () => {
                $qa('#createLanguageOptions .language-option').forEach(opt => opt.style.display = '');
            };

            // Initialize language fields
            initLanguageFields();
        });
    </script>

    <style>
        /* Language Fields */
        .language-field {
            position: relative
        }

        .language-flag {
            background-color: var(--bs-light);
            border-color: var(--bs-border-color);
            min-width: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .25rem
        }

        .flag-icon {
            width: 20px;
            height: auto;
            border-radius: 2px
        }

        .remove-language {
            border-left: none !important
        }

        .language-field .form-control {
            border-left: none
        }

        .language-field .form-control:focus {
            border-color: var(--bs-primary);
            box-shadow: none
        }

        .language-field .input-group:focus-within .language-flag {
            border-color: var(--bs-primary)
        }

        [data-bs-theme="dark"] .language-flag {
            background-color: #495057 !important;
            border-color: #6c757d !important;
            color: #fff !important
        }

        /* Language Modal */
        .language-selector {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 1060;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .language-selector-content {
            background: var(--bs-body-bg);
            border-radius: .5rem;
            box-shadow: 0 .5rem 2rem rgba(0, 0, 0, .2);
            width: 90%;
            max-width: 400px;
            max-height: 80vh;
            overflow: hidden;
            display: flex;
            flex-direction: column
        }

        .language-selector-header {
            padding: 1rem;
            border-bottom: 1px solid var(--bs-border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bs-light)
        }

        .language-selector-header h6 {
            margin: 0;
            color: var(--bs-body-color)
        }

        .btn-close-selector {
            background: none;
            border: none;
            color: var(--bs-secondary);
            cursor: pointer;
            padding: .25rem;
            border-radius: .25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s
        }

        .btn-close-selector:hover {
            background-color: var(--bs-danger-bg-subtle);
            color: var(--bs-danger)
        }

        .language-search-container {
            padding: 1rem;
            border-bottom: 1px solid var(--bs-border-color)
        }

        .language-options {
            flex: 1;
            overflow-y: auto;
            max-height: 300px
        }

        .language-option {
            padding: .75rem 1rem;
            cursor: pointer;
            transition: all .2s;
            border-bottom: 1px solid var(--bs-border-color-translucent)
        }

        .language-option:last-child {
            border-bottom: none
        }

        .language-option:hover {
            background: var(--bs-primary-bg-subtle)
        }

        .language-option-content {
            display: flex;
            align-items: center;
            gap: .75rem
        }

        .language-option .flag-icon {
            width: 24px;
            height: 18px;
            border-radius: .25rem;
            object-fit: cover;
            flex-shrink: 0
        }

        .language-info {
            display: flex;
            flex-direction: column;
            gap: .125rem
        }

        .language-name {
            font-weight: 500;
            color: var(--bs-body-color);
            font-size: .875rem
        }

        .language-code {
            font-size: .75rem;
            color: var(--bs-secondary)
        }

        #addLanguageBtn,
        #createAddLanguageBtn {
            font-size: .8125rem;
            padding: .375rem .75rem;
            display: inline-flex !important
        }

        .language-field .remove-language {
            border-left: 1px solid var(--bs-border-color)
        }

        .language-field .remove-language:hover {
            background: var(--bs-danger-bg-subtle);
            color: var(--bs-danger);
            border-color: var(--bs-danger)
        }

        [data-bs-theme="dark"] .language-selector-content {
            background: #2b3035 !important
        }

        [data-bs-theme="dark"] .language-selector-header {
            background: #343a40 !important;
            border-color: #495057 !important
        }

        [data-bs-theme="dark"] .language-option {
            background: transparent !important;
            color: #fff !important;
            border-color: #495057 !important
        }

        [data-bs-theme="dark"] .language-option:hover {
            background: rgba(13, 110, 253, .1) !important
        }

        [data-bs-theme="dark"] .language-name {
            color: #fff !important
        }

        [data-bs-theme="dark"] .btn-close-selector {
            color: #adb5bd !important
        }

        [data-bs-theme="dark"] .btn-close-selector:hover {
            background-color: #dc3545 !important;
            color: #fff !important
        }

        @media(max-width:768px) {
            .language-options {
                grid-template-columns: 1fr
            }

            .language-selector-content {
                padding: .75rem
            }
        }
    </style>
@endpush
