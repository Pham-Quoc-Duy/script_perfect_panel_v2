<!-- Modal chỉnh sửa service - Copy 100% từ create -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <div>
                    <h5 class="modal-title mb-0" id="editServiceModalLabel">
                        <i class="bx bx-edit me-2"></i>Chỉnh sửa dịch vụ <span id="edit-service-id-display"
                            class="text-primary"></span>
                    </h5>
                    <small class="text-muted">Cập nhật thông tin chi tiết của dịch vụ</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" id="editServiceModalBody">
                <!-- Loading state -->
                <div id="editServiceLoadingState" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Đang tải...</span>
                    </div>
                    <p class="text-muted mt-2 mb-0">Đang tải thông tin dịch vụ...</p>
                </div>

                <!-- Edit form content -->
                <div id="editServiceFormContent">
                    <div class="row g-0">
                        <!-- Main Form Column -->
                        <div class="col-lg-8 border-end">
                            <div class="p-4">
                                <form id="editServiceForm" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="edit-service-id" name="service_id">

                                    <div class="mb-3">
                                        <label for="edit-type" class="form-label">Loại dịch vụ <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="edit-type" name="type" required>
                                            <option value="">Vui lòng chọn loại dịch vụ</option>
                                            <option value="normal">Bình thường</option>
                                            <option value="api">API</option>
                                        </select>
                                        <small class="text-muted">Chọn loại dịch vụ để hiển thị các trường phù
                                            hợp</small>
                                    </div>


                                    <!-- Rate Original Field (Only for Normal type) -->
                                    <div class="mb-3" id="edit-rate-original-field" style="display: none;">
                                        <label for="edit-rate-original" class="form-label">Giá gốc <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="text" class="form-control" id="edit-rate-original"
                                                name="rate_original" placeholder="0.1000">
                                        </div>
                                        <small class="text-muted">Giá gốc từ nhà cung cấp</small>
                                    </div>

                                    <!-- API Provider Fields (Hidden by default) -->
                                    <div id="edit-api-fields" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="provider_id" class="form-label">Nhà cung cấp <span
                                                            class="text-danger">*</span></label>
                                                    <div
                                                        class="provider-select-container @error('provider_id') is-invalid @enderror">
                                                        <div class="provider-select-box" id="providerSelectBox">
                                                            <div class="selected-provider" id="selectedProvider">
                                                                <div class="selected-provider-item">
                                                                    <div class="selected-provider-icon-placeholder">
                                                                        <i class="bx bx-server"></i>
                                                                    </div>
                                                                    <div class="selected-provider-details">
                                                                        <span class="selected-provider-name"></span>
                                                                    </div>
                                                                    <button type="button" class="clear-provider"
                                                                        onclick="clearEditProvider()">
                                                                        <i class="bx bx-x"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="provider-placeholder" id="providerPlaceholder">
                                                                <span>Chọn nhà cung cấp</span>
                                                                <i class="bx bx-chevron-down"></i>
                                                            </div>
                                                        </div>

                                                        <div class="provider-dropdown" id="providerDropdown"
                                                            style="display:none;visibility:hidden;">
                                                            <div class="search-container">
                                                                <input type="text" class="search-input"
                                                                    id="providerSearch"
                                                                    placeholder="Tìm kiếm nhà cung cấp...">
                                                                <i class="bx bx-search search-icon"></i>
                                                            </div>
                                                            <div class="options-container" id="providerOptions">
                                                                @forelse($providers as $provider)
                                                                    <div class="provider-option"
                                                                        data-value="{{ $provider->id }}"
                                                                        data-name="{{ $provider->name }}"
                                                                        data-url="{{ $provider->url ?? '' }}"
                                                                        data-search="{{ strtolower($provider->name . ' ' . ($provider->url ?? '')) }}">
                                                                        <div class="provider-info">
                                                                            <div class="provider-icon-placeholder">
                                                                                <i class="bx bx-server"></i>
                                                                            </div>
                                                                            <div class="provider-details">
                                                                                <span
                                                                                    class="provider-name">{{ $provider->name }}</span>
                                                                                @if ($provider->url)
                                                                                    <small class="text-muted d-block"
                                                                                        title="{{ $provider->url }}">
                                                                                        <i
                                                                                            class="bx bx-link-external me-1"></i>{{ Str::limit($provider->url, 30) }}
                                                                                    </small>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <div class="text-center p-3 text-muted">
                                                                        <i class="bx bx-info-circle"></i>
                                                                        <p class="mb-0">Không có nhà cung cấp nào</p>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>

                                                        <!-- Hidden input for form submission -->
                                                        <input type="hidden" name="provider_id" id="provider_id"
                                                            value="{{ old('provider_id') }}">
                                                    </div>
                                                    @error('provider_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label for="edit-provider-service-id" class="form-label">Dịch vụ
                                                        <span class="text-danger">*</span></label>
                                                    <div
                                                        class="service-select-container edit-service-select-container">
                                                        <div class="service-select-box" id="editServiceSelectBox">
                                                            <div class="selected-service" id="editSelectedService"
                                                                style="display: none;">
                                                                <div class="selected-service-content">
                                                                    <span class="selected-service-text"></span>
                                                                    <i class="bx bx-chevron-down"></i>
                                                                </div>
                                                            </div>
                                                            <div class="service-placeholder"
                                                                id="editServicePlaceholder">
                                                                <span>Chọn dịch vụ</span>
                                                                <i class="bx bx-chevron-down"></i>
                                                            </div>
                                                        </div>
                                                        <div class="service-dropdown" id="editServiceDropdown"
                                                            style="display:none;visibility:hidden;">
                                                            <div class="search-container">
                                                                <input type="text" class="search-input"
                                                                    id="editServiceSearch"
                                                                    placeholder="Tìm kiếm dịch vụ...">
                                                                <i class="bx bx-search search-icon"></i>
                                                            </div>
                                                            <div class="options-container" id="editServiceOptions">
                                                            </div>
                                                            <input type="hidden" name="provider_service_id"
                                                                id="edit-provider-service-id">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Category Select -->
                                    <div class="mb-3">
                                        <label for="edit-category-id" class="form-label">Danh mục <span
                                                class="text-danger">*</span></label>
                                        <div class="category-select-container edit-category-select-container">
                                            <div class="category-select-box" id="editCategorySelectBox">
                                                <div class="selected-category" id="editSelectedCategory">
                                                    <div class="selected-category-item">
                                                        <div class="selected-category-icon-placeholder">
                                                            <i class="bx bx-category"></i>
                                                        </div>
                                                        <div class="selected-category-details">
                                                            <span class="selected-category-platform"></span>
                                                            <span class="selected-category-name"></span>
                                                        </div>
                                                        <button type="button" class="clear-category"
                                                            onclick="clearEditCategory()">
                                                            <i class="bx bx-x"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="category-placeholder" id="editCategoryPlaceholder">
                                                    <span>Chọn danh mục</span>
                                                    <i class="bx bx-chevron-down"></i>
                                                </div>
                                            </div>
                                            <div class="category-dropdown" id="editCategoryDropdown"
                                                style="display:none;visibility:hidden;">
                                                <div class="search-container">
                                                    <input type="text" class="search-input"
                                                        id="editCategorySearch" placeholder="Tìm kiếm danh mục...">
                                                    <i class="bx bx-search search-icon"></i>
                                                </div>
                                                <div class="options-container" id="editCategoryOptions"
                                                    style="max-height:200px;overflow-y:auto;">
                                                    <!-- Categories will be loaded dynamically via AJAX -->
                                                    <div class="text-center p-3">
                                                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                                                            <span class="visually-hidden">Đang tải danh mục...</span>
                                                        </div>
                                                        <p class="text-muted mt-2 mb-0 small">Đang tải danh mục...</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="category_id" id="edit-category-id" required>
                                        </div>
                                    </div>

                                    <!-- Service Name Multi-Language -->
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="form-label mb-0">Tên dịch vụ <span
                                                    class="text-danger">*</span></label>
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                id="editAddLanguageBtn">
                                                <i class="bx bx-plus me-1"></i>Thêm tên ngôn ngữ khác
                                            </button>
                                        </div>
                                        <small class="text-muted mb-3 d-block">
                                            Tiếng Anh là bắt buộc. Click "Thêm tên ngôn ngữ khác" để thêm tên dịch vụ
                                            bằng các ngôn ngữ khác.
                                            @if (config('app.debug'))
                                                <br><strong>Debug:</strong> Có {{ $languages->count() }} ngôn ngữ khả
                                                dụng
                                            @endif
                                        </small>

                                        <div id="editLanguageFields">
                                            <!-- Default English field -->
                                            <div class="language-field mb-3" data-lang="en">
                                                <div class="input-group">
                                                    <span class="input-group-text language-flag">
                                                        <img src="https://flagcdn.com/w20/us.png" alt="EN"
                                                            class="flag-icon">
                                                        <span class="ms-1">EN</span>
                                                    </span>
                                                    <input type="text" class="form-control" name="name[en]"
                                                        id="edit-name-en" required
                                                        placeholder="Ví dụ: Instagram Followers">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Language Selection Modal -->
                                        <div class="language-selector" id="editLanguageSelector"
                                            style="display: none;">
                                            <div class="language-selector-content">
                                                <div class="language-selector-header">
                                                    <h6 class="mb-0">Chọn ngôn ngữ để thêm</h6>
                                                    <button type="button" class="btn-close-selector"
                                                        id="editCloseLangSelector"><i class="bx bx-x"></i></button>
                                                </div>
                                                <div class="language-search-container">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="editLanguageSearch" placeholder="Tìm kiếm ngôn ngữ...">
                                                </div>
                                                <div class="language-options" id="editLanguageOptions">
                                                    @foreach ($languages as $language)
                                                        <div class="language-option"
                                                            data-lang="{{ $language->code }}"
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

                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label for="edit-title" class="form-label">Tiêu đề dịch vụ</label>
                                        <input type="text" class="form-control" id="edit-title" name="title"
                                            placeholder="Tiêu đề hiển thị cho dịch vụ">
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label for="edit-description" class="form-label">Mô tả</label>
                                        <div id="edit-description-editor" class="form-control"
                                            style="min-height: 150px;">
                                        </div>
                                        <input type="hidden" id="edit-description" name="description">
                                        <small class="text-muted">Mô tả chi tiết dịch vụ</small>
                                    </div>

                                    <!-- Image URL -->
                                    <div class="mb-3">
                                        <label for="edit-image" class="form-label">URL Hình ảnh</label>
                                        <input type="url" class="form-control" id="edit-image" name="image"
                                            placeholder="https://example.com/image.png">
                                        <small class="text-muted">URL của hình ảnh dịch vụ (tùy chọn)</small>
                                    </div>

                                    <!-- Service Details Row -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="edit-average-time" class="form-label">
                                                <i class="bx bx-time text-warning me-1"></i>Thời gian trung bình
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bx bx-time text-warning"></i>
                                                </span>
                                                <input type="text" class="form-control" id="edit-average-time"
                                                    name="average_time" placeholder="VD: 1h 50m 33s">
                                            </div>
                                            <small class="text-muted">Thời gian hoàn thành dự kiến</small>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="edit-type-service" class="form-label">
                                                <i class="bx bx-category text-info me-1"></i>Kiểu dịch vụ
                                            </label>
                                            <select class="form-select" id="edit-type-service" name="type_service">
                                                <option value="">Chọn kiểu dịch vụ</option>
                                                <option value="Package">Package</option>
                                                <option value="Default">Default</option>
                                                <option value="Custom Comments">Custom Comments</option>
                                                <option value="Mentions Hashtag">Mentions Hashtag</option>
                                                <option value="Special">Special</option>
                                            </select>
                                            <small class="text-muted">Loại dịch vụ từ API (tự động điền)</small>
                                        </div>
                                    </div>

                                    <!-- Attributes Multi-Select -->
                                    <div class="mb-3">
                                        <label class="form-label">Thuộc tính dịch vụ</label>
                                        <div class="multi-select-container edit-multi-select-container">
                                            <div class="multi-select-box" id="editMultiSelectBox">
                                                <div class="selected-tags" id="editSelectedTags"></div>
                                                <div class="select-placeholder" id="editSelectPlaceholder">
                                                    <span>Nhận thông tin</span>
                                                    <i class="bx bx-chevron-down"></i>
                                                </div>
                                            </div>
                                            <div class="multi-select-dropdown" id="editMultiSelectDropdown"
                                                style="display:none;visibility:hidden;">
                                                <div class="dropdown-option" data-value="owner">
                                                    <input type="checkbox" name="attributes[]" value="owner"
                                                        id="edit_attr_owner">
                                                    <label for="edit_attr_owner">Owner</label>
                                                </div>
                                                <div class="dropdown-option" data-value="exclusive">
                                                    <input type="checkbox" name="attributes[]" value="exclusive"
                                                        id="edit_attr_exclusive">
                                                    <label for="edit_attr_exclusive">Exclusive</label>
                                                </div>
                                                <div class="dropdown-option" data-value="provider_direct">
                                                    <input type="checkbox" name="attributes[]"
                                                        value="provider_direct" id="edit_attr_provider_direct">
                                                    <label for="edit_attr_provider_direct">Provider Direct</label>
                                                </div>
                                                <div class="dropdown-option" data-value="new">
                                                    <input type="checkbox" name="attributes[]" value="new"
                                                        id="edit_attr_new">
                                                    <label for="edit_attr_new">New</label>
                                                </div>
                                                <div class="dropdown-option" data-value="best_seller">
                                                    <input type="checkbox" name="attributes[]" value="best_seller"
                                                        id="edit_attr_best_seller">
                                                    <label for="edit_attr_best_seller">Best seller</label>
                                                </div>
                                                <div class="dropdown-option" data-value="promotion">
                                                    <input type="checkbox" name="attributes[]" value="promotion"
                                                        id="edit_attr_promotion">
                                                    <label for="edit_attr_promotion">Promotion</label>
                                                </div>
                                                <div class="dropdown-option" data-value="recommend">
                                                    <input type="checkbox" name="attributes[]" value="recommend"
                                                        id="edit_attr_recommend">
                                                    <label for="edit_attr_recommend">Recommend</label>
                                                </div>
                                                <div class="dropdown-option" data-value="instant">
                                                    <input type="checkbox" name="attributes[]" value="instant"
                                                        id="edit_attr_instant">
                                                    <label for="edit_attr_instant">Instant</label>
                                                </div>
                                                <div class="dropdown-option" data-value="super_fast">
                                                    <input type="checkbox" name="attributes[]" value="super_fast"
                                                        id="edit_attr_super_fast">
                                                    <label for="edit_attr_super_fast">Super Fast</label>
                                                </div>
                                                <div class="dropdown-option" data-value="real">
                                                    <input type="checkbox" name="attributes[]" value="real"
                                                        id="edit_attr_real">
                                                    <label for="edit_attr_real">Real</label>
                                                </div>
                                                <div class="dropdown-option" data-value="lifetime">
                                                    <input type="checkbox" name="attributes[]" value="lifetime"
                                                        id="edit_attr_lifetime">
                                                    <label for="edit_attr_lifetime">Lifetime</label>
                                                </div>
                                                <div class="dropdown-option" data-value="refill_7_days">
                                                    <input type="checkbox" name="attributes[]" value="refill_7_days"
                                                        id="edit_attr_refill_7_days">
                                                    <label for="edit_attr_refill_7_days">7 days Refill</label>
                                                </div>
                                                <div class="dropdown-option" data-value="refill_15_days">
                                                    <input type="checkbox" name="attributes[]" value="refill_15_days"
                                                        id="edit_attr_refill_15_days">
                                                    <label for="edit_attr_refill_15_days">15 days Refill</label>
                                                </div>
                                                <div class="dropdown-option" data-value="refill_30_days">
                                                    <input type="checkbox" name="attributes[]" value="refill_30_days"
                                                        id="edit_attr_refill_30_days">
                                                    <label for="edit_attr_refill_30_days">30 days Refill</label>
                                                </div>
                                                <div class="dropdown-option" data-value="refill_60_days">
                                                    <input type="checkbox" name="attributes[]" value="refill_60_days"
                                                        id="edit_attr_refill_60_days">
                                                    <label for="edit_attr_refill_60_days">60 days Refill</label>
                                                </div>
                                                <div class="dropdown-option" data-value="refill_90_days">
                                                    <input type="checkbox" name="attributes[]" value="refill_90_days"
                                                        id="edit_attr_refill_90_days">
                                                    <label for="edit_attr_refill_90_days">90 days Refill</label>
                                                </div>
                                                <div class="dropdown-option" data-value="refill_365_days">
                                                    <input type="checkbox" name="attributes[]"
                                                        value="refill_365_days" id="edit_attr_refill_365_days">
                                                    <label for="edit_attr_refill_365_days">365 days Refill</label>
                                                </div>
                                                <div class="dropdown-option" data-value="no_refill">
                                                    <input type="checkbox" name="attributes[]" value="no_refill"
                                                        id="edit_attr_no_refill">
                                                    <label for="edit_attr_no_refill">No refill</label>
                                                </div>
                                                <div class="dropdown-option" data-value="auto_refill">
                                                    <input type="checkbox" name="attributes[]" value="auto_refill"
                                                        id="edit_attr_auto_refill">
                                                    <label for="edit_attr_auto_refill">Auto Refill</label>
                                                </div>
                                                <div class="dropdown-option" data-value="no_refund">
                                                    <input type="checkbox" name="attributes[]" value="no_refund"
                                                        id="edit_attr_no_refund">
                                                    <label for="edit_attr_no_refund">No refund</label>
                                                </div>
                                                <div class="dropdown-option" data-value="refill_button">
                                                    <input type="checkbox" name="attributes[]" value="refill_button"
                                                        id="edit_attr_refill_button">
                                                    <label for="edit_attr_refill_button">Refill Button</label>
                                                </div>
                                                <div class="dropdown-option" data-value="cancel_button">
                                                    <input type="checkbox" name="attributes[]" value="cancel_button"
                                                        id="edit_attr_cancel_button">
                                                    <label for="edit_attr_cancel_button">Cancel Button</label>
                                                </div>
                                            </div>
                                        </div>
                                        <small class="text-muted">Chọn các thuộc tính đặc biệt cho dịch vụ (có thể chọn
                                            nhiều)</small>
                                    </div>

                                    <!-- 3 Sync Control Buttons Row -->
                                    <div class="mb-4">
                                        <h6 class="text-muted mb-3">Cài đặt đồng bộ</h6>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="edit-sync-rate" name="sync_rate">
                                                    <label class="form-check-label" for="edit-sync-rate">
                                                        <i class="bx bx-dollar-circle text-success me-1"></i><strong>Sync
                                                            Rate</strong>
                                                    </label>
                                                </div>
                                                <small class="text-muted">Đồng bộ giá từ config</small>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="edit-sync-min-max" name="sync_min_max">
                                                    <label class="form-check-label" for="edit-sync-min-max">
                                                        <i class="bx bx-sort-alt-2 text-info me-1"></i><strong>Sync
                                                            Min/Max</strong>
                                                    </label>
                                                </div>
                                                <small class="text-muted">Đồng bộ từ API</small>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="edit-sync-action" name="sync_action">
                                                    <label class="form-check-label" for="edit-sync-action">
                                                        <i class="bx bx-refresh text-warning me-1"></i><strong>Sync
                                                            Action</strong>
                                                    </label>
                                                </div>
                                                <small class="text-muted">Đồng bộ hành động</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 3 Main Sections Row -->
                                    <div class="row g-4 mb-4">
                                        <!-- Rate Section -->
                                        <div class="col-md-4">
                                            <p id="edit-api-rate-indicator" class="text-muted mb-3"
                                                style="display: none;">
                                                <i class="bx bx-dollar-circle text-success me-2"></i>
                                                <small><strong>Giá dịch vụ: <span
                                                            id="edit-api-rate-value">0</span></strong></small>
                                            </p>

                                            <div class="mb-3">
                                                <label for="edit-rate-retail" class="form-label">Giá bán lẻ</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" class="form-control" id="edit-rate-retail"
                                                        name="rate_retail" placeholder="Nhập giá hoặc bật Sync Rate">
                                                    <div class="input-group-text p-1">
                                                        <input type="number"
                                                            class="form-control border-0 text-center rate-up-field"
                                                            id="edit-rate-retail-up" name="rate_retail_up"
                                                            step="0.01" style="width: 80px; font-size: 0.875rem;"
                                                            title="Markup bán lẻ">
                                                        <span class="ms-1">%</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit-rate-agent" class="form-label">Giá đại lý</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" class="form-control" id="edit-rate-agent"
                                                        name="rate_agent" placeholder="Nhập giá">
                                                    <div class="input-group-text p-1">
                                                        <input type="number"
                                                            class="form-control border-0 text-center rate-up-field"
                                                            id="edit-rate-agent-up" name="rate_agent_up"
                                                            step="0.01" style="width: 80px; font-size: 0.875rem;"
                                                            title="Markup đại lý">
                                                        <span class="ms-1">%</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit-rate-distributor" class="form-label">Giá nhà phân
                                                    phối</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" class="form-control"
                                                        id="edit-rate-distributor" name="rate_distributor"
                                                        placeholder="Nhập giá hoặc bật Sync Rate">
                                                    <div class="input-group-text p-1">
                                                        <input type="number"
                                                            class="form-control border-0 text-center rate-up-field"
                                                            id="edit-rate-distributor-up" name="rate_distributor_up"
                                                            step="0.01" style="width: 80px; font-size: 0.875rem;"
                                                            title="Markup nhà phân phối">
                                                        <span class="ms-1">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Min/Max Section -->
                                        <div class="col-md-4">
                                            <h6 class="text-muted mb-3">
                                                <i class="bx bx-sort-alt-2 text-info me-2"></i>Giới hạn số lượng
                                            </h6>
                                            <div class="mb-3">
                                                <label for="edit-min" class="form-label">Số lượng tối thiểu</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="bx bx-down-arrow-alt text-success"></i></span>
                                                    <input type="number" class="form-control" id="edit-min"
                                                        name="min" min="1" placeholder="1">
                                                </div>
                                                <small class="text-muted">Mặc định: 1</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit-max" class="form-label">Số lượng tối đa</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="bx bx-up-arrow-alt text-danger"></i></span>
                                                    <input type="number" class="form-control" id="edit-max"
                                                        name="max" min="1" placeholder="10000">
                                                </div>
                                                <small class="text-muted">Mặc định: 10,000</small>
                                            </div>


                                        </div>

                                        <!-- Action Section -->
                                        <div class="col-md-4">
                                            <h6 class="text-muted mb-3">
                                                <i class="bx bx-refresh text-warning me-2"></i>Hành động dịch vụ
                                            </h6>
                                            <div class="mb-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="edit-refill"
                                                        name="refill">
                                                    <label class="form-check-label" for="edit-refill">
                                                        <i
                                                            class="bx bx-refresh me-1 text-success"></i><strong>Refill</strong>
                                                    </label>
                                                </div>
                                                <small class="text-muted">Hỗ trợ bù đắp khi giảm</small>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="edit-cancel"
                                                        name="cancel">
                                                    <label class="form-check-label" for="edit-cancel">
                                                        <i
                                                            class="bx bx-x-circle me-1 text-danger"></i><strong>Cancel</strong>
                                                    </label>
                                                </div>
                                                <small class="text-muted">Cho phép hủy đơn hàng</small>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="edit-dripfeed" name="dripfeed">
                                                    <label class="form-check-label" for="edit-dripfeed">
                                                        <i
                                                            class="bx bx-droplet me-1 text-info"></i><strong>Dripfeed</strong>
                                                    </label>
                                                </div>
                                                <small class="text-muted">Hỗ trợ dripfeed</small>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="edit-status"
                                                        name="status">
                                                    <label class="form-check-label" for="edit-status">
                                                        <i class="bx bx-check-circle me-1 text-primary"></i><strong>Kích
                                                            hoạt dịch vụ</strong>
                                                    </label>
                                                </div>
                                                <small class="text-muted">Cho phép sử dụng dịch vụ</small>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Sidebar Column -->
                        <div class="col-lg-4">
                            <div class="p-4">
                                <!-- Image Preview -->
                                <div class="card mb-3">
                                    <div class="card-header border-bottom py-2">
                                        <h6 class="card-title mb-0">Xem trước</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <div id="editImagePreview" style="display: none;">
                                            <img id="editPreviewImg" src="" alt="Preview"
                                                class="img-fluid rounded" style="max-height: 150px;">
                                        </div>
                                        <div id="editNoImagePreview" class="text-muted">
                                            <i class="bx bx-image display-4"></i>
                                            <p class="mb-0 small">Nhập URL hình ảnh để xem trước</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Guide -->
                                <div class="card">
                                    <div class="card-header border-bottom py-2">
                                        <h6 class="card-title mb-0">Hướng dẫn</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-info mb-0 small">
                                            <h6 class="alert-heading mb-2 small"><strong>Lưu ý khi chỉnh sửa:</strong>
                                            </h6>
                                            <ul class="mb-0 ps-3">
                                                <li>Chọn loại dịch vụ phù hợp</li>
                                                <li>Tên phải có cả tiếng Anh và Việt</li>
                                                <li>Giá cả hợp lý và cạnh tranh</li>
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
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i>Hủy
                </button>
                <button type="button" id="saveServiceBtn" class="btn btn-primary" onclick="saveService()">
                    <i class="bx bx-save me-1"></i>Lưu thay đổi
                </button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Select Components */
    .provider-select-container,
    .service-select-container,
    .category-select-container,
    .multi-select-container {
        position: relative
    }

    .provider-select-container.is-invalid .provider-select-box,
    .service-select-container.is-invalid .service-select-box,
    .category-select-container.is-invalid .category-select-box,
    .multi-select-container.is-invalid .multi-select-box {
        border-color: var(--bs-danger)
    }

    .provider-select-box,
    .service-select-box,
    .category-select-box {
        height: 38px;
        border: 1px solid var(--bs-border-color);
        border-radius: .375rem;
        background-color: var(--bs-body-bg);
        cursor: pointer;
        padding: .375rem .75rem;
        display: flex;
        align-items: center;
        transition: all .2s
    }

    .provider-select-box:hover,
    .service-select-box:hover,
    .category-select-box:hover {
        border-color: var(--bs-primary)
    }

    .provider-select-box:focus-within,
    .service-select-box:focus-within,
    .category-select-box:focus-within {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25)
    }

    .selected-provider,
    .selected-service,
    .selected-category {
        display: none;
        width: 100%
    }

    .selected-service-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        padding: 0;
    }

    .selected-service-text {
        flex: 1;
        font-size: .875rem;
        color: var(--bs-body-color);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .selected-provider-item,
    .selected-service-item,
    .selected-category-item {
        display: flex;
        align-items: center;
        gap: .5rem;
        width: 100%
    }

    .selected-provider-icon-placeholder,
    .selected-service-icon-placeholder,
    .selected-category-icon-placeholder {
        width: 20px;
        height: 20px;
        border-radius: .25rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: linear-gradient(135deg, var(--bs-info), var(--bs-primary));
        color: #fff;
        font-size: .75rem
    }

    .selected-provider-details,
    .selected-service-details,
    .selected-category-details {
        flex: 1;
        display: flex;
        align-items: center;
        gap: .5rem
    }

    .selected-provider-name,
    .selected-service-name,
    .selected-category-platform,
    .selected-service-rate,
    .selected-category-name {
        font-size: .875rem;
        color: var(--bs-body-color)
    }

    .selected-service-rate::before,
    .selected-category-name::before {
        content: " | ";
        color: var(--bs-secondary)
    }

    .clear-provider,
    .clear-service,
    .clear-category {
        background: var(--bs-light);
        border: none;
        color: var(--bs-secondary);
        cursor: pointer;
        padding: .125rem;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        transition: all .2s
    }

    .clear-provider i,
    .clear-service i,
    .clear-category i {
        font-size: .75rem
    }

    .clear-provider:hover,
    .clear-service:hover,
    .clear-category:hover {
        background: var(--bs-danger-bg-subtle);
        color: var(--bs-danger)
    }

    .provider-placeholder,
    .service-placeholder,
    .category-placeholder {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        color: var(--bs-secondary);
        font-size: .875rem
    }

    .provider-placeholder i,
    .service-placeholder i,
    .category-placeholder i {
        transition: transform .2s;
        color: var(--bs-secondary)
    }

    .provider-dropdown,
    .service-dropdown,
    .category-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color);
        border-radius: .375rem;
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
        z-index: 1050;
        max-height: 250px;
        overflow: hidden;
        display: none;
        margin-top: .25rem
    }

    .provider-dropdown.show,
    .service-dropdown.show,
    .category-dropdown.show {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        animation: fadeInDown .2s
    }

    .provider-option,
    .service-option,
    .category-option {
        padding: .5rem .75rem;
        cursor: pointer;
        transition: all .2s;
        border-bottom: 1px solid var(--bs-border-color-translucent)
    }

    .provider-option:last-child,
    .service-option:last-child,
    .category-option:last-child {
        border-bottom: none
    }

    .provider-option:hover .provider-name,
    .service-option:hover .service-name,
    .service-option:hover .service-rate,
    .category-option:hover .category-platform,
    .category-option:hover .category-name {
        color: var(--bs-primary)
    }

    .provider-info,
    .service-info,
    .category-info {
        display: flex;
        align-items: center;
        gap: .5rem
    }

    .provider-icon-placeholder,
    .service-icon-placeholder,
    .category-icon-placeholder {
        width: 24px;
        height: 24px;
        min-width: 24px;
        min-height: 24px;
        border-radius: .25rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: linear-gradient(135deg, var(--bs-info), var(--bs-primary));
        color: #fff;
        font-size: .75rem
    }

    .provider-details,
    .service-details,
    .category-details {
        flex: 1;
        display: flex;
        align-items: center;
        gap: .5rem
    }

    .provider-id,
    .service-id,
    .category-id {
        font-weight: 500;
        color: var(--bs-info);
        font-size: .75rem;
        background: var(--bs-info-bg-subtle);
        padding: .125rem .375rem;
        border-radius: .25rem
    }

    .provider-name,
    .service-name,
    .category-platform,
    .category-name {
        font-size: .875rem;
        color: var(--bs-body-color);
        transition: color .2s
    }

    .service-rate {
        font-size: .875rem;
        color: var(--bs-success);
        font-weight: 500;
        transition: color .2s
    }

    .service-rate::before,
    .category-name::before {
        content: " | ";
        color: var(--bs-secondary)
    }

    .category-icon {
        width: 24px;
        height: 24px;
        object-fit: cover;
        border: 1px solid var(--bs-border-color);
        border-radius: .25rem
    }

    .selected-category-icon {
        width: 20px;
        height: 20px;
        object-fit: cover;
        border-radius: .25rem
    }

    .selected-provider-id,
    .selected-service-id,
    .selected-category-id {
        font-weight: 500;
        color: var(--bs-info);
        font-size: .75rem;
        background: var(--bs-info-bg-subtle);
        padding: .125rem .375rem;
        border-radius: .25rem
    }

    .selected-provider-rate,
    .selected-service-rate {
        color: var(--bs-success);
        font-weight: 500
    }

    /* Dark mode */
    [data-bs-theme="dark"] .provider-select-box,[data-bs-theme="dark"] .service-select-box,[data-bs-theme="dark"] .category-select-box {
        background-color: #2b3035 !important;
        border-color: #495057 !important;
        color: #fff !important
    }

    [data-bs-theme="dark"] .provider-dropdown,[data-bs-theme="dark"] .service-dropdown,[data-bs-theme="dark"] .category-dropdown {
        background-color: #2b3035 !important;
        border-color: #495057 !important;
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .5) !important
    }

    [data-bs-theme="dark"] .provider-option,[data-bs-theme="dark"] .service-option,[data-bs-theme="dark"] .category-option {
        background-color: transparent !important;
        color: #fff !important;
        border-color: #495057 !important
    }

    [data-bs-theme="dark"] .provider-option:hover .provider-name,[data-bs-theme="dark"] .service-option:hover .service-name,[data-bs-theme="dark"] .service-option:hover .service-rate,[data-bs-theme="dark"] .category-option:hover .category-platform,[data-bs-theme="dark"] .category-option:hover .category-name {
        color: var(--bs-primary) !important
    }

    [data-bs-theme="dark"] .provider-name,[data-bs-theme="dark"] .selected-provider-name,[data-bs-theme="dark"] .service-name,[data-bs-theme="dark"] .selected-service-name,[data-bs-theme="dark"] .service-rate,[data-bs-theme="dark"] .selected-service-rate,[data-bs-theme="dark"] .category-platform,[data-bs-theme="dark"] .selected-category-platform,[data-bs-theme="dark"] .category-name,[data-bs-theme="dark"] .selected-category-name {
        color: #fff !important
    }

    [data-bs-theme="dark"] .provider-placeholder,[data-bs-theme="dark"] .service-placeholder,[data-bs-theme="dark"] .category-placeholder {
        color: #adb5bd !important
    }

    [data-bs-theme="dark"] .provider-placeholder i,[data-bs-theme="dark"] .service-placeholder i,[data-bs-theme="dark"] .category-placeholder i {
        color: #adb5bd !important
    }

    [data-bs-theme="dark"] .clear-provider,[data-bs-theme="dark"] .clear-service,[data-bs-theme="dark"] .clear-category {
        background: #495057 !important;
        color: #adb5bd !important
    }

    [data-bs-theme="dark"] .clear-provider:hover,[data-bs-theme="dark"] .clear-service:hover,[data-bs-theme="dark"] .clear-category:hover {
        background: #dc3545 !important;
        color: #fff !important
    }

    [data-bs-theme="dark"] .service-rate::before,[data-bs-theme="dark"] .category-name::before,[data-bs-theme="dark"] .selected-category-name::before {
        color: #6c757d !important
    }

    /* Search */
    .search-container {
        position: sticky;
        top: 0;
        background-color: var(--bs-body-bg);
        border-bottom: 1px solid var(--bs-border-color);
        padding: .5rem;
        z-index: 10
    }

    .search-input {
        width: 100%;
        padding: .375rem 2rem .375rem .75rem;
        border: 1px solid var(--bs-border-color);
        border-radius: .25rem;
        font-size: .875rem;
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
        outline: none
    }

    .search-input:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 .125rem rgba(13, 110, 253, .25)
    }

    .search-icon {
        position: absolute;
        right: .75rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--bs-secondary);
        pointer-events: none
    }

    [data-bs-theme="dark"] .search-container {
        background-color: #2b3035 !important;
        border-color: #495057 !important
    }

    [data-bs-theme="dark"] .search-input {
        background-color: #495057 !important;
        border-color: #6c757d !important;
        color: #fff !important
    }

    [data-bs-theme="dark"] .search-input:focus {
        border-color: var(--bs-primary) !important
    }

    [data-bs-theme="dark"] .search-input::placeholder {
        color: #adb5bd !important
    }

    [data-bs-theme="dark"] .search-icon {
        color: #adb5bd !important
    }

    /* Options */
    .options-container {
        max-height: 400px;
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none
    }

    .options-container::-webkit-scrollbar {
        display: none
    }

    /* Language */
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
    #editAddLanguageBtn {
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

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }

    /* Multi-Select */
    .multi-select-box {
        min-height: 38px;
        border: 1px solid var(--bs-border-color);
        border-radius: .375rem;
        background-color: var(--bs-body-bg);
        cursor: pointer;
        padding: .375rem .75rem;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .25rem;
        transition: all .2s
    }

    .multi-select-box:hover {
        border-color: var(--bs-primary)
    }

    .multi-select-box:focus-within {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25)
    }

    .selected-tags {
        display: flex;
        flex-wrap: wrap;
        gap: .25rem;
        flex: 1
    }

    .selected-tag {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: #fff;
        padding: .25rem .5rem;
        border-radius: 1rem;
        font-size: .8125rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: .25rem;
        transition: all .2s
    }

    .selected-tag:hover {
        transform: translateY(-1px)
    }

    .remove-tag {
        background: rgba(255, 255, 255, .2);
        border: none;
        color: #fff;
        cursor: pointer;
        padding: .125rem;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 16px;
        height: 16px;
        transition: all .2s
    }

    .remove-tag:hover {
        background: rgba(255, 255, 255, .3);
        transform: scale(1.1)
    }

    .remove-tag i {
        font-size: .625rem
    }

    .select-placeholder {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        color: var(--bs-secondary);
        font-size: .875rem
    }

    .select-placeholder i {
        transition: transform .2s;
        color: var(--bs-secondary)
    }

    .multi-select-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color);
        border-radius: .375rem;
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
        z-index: 1050;
        max-height: 250px;
        overflow-y: auto;
        display: none;
        margin-top: .25rem
    }

    .multi-select-dropdown.show {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        animation: fadeInDown .2s
    }

    .dropdown-option {
        padding: .5rem .75rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: .5rem;
        transition: all .2s;
        border-bottom: 1px solid var(--bs-border-color-translucent);
        position: relative;
        padding-left: 1rem
    }

    .dropdown-option:last-child {
        border-bottom: none
    }

    .dropdown-option:hover {
        background-color: var(--bs-primary-bg-subtle);
        transform: translateX(2px)
    }

    .dropdown-option:hover::before {
        width: 6px
    }

    .dropdown-option input[type="checkbox"] {
        width: 16px;
        height: 16px;
        margin: 0;
        cursor: pointer;
        accent-color: var(--bs-primary)
    }

    .dropdown-option label {
        margin: 0;
        cursor: pointer;
        flex: 1;
        font-size: .875rem;
        color: var(--bs-body-color)
    }

    .dropdown-option input[type="checkbox"]:checked+label {
        color: var(--bs-primary);
        font-weight: 500
    }

    .dropdown-option[data-value="owner"]::before,
    .dropdown-option[data-value="exclusive"]::before,
    .dropdown-option[data-value="provider_direct"]::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(135deg, #198754, #20c997);
        border-radius: 0 2px 2px 0
    }

    .dropdown-option[data-value="new"]::before,
    .dropdown-option[data-value="best_seller"]::before,
    .dropdown-option[data-value="promotion"]::before,
    .dropdown-option[data-value="recommend"]::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(135deg, #fd7e14, #ffc107);
        border-radius: 0 2px 2px 0
    }

    .dropdown-option[data-value="instant"]::before,
    .dropdown-option[data-value="super_fast"]::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(135deg, #dc3545, #e83e8c);
        border-radius: 0 2px 2px 0
    }

    .dropdown-option[data-value="real"]::before,
    .dropdown-option[data-value="lifetime"]::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(135deg, #6f42c1, #6610f2);
        border-radius: 0 2px 2px 0
    }

    .dropdown-option[data-value*="refill"]::before,
    .dropdown-option[data-value="no_refund"]::before,
    .dropdown-option[data-value*="button"]::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(135deg, #0dcaf0, #17a2b8);
        border-radius: 0 2px 2px 0
    }

    .selected-tag[data-type="owner"] {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%)
    }

    .selected-tag[data-type="status"] {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        color: #000
    }

    .selected-tag[data-type="speed"] {
        background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%)
    }

    .selected-tag[data-type="quality"] {
        background: linear-gradient(135deg, #6f42c1 0%, #6610f2 100%)
    }

    .selected-tag[data-type="refill"] {
        background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%)
    }

    [data-bs-theme="dark"] .multi-select-box {
        background-color: #2b3035 !important;
        border-color: #495057 !important;
        color: #fff !important
    }

    [data-bs-theme="dark"] .multi-select-dropdown {
        background-color: #2b3035 !important;
        border-color: #495057 !important
    }

    [data-bs-theme="dark"] .dropdown-option {
        background-color: transparent !important;
        color: #fff !important;
        border-color: #495057 !important
    }

    [data-bs-theme="dark"] .dropdown-option:hover {
        background-color: #3a3f44 !important
    }

    [data-bs-theme="dark"] .dropdown-option label {
        color: #fff !important
    }

    [data-bs-theme="dark"] .dropdown-option input[type="checkbox"]:checked+label {
        color: var(--bs-primary) !important
    }

    [data-bs-theme="dark"] .select-placeholder {
        color: #adb5bd !important
    }

    [data-bs-theme="dark"] .select-placeholder i {
        color: #adb5bd !important
    }

    .rate-up-field {
        min-width: 80px !important;
        text-align: center !important;
        background: transparent !important;
        border: none !important
    }

    .rate-up-field:focus {
        background: transparent !important;
        box-shadow: none !important;
        outline: none !important
    }

    .input-group-text input[type="number"] {
        background: transparent !important;
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        padding: .25rem .125rem
    }

    .input-group-text input[type="number"]::-webkit-outer-spin-button,
    .input-group-text input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0
    }

    .input-group-text input[type="number"] {
        -moz-appearance: textfield
    }

    @media(max-width:576px) {
        .selected-tag {
            font-size: .75rem;
            padding: .1875rem .375rem
        }

        .multi-select-dropdown {
            max-height: 200px
        }
    }

    /* CKEditor Styles */
    #edit-description-editor {
        border: 1px solid var(--bs-border-color);
        border-radius: .375rem;
        min-height: 150px;
    }

    #edit-description-editor .ck-editor__editable {
        min-height: 120px;
        border: none;
        border-radius: 0 0 .375rem .375rem;
    }

    #edit-description-editor .ck-toolbar {
        border-radius: .375rem .375rem 0 0;
        border-bottom: 1px solid var(--bs-border-color);
    }

    #edit-description-editor.ck-focused {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
    }

    /* Disabled input styles */
    .form-control:disabled,
    .form-control.bg-light {
        background-color: #f8f9fa !important;
        opacity: 0.7;
        cursor: not-allowed;
    }

    .form-check.opacity-50 {
        opacity: 0.5 !important;
        pointer-events: none;
    }

    .form-check.opacity-50 .form-check-label {
        cursor: not-allowed;
    }
</style>


<script>
    // Edit Service Modal - Full functionality like Create
    (function() {
        'use strict';

        // Utility functions
        const getEl = id => document.getElementById(id);
        const $q = selector => document.querySelector(selector);
        const $qa = selector => document.querySelectorAll(selector);

        // Handle service type change for edit modal
        const handleEditServiceTypeChange = () => {
            const typeSelect = getEl('edit-type');
            if (!typeSelect) return;

            typeSelect.addEventListener('change', function() {
                const selectedType = this.value;
                const rateOriginalField = getEl('edit-rate-original-field');
                const apiFields = getEl('edit-api-fields');
                
                if (selectedType === 'normal') {
                    // Show rate original field for normal type
                    if (rateOriginalField) rateOriginalField.style.display = 'block';
                    if (apiFields) apiFields.style.display = 'none';
                } else if (selectedType === 'api') {
                    // Show API fields for api type
                    if (rateOriginalField) rateOriginalField.style.display = 'none';
                    if (apiFields) apiFields.style.display = 'block';
                } else {
                    // Hide both if no type selected
                    if (rateOriginalField) rateOriginalField.style.display = 'none';
                    if (apiFields) apiFields.style.display = 'none';
                }
            });
        };

        // Handle Sync Min/Max toggle for edit modal
        const handleEditSyncMinMaxToggle = () => {
            const syncMinMaxCheckbox = getEl('edit-sync-min-max');
            if (!syncMinMaxCheckbox) return;

            syncMinMaxCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                const minInput = getEl('edit-min');
                const maxInput = getEl('edit-max');
                
                if (isChecked) {
                    // Disable min/max inputs when sync is enabled
                    if (minInput) {
                        minInput.disabled = true;
                        minInput.classList.add('bg-light');
                    }
                    if (maxInput) {
                        maxInput.disabled = true;
                        maxInput.classList.add('bg-light');
                    }
                } else {
                    // Enable min/max inputs when sync is disabled
                    if (minInput) {
                        minInput.disabled = false;
                        minInput.classList.remove('bg-light');
                    }
                    if (maxInput) {
                        maxInput.disabled = false;
                        maxInput.classList.remove('bg-light');
                    }
                }
            });
        };

        // Handle Sync Action toggle for edit modal
        const handleEditSyncActionToggle = () => {
            const syncActionCheckbox = getEl('edit-sync-action');
            if (!syncActionCheckbox) return;

            syncActionCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                const refillCheckbox = getEl('edit-refill');
                const cancelCheckbox = getEl('edit-cancel');
                const dripfeedCheckbox = getEl('edit-dripfeed');
                
                if (isChecked) {
                    // Disable action checkboxes when sync is enabled
                    if (refillCheckbox) {
                        refillCheckbox.disabled = true;
                        refillCheckbox.closest('.form-check').classList.add('opacity-50');
                    }
                    if (cancelCheckbox) {
                        cancelCheckbox.disabled = true;
                        cancelCheckbox.closest('.form-check').classList.add('opacity-50');
                    }
                    if (dripfeedCheckbox) {
                        dripfeedCheckbox.disabled = true;
                        dripfeedCheckbox.closest('.form-check').classList.add('opacity-50');
                    }
                } else {
                    // Enable action checkboxes when sync is disabled
                    if (refillCheckbox) {
                        refillCheckbox.disabled = false;
                        refillCheckbox.closest('.form-check').classList.remove('opacity-50');
                    }
                    if (cancelCheckbox) {
                        cancelCheckbox.disabled = false;
                        cancelCheckbox.closest('.form-check').classList.remove('opacity-50');
                    }
                    if (dripfeedCheckbox) {
                        dripfeedCheckbox.disabled = false;
                        dripfeedCheckbox.closest('.form-check').classList.remove('opacity-50');
                    }
                }
            });
        };

        // Format rate - remove trailing zeros
        const formatRate = (rate) => {
            if (!rate && rate !== 0) return '';
            const num = parseFloat(rate);
            if (isNaN(num)) return '';
            return parseFloat(num.toFixed(6)).toString();
        };

        // Toggle loading/content
        const toggleEditForm = (showLoading) => {
            const loadEl = getEl('editServiceLoadingState');
            const contEl = getEl('editServiceFormContent');
            if (loadEl) loadEl.style.display = showLoading ? 'block' : 'none';
            if (contEl) contEl.style.display = showLoading ? 'none' : 'block';
        };

        // Update rates from original using UP percentage
        const updateEditRatesFromOriginal = () => {
            const syncRate = getEl('edit-sync-rate');
            if (!syncRate || !syncRate.checked) return;

            const original = parseFloat(getEl('edit-rate-original')?.value) || 0;
            if (original <= 0) return;

            const types = ['retail', 'agent', 'distributor'];
            types.forEach(type => {
                const upEl = getEl(`edit-rate-${type}-up`);
                const rateEl = getEl(`edit-rate-${type}`);
                const upVal = parseFloat(upEl?.value) || 0;
                if (upVal > 0 && rateEl) {
                    rateEl.value = formatRate(original * upVal / 100);
                }
            });
        };

        // Image preview
        const updateImagePreview = (url) => {
            const preview = getEl('editImagePreview');
            const noPreview = getEl('editNoImagePreview');
            const img = getEl('editPreviewImg');

            if (url && isValidUrl(url)) {
                img.src = url;
                img.onerror = () => {
                    preview.style.display = 'none';
                    noPreview.style.display = 'block';
                };
                preview.style.display = 'block';
                noPreview.style.display = 'none';
            } else {
                preview.style.display = 'none';
                noPreview.style.display = 'block';
            }
        };

        const isValidUrl = (string) => {
            try {
                new URL(string);
                return true;
            } catch {
                return false;
            }
        };

        // Provider Select functionality
        const initEditProviderSelect = () => {
            const container = $q('.provider-select-container');
            if (!container) return;

            const selectBox = getEl('providerSelectBox');
            const dropdown = getEl('providerDropdown');
            const selectedProvider = getEl('selectedProvider');
            const placeholder = getEl('providerPlaceholder');
            const hiddenInput = getEl('provider_id');

            selectBox?.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdown.classList.toggle('show');
                placeholder.querySelector('i')?.classList.toggle('bx-chevron-up');
            });

            getEl('providerSearch')?.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                $qa('#providerOptions .provider-option').forEach(opt => {
                    const searchData = opt.dataset.search || '';
                    opt.style.display = searchData.includes(searchTerm) ? '' : 'none';
                });
            });

            dropdown?.addEventListener('click', (e) => {
                const option = e.target.closest('.provider-option');
                if (!option) return;

                const value = option.dataset.value;
                const name = option.dataset.name;
                const url = option.dataset.url;

                hiddenInput.value = value;
                updateEditSelectedProvider(value, name, url);

                dropdown.classList.remove('show');
                placeholder.querySelector('i')?.classList.remove('bx-chevron-up');
                getEl('providerSearch').value = '';
                $qa('#providerOptions .provider-option').forEach(opt => opt.style.display = '');

                // Load services from provider
                loadProviderServices(value);
            });

            document.addEventListener('click', (e) => {
                if (!container.contains(e.target)) {
                    dropdown?.classList.remove('show');
                    placeholder?.querySelector('i')?.classList.remove('bx-chevron-up');
                }
            });
        };

        const updateEditSelectedProvider = (value, name, url) => {
            const selectedProvider = getEl('selectedProvider');
            const placeholder = getEl('providerPlaceholder');

            if (value) {
                placeholder.style.display = 'none';
                selectedProvider.style.display = 'block';
                selectedProvider.innerHTML = `
                <div class="selected-provider-item">
                    <div class="provider-icon-placeholder">
                        <i class="bx bx-server"></i>
                    </div>
                    <div class="provider-details">
                        <span class="provider-name">${name}</span>
                        ${url ? `<small class="text-muted d-block"><i class="bx bx-link-external me-1"></i>${url.substring(0, 30)}</small>` : ''}
                    </div>
                    <button type="button" class="clear-provider" onclick="clearEditProvider()"><i class="bx bx-x"></i></button>
                </div>
            `;

                // Update provider_name hidden input
                updateProviderName(name);
            } else {
                selectedProvider.style.display = 'none';
                placeholder.style.display = 'flex';

                // Clear provider_name when no provider selected
                updateProviderName('');
            }
        };

        // Update provider_name helper function
        const updateProviderName = (providerName) => {
            // Find or create provider_name hidden input
            let providerNameInput = getEl('provider_name');
            if (!providerNameInput) {
                providerNameInput = document.createElement('input');
                providerNameInput.type = 'hidden';
                providerNameInput.name = 'provider_name';
                providerNameInput.id = 'provider_name';

                // Add to form
                const form = getEl('editServiceForm');
                if (form) {
                    form.appendChild(providerNameInput);
                }
            }

            providerNameInput.value = providerName || '';
        };

        // Update service_api helper function
        const updateServiceApi = (serviceApiId) => {
            // Find or create service_api hidden input
            let serviceApiInput = getEl('service_api');
            if (!serviceApiInput) {
                serviceApiInput = document.createElement('input');
                serviceApiInput.type = 'hidden';
                serviceApiInput.name = 'service_api';
                serviceApiInput.id = 'service_api';

                // Add to form
                const form = getEl('editServiceForm');
                if (form) {
                    form.appendChild(serviceApiInput);
                }
            }

            serviceApiInput.value = serviceApiId || '';
        };

        window.clearEditProvider = () => {
            getEl('provider_id').value = '';
            getEl('selectedProvider').style.display = 'none';
            getEl('providerPlaceholder').style.display = 'flex';
            getEl('editServiceOptions').innerHTML = '';
            getEl('edit-provider-service-id').value = '';
        };

        const loadProviderServices = (providerId) => {
            const optionsContainer = getEl('editServiceOptions');
            const dropdown = getEl('editServiceDropdown');
            const selectBox = getEl('editServiceSelectBox');

            // Show dropdown with loader
            dropdown.style.display = 'block';
            dropdown.style.visibility = 'visible';
            dropdown.classList.add('show');

            // Show loader
            optionsContainer.innerHTML = `
            <div class="text-center p-4">
                <div class="spinner-border text-primary mb-3" role="status" style="width: 2rem; height: 2rem;">
                    <span class="visually-hidden">Đang tải...</span>
                </div>
                <p class="text-muted mb-0">Đang tải danh sách dịch vụ...</p>
            </div>
        `;

            fetch(`/admin/services/provider/${providerId}/services`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content')
                    }
                })
                .then(r => r.json())
                .then(d => {
                    if (d.success && d.services && d.services.length > 0) {
                        optionsContainer.innerHTML = '';
                        d.services.forEach(service => {
                            const option = document.createElement('div');
                            option.className = 'service-option';
                            option.dataset.value = service.id;
                            option.dataset.name = service.name;
                            option.dataset.rate = service.rate;
                            option.dataset.min = service.min || '';
                            option.dataset.max = service.max || '';
                            option.dataset.type = service.type || '';
                            option.dataset.refill = service.refill || false;
                            option.dataset.cancel = service.cancel || false;
                            option.dataset.search = `${service.id} ${service.name}`.toLowerCase();
                            option.innerHTML = `
                        <div class="service-info">
                            <div class="service-details">
                                <span class="service-name">#${service.id} - ${service.name}</span>
                                <small class="text-muted d-block">Rate: $${service.rate}</small>
                            </div>
                        </div>
                    `;
                            option.addEventListener('click', () => selectEditService(service));
                            optionsContainer.appendChild(option);
                        });

                        // Setup search for services
                        const searchInput = getEl('editServiceSearch');
                        searchInput.value = '';
                        searchInput.addEventListener('input', function() {
                            const searchTerm = this.value.toLowerCase();
                            $qa('#editServiceOptions .service-option').forEach(opt => {
                                const searchData = opt.dataset.search || '';
                                opt.style.display = searchData.includes(searchTerm) ? '' :
                                    'none';
                            });
                        });


                    } else if (d.success && (!d.services || d.services.length === 0)) {
                        optionsContainer.innerHTML = `
                    <div class="text-center p-4 text-muted">
                        <i class="bx bx-info-circle" style="font-size: 2rem;"></i>
                        <p class="mb-0 mt-2">Không có dịch vụ nào</p>
                    </div>
                `;
                    } else {
                        optionsContainer.innerHTML = `
                    <div class="text-center p-4 text-danger">
                        <i class="bx bx-error-circle" style="font-size: 2rem;"></i>
                        <p class="mb-0 mt-2">${d.message || 'Lỗi tải dịch vụ'}</p>
                    </div>
                `;
                    }
                })
                .catch(e => {
                    console.error('Error:', e);
                    optionsContainer.innerHTML = `
                <div class="text-center p-4 text-danger">
                    <i class="bx bx-error-circle" style="font-size: 2rem;"></i>
                    <p class="mb-0 mt-2">Lỗi kết nối: ${e.message}</p>
                </div>
            `;
                });

            // Setup dropdown click handler
            selectBox?.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdown.classList.toggle('show');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                const container = $q('.edit-service-select-container');
                if (container && !container.contains(e.target)) {
                    dropdown.classList.remove('show');
                }
            });
        };

        const selectEditService = (service) => {
            const {
                id,
                name,
                rate,
                min,
                max,
                type,
                refill,
                cancel
            } = service;
            getEl('edit-provider-service-id').value = id;

            // Also update service_api hidden input
            updateServiceApi(id);

            const selectedService = getEl('editSelectedService');
            selectedService.innerHTML = `
            <div class="selected-service-content">
                <span class="selected-service-text">${id} - ${name} | Rate: $${rate}</span>
                <i class="bx bx-chevron-down"></i>
            </div>
        `;
            selectedService.style.display = 'flex';
            getEl('editServicePlaceholder').style.display = 'none';
            getEl('editServiceDropdown').style.display = 'none';
            getEl('editServiceDropdown').style.visibility = 'hidden';

            // Auto-fill form inputs from API data
            autoFillServiceData(service);
        };

        // Auto-fill service data from API
        const autoFillServiceData = (service) => {
            const {
                id,
                name,
                rate,
                min,
                max,
                type,
                refill,
                cancel
            } = service;

            // Fill service name to English input
            const nameEnEl = getEl('edit-name-en');
            if (nameEnEl && name) {
                nameEnEl.value = name;
            }

            // Fill title if empty
            const titleEl = getEl('edit-title');
            if (titleEl && name && !titleEl.value.trim()) {
                titleEl.value = name;
            }

            // Fill rate_original (API rate)
            const rateOriginalEl = getEl('edit-rate-original');
            if (rateOriginalEl) {
                rateOriginalEl.value = rate || '';

                // Show API rate indicator
                const apiRateIndicator = getEl('edit-api-rate-indicator');
                const apiRateValue = getEl('edit-api-rate-value');
                if (apiRateIndicator && apiRateValue && rate) {
                    apiRateValue.textContent = rate;
                    apiRateIndicator.style.display = 'block';
                }
            }

            // Fill min/max
            const minEl = getEl('edit-min');
            const maxEl = getEl('edit-max');
            if (minEl) minEl.value = min || '';
            if (maxEl) maxEl.value = max || '';

            // Fill type_service
            const typeServiceEl = getEl('edit-type-service');
            if (typeServiceEl && type) {
                typeServiceEl.value = type;
            }

            // Set refill checkbox
            const refillEl = getEl('edit-refill');
            if (refillEl) {
                refillEl.checked = refill === true || refill === 'true' || refill === 1;
            }

            // Set cancel checkbox
            const cancelEl = getEl('edit-cancel');
            if (cancelEl) {
                cancelEl.checked = cancel === true || cancel === 'true' || cancel === 1;
            }

            // Auto-enable sync options when selecting API service
            const syncRateEl = getEl('edit-sync-rate');
            const syncMinMaxEl = getEl('edit-sync-min-max');
            const syncActionEl = getEl('edit-sync-action');

            if (syncRateEl) {
                syncRateEl.checked = true;
                // Trigger change event to update rate fields and make them readonly
                syncRateEl.dispatchEvent(new Event('change'));
            }
            if (syncMinMaxEl) {
                syncMinMaxEl.checked = true;
            }
            if (syncActionEl) {
                syncActionEl.checked = true;
            }

            // Update rates from original after setting sync
            setTimeout(() => {
                if (typeof updateEditRatesFromOriginal === 'function') {
                    updateEditRatesFromOriginal();
                }
            }, 100);

            // Show notification
            alertify.success('Đã tự động điền thông tin từ API và bật đồng bộ');
        };

        // Load provider services and auto-select the current service
        const loadProviderServicesAndSelect = (providerId, serviceId, serviceData) => {
            const optionsContainer = getEl('editServiceOptions');
            const dropdown = getEl('editServiceDropdown');

            // Show loader
            optionsContainer.innerHTML = `
                <div class="text-center p-4">
                    <div class="spinner-border text-primary mb-3" role="status" style="width: 2rem; height: 2rem;">
                        <span class="visually-hidden">Đang tải...</span>
                    </div>
                    <p class="text-muted mb-0">Đang tải danh sách dịch vụ...</p>
                </div>
            `;

            fetch(`/admin/services/provider/${providerId}/services`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content')
                    }
                })
                .then(r => r.json())
                .then(d => {
                    if (d.success && d.services && d.services.length > 0) {
                        optionsContainer.innerHTML = '';
                        let selectedService = null;

                        d.services.forEach(service => {
                            const option = document.createElement('div');
                            option.className = 'service-option';
                            option.dataset.value = service.id;
                            option.dataset.name = service.name;
                            option.dataset.rate = service.rate;
                            option.dataset.min = service.min || '';
                            option.dataset.max = service.max || '';
                            option.dataset.type = service.type || '';
                            option.dataset.refill = service.refill || false;
                            option.dataset.cancel = service.cancel || false;
                            option.dataset.search = `${service.id} ${service.name}`.toLowerCase();
                            option.innerHTML = `
                                <div class="service-info">
                                    <div class="service-details">
                                        <span class="service-name">#${service.id} - ${service.name}</span>
                                        <small class="text-muted d-block">Rate: $${service.rate}</small>
                                    </div>
                                </div>
                            `;
                            option.addEventListener('click', () => selectEditService(service));
                            optionsContainer.appendChild(option);

                            // Check if this is the current service
                            if (service.id == serviceId) {
                                selectedService = service;
                            }
                        });

                        // Auto-select the current service if found
                        if (selectedService) {
                            selectEditService(selectedService);
                        } else {
                            // Fallback: display service info from database
                            displayServiceFromDatabase(serviceData);
                        }

                        // Setup search for services
                        const searchInput = getEl('editServiceSearch');
                        if (searchInput) {
                            searchInput.value = '';
                            searchInput.addEventListener('input', function() {
                                const searchTerm = this.value.toLowerCase();
                                $qa('#editServiceOptions .service-option').forEach(opt => {
                                    const searchData = opt.dataset.search || '';
                                    opt.style.display = searchData.includes(searchTerm) ?
                                        '' : 'none';
                                });
                            });
                        }
                    } else {
                        // No services found, display service info from database
                        displayServiceFromDatabase(serviceData);
                        optionsContainer.innerHTML = `
                            <div class="text-center p-4 text-muted">
                                <i class="bx bx-info-circle" style="font-size: 2rem;"></i>
                                <p class="mb-0 mt-2">Không có dịch vụ nào từ provider</p>
                            </div>
                        `;
                    }
                })
                .catch(e => {
                    console.error('Error loading provider services:', e);
                    // Fallback: display service info from database
                    displayServiceFromDatabase(serviceData);
                    optionsContainer.innerHTML = `
                        <div class="text-center p-4 text-danger">
                            <i class="bx bx-error-circle" style="font-size: 2rem;"></i>
                            <p class="mb-0 mt-2">Lỗi tải dịch vụ: ${e.message}</p>
                        </div>
                    `;
                });
        };

        // Display service info from database when API service not found
        const displayServiceFromDatabase = (serviceData) => {
            // Use service_api as the provider service ID if provider_service is not available
            const providerServiceId = serviceData.provider_service || serviceData.service_api;
            const providerServiceName = serviceData.provider_service_name || (serviceData.name?.en ||
                serviceData.title);
            const providerServiceRate = serviceData.provider_service_rate || serviceData.rate_original;

            if (providerServiceId && providerServiceName) {
                const selectedService = getEl('editSelectedService');
                const placeholder = getEl('editServicePlaceholder');

                selectedService.innerHTML = `
                    <div class="selected-service-content">
                        <span class="selected-service-text">#${providerServiceId} - ${providerServiceName} | Rate: $${providerServiceRate || 'N/A'}</span>
                        <i class="bx bx-chevron-down"></i>
                    </div>
                `;
                selectedService.style.display = 'flex';
                placeholder.style.display = 'none';

                // Set the hidden input - use service_api as the value
                getEl('edit-provider-service-id').value = serviceData.service_api || providerServiceId;
            }
        };

        window.clearEditService = () => {
            const selectedService = getEl('editSelectedService');
            const placeholder = getEl('editServicePlaceholder');
            const hiddenInput = getEl('edit-provider-service-id');

            if (hiddenInput) hiddenInput.value = '';
            if (selectedService) {
                selectedService.style.display = 'none';
                selectedService.innerHTML = '';
            }
            if (placeholder) placeholder.style.display = 'flex';

            // Reset sync options to default (off)
            const syncRateEl = getEl('edit-sync-rate');
            const syncMinMaxEl = getEl('edit-sync-min-max');
            const syncActionEl = getEl('edit-sync-action');

            if (syncRateEl) {
                syncRateEl.checked = false;
                // Trigger change event to make rate fields editable again
                syncRateEl.dispatchEvent(new Event('change'));
            }
            if (syncMinMaxEl) {
                syncMinMaxEl.checked = false;
            }
            if (syncActionEl) {
                syncActionEl.checked = false;
            }

            // Hide API rate indicator
            const apiRateIndicator = getEl('edit-api-rate-indicator');
            if (apiRateIndicator) {
                apiRateIndicator.style.display = 'none';
            }
        };

        // Category Select functionality
        const initEditCategorySelect = () => {
            const container = $q('.edit-category-select-container');
            if (!container) return;

            const selectBox = getEl('editCategorySelectBox');
            const dropdown = getEl('editCategoryDropdown');
            const selectedCategory = getEl('editSelectedCategory');
            const placeholder = getEl('editCategoryPlaceholder');
            const hiddenInput = getEl('edit-category-id');

            selectBox?.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdown.classList.toggle('show');
                placeholder.querySelector('i')?.classList.toggle('bx-chevron-up');
            });

            getEl('editCategorySearch')?.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                $qa('#editCategoryOptions .category-option').forEach(opt => {
                    const searchData = opt.dataset.search || '';
                    opt.style.display = searchData.includes(searchTerm) ? '' : 'none';
                });
            });

            dropdown?.addEventListener('click', (e) => {
                const option = e.target.closest('.category-option');
                if (!option) return;

                const value = option.dataset.value;
                const platform = option.dataset.platform;
                const image = option.dataset.image;
                const categoryName = option.querySelector('.category-name')?.textContent;

                hiddenInput.value = value;
                updateEditSelectedCategory(value, platform, categoryName, image);

                dropdown.classList.remove('show');
                placeholder.querySelector('i')?.classList.remove('bx-chevron-up');
                getEl('editCategorySearch').value = '';
                $qa('#editCategoryOptions .category-option').forEach(opt => opt.style.display = '');
            });

            document.addEventListener('click', (e) => {
                if (!container.contains(e.target)) {
                    dropdown?.classList.remove('show');
                    placeholder?.querySelector('i')?.classList.remove('bx-chevron-up');
                }
            });
        };

        const updateEditSelectedCategory = (value, platform, categoryName, image) => {
            const selectedCategory = getEl('editSelectedCategory');
            const placeholder = getEl('editCategoryPlaceholder');

            if (value) {
                placeholder.style.display = 'none';
                selectedCategory.style.display = 'block';
                selectedCategory.innerHTML = `
                <div class="selected-category-item">
                    ${image ? `<img src="${image}" alt="${platform}" class="selected-category-icon">` : `<div class="selected-category-icon-placeholder"><i class="bx bx-category"></i></div>`}
                    <div class="selected-category-details">
                        <span class="selected-category-platform">${platform}</span>
                        <span class="selected-category-name">${categoryName}</span>
                    </div>
                    <button type="button" class="clear-category" onclick="clearEditCategory()"><i class="bx bx-x"></i></button>
                </div>
            `;
            } else {
                selectedCategory.style.display = 'none';
                placeholder.style.display = 'flex';
            }
        };

        window.clearEditCategory = () => {
            getEl('edit-category-id').value = '';
            getEl('editSelectedCategory').style.display = 'none';
            getEl('editCategoryPlaceholder').style.display = 'flex';
        };

        // Multi-Select Attributes functionality
        const initEditAttributesDropdown = () => {
            const container = $q('.edit-multi-select-container');
            if (!container) return;

            const selectBox = getEl('editMultiSelectBox');
            const dropdown = getEl('editMultiSelectDropdown');
            const selectedTags = getEl('editSelectedTags');
            const placeholder = getEl('editSelectPlaceholder');

            selectBox?.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdown.classList.toggle('show');
                placeholder.querySelector('i')?.classList.toggle('bx-chevron-up');
            });

            dropdown?.addEventListener('change', (e) => {
                if (e.target.type === 'checkbox') updateEditSelectedTags();
            });

            selectedTags?.addEventListener('click', (e) => {
                const removeBtn = e.target.closest('.remove-tag');
                if (removeBtn) {
                    e.stopPropagation();
                    const value = removeBtn.dataset.value;
                    const checkbox = getEl(`edit_attr_${value}`);
                    if (checkbox) checkbox.checked = false;
                    updateEditSelectedTags();
                }
            });

            document.addEventListener('click', (e) => {
                if (!container.contains(e.target)) {
                    dropdown?.classList.remove('show');
                    placeholder?.querySelector('i')?.classList.remove('bx-chevron-up');
                }
            });
        };

        const getTagType = (value) => {
            const typeMap = {
                'owner': 'owner',
                'exclusive': 'owner',
                'provider_direct': 'owner',
                'new': 'status',
                'best_seller': 'status',
                'promotion': 'status',
                'recommend': 'status',
                'instant': 'speed',
                'super_fast': 'speed',
                'real': 'quality',
                'lifetime': 'quality',
                'refill_7_days': 'refill',
                'refill_15_days': 'refill',
                'refill_30_days': 'refill',
                'refill_60_days': 'refill',
                'refill_90_days': 'refill',
                'refill_365_days': 'refill',
                'no_refill': 'refill',
                'auto_refill': 'refill',
                'no_refund': 'refill',
                'refill_button': 'refill',
                'cancel_button': 'refill'
            };
            return typeMap[value] || 'default';
        };

        const updateEditSelectedTags = () => {
            const dropdown = getEl('editMultiSelectDropdown');
            const selectedTags = getEl('editSelectedTags');
            const placeholder = getEl('editSelectPlaceholder');

            const selected = [];
            dropdown?.querySelectorAll('input[type="checkbox"]:checked').forEach(cb => {
                selected.push({
                    value: cb.value,
                    label: cb.nextElementSibling?.textContent
                });
            });

            selectedTags.innerHTML = '';

            if (selected.length > 0) {
                placeholder.style.display = 'none';
                selectedTags.style.display = 'flex';
                selected.forEach(item => {
                    const tagType = getTagType(item.value);
                    selectedTags.innerHTML += `
                    <div class="selected-tag" data-type="${tagType}">
                        <span class="tag-text">${item.label}</span>
                        <button type="button" class="remove-tag" data-value="${item.value}"><i class="bx bx-x"></i></button>
                    </div>
                `;
                });
            } else {
                selectedTags.style.display = 'none';
                placeholder.style.display = 'flex';
            }
        };

        const initEditLanguageFields = () => {
            const addBtn = getEl('editAddLanguageBtn');
            const languageSelector = getEl('editLanguageSelector');
            const languageFields = getEl('editLanguageFields');
            const closeBtn = getEl('editCloseLangSelector');

            addBtn?.addEventListener('click', () => {
                updateEditAvailableLanguages();
                languageSelector.style.display = 'flex';
                getEl('editLanguageSearch')?.focus();
            });

            closeBtn?.addEventListener('click', () => {
                languageSelector.style.display = 'none';
                getEl('editLanguageSearch').value = '';
                showAllEditLanguageOptions();
            });

            getEl('editLanguageSearch')?.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                $qa('#editLanguageOptions .language-option').forEach(opt => {
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

                addEditLanguageField(lang, name, flag);
                languageSelector.style.display = 'none';
                getEl('editLanguageSearch').value = '';
                showAllEditLanguageOptions();
            });

            languageFields?.addEventListener('click', (e) => {
                const removeBtn = e.target.closest('.remove-language');
                if (removeBtn) {
                    removeBtn.closest('.language-field')?.remove();
                    updateEditAddButtonVisibility();
                }
            });

            document.addEventListener('click', (e) => {
                if (languageSelector && !languageSelector.contains(e.target) && e.target !== addBtn) {
                    languageSelector.style.display = 'none';
                    getEl('editLanguageSearch').value = '';
                    showAllEditLanguageOptions();
                }
            });
        };

        const addEditLanguageField = (lang, name, flag, value = '') => {
            const languageFields = getEl('editLanguageFields');
            const placeholder = `Nhập tên dịch vụ bằng ${name}`;

            const fieldHtml = `
            <div class="language-field mb-3" data-lang="${lang}">
                <div class="input-group">
                    <span class="input-group-text language-flag">
                        <img src="https://flagcdn.com/w20/${flag}.png" alt="${lang.toUpperCase()}" class="flag-icon">
                        <span class="ms-1">${lang.toUpperCase()}</span>
                    </span>
                    <input type="text" class="form-control" name="name[${lang}]" value="${value}" placeholder="${placeholder}" id="edit-name-${lang}">
                    ${lang !== 'en' ? '<button type="button" class="btn btn-outline-danger remove-language"><i class="bx bx-x"></i></button>' : ''}
                </div>
            </div>
        `;

            languageFields.insertAdjacentHTML('beforeend', fieldHtml);
            updateEditAddButtonVisibility();
        };

        const updateEditAvailableLanguages = () => {
            const existingLangs = [];
            $qa('#editLanguageFields .language-field').forEach(field => {
                existingLangs.push(field.dataset.lang);
            });

            let availableCount = 0;
            $qa('#editLanguageOptions .language-option').forEach(opt => {
                const lang = opt.dataset.lang;
                const shouldHide = existingLangs.includes(lang);
                opt.style.display = shouldHide ? 'none' : '';
                if (!shouldHide) availableCount++;
            });

            // Show message if no languages available
            const languageOptions = getEl('editLanguageOptions');
            let noLanguageMsg = languageOptions?.querySelector('.no-languages-message');

            if (availableCount === 0) {
                if (!noLanguageMsg) {
                    noLanguageMsg = document.createElement('div');
                    noLanguageMsg.className = 'no-languages-message text-center p-3 text-muted';
                    noLanguageMsg.innerHTML =
                        '<i class="bx bx-check-circle me-2"></i>Tất cả ngôn ngữ đã được thêm';
                    languageOptions?.appendChild(noLanguageMsg);
                }
                noLanguageMsg.style.display = 'block';
            } else {
                if (noLanguageMsg) {
                    noLanguageMsg.style.display = 'none';
                }
            }
        };

        const updateEditAddButtonVisibility = () => {
            const totalLanguages = $qa('#editLanguageOptions .language-option').length;
            const existingLanguages = $qa('#editLanguageFields .language-field').length;
            const addBtn = getEl('editAddLanguageBtn');

            if (addBtn) {
                // Always show the button
                addBtn.style.display = 'inline-block';

                // Update button text and tooltip based on available languages
                const allLanguagesAdded = totalLanguages > 0 && existingLanguages >= totalLanguages;
                const btnText = addBtn.querySelector('i').nextSibling;

                if (allLanguagesAdded) {
                    addBtn.title = 'Tất cả ngôn ngữ đã được thêm';
                    addBtn.classList.add('text-muted');
                } else {
                    addBtn.title = 'Thêm tên dịch vụ bằng ngôn ngữ khác';
                    addBtn.classList.remove('text-muted');
                }
            }
        };

        const showAllEditLanguageOptions = () => {
            $qa('#editLanguageOptions .language-option').forEach(opt => opt.style.display = '');
        };

        // Service Type handler
        const handleEditServiceType = () => {
            const type = getEl('edit-type')?.value;
            const apiFields = getEl('edit-api-fields');
            const rateOriginalField = getEl('edit-rate-original-field');

            if (apiFields) apiFields.style.display = 'none';
            if (rateOriginalField) rateOriginalField.style.display = 'none';

            if (type === 'api') {
                if (apiFields) apiFields.style.display = 'block';
                // Don't auto-show indicator here, it will be shown when service is selected
            } else if (type === 'normal') {
                if (rateOriginalField) rateOriginalField.style.display = 'block';
                // Hide indicator for normal type
                const apiIndicator = getEl('edit-api-rate-indicator');
                if (apiIndicator) apiIndicator.style.display = 'none';
            }
        };

        // Load service data
        const loadServiceData = (service) => {
            // Basic info
            getEl('edit-service-id').value = service.id;
            getEl('edit-service-id-display').textContent = '#' + service.id;
            getEl('edit-type').value = service.type || 'normal';
            getEl('edit-type-service').value = service.type_service || '';
            getEl('edit-title').value = service.title || '';
            // Set description using editor
            if (window.editDescriptionEditor) {
                window.editDescriptionEditor.setData(service.description || '');
            } else {
                // Fallback if editor not ready
                const hiddenInput = getEl('edit-description');
                if (hiddenInput) hiddenInput.value = service.description || '';
            }
            getEl('edit-image').value = service.image || '';
            getEl('edit-average-time').value = service.average_time || '';

            // Names - handle both object and JSON string
            let names = service.name;
            if (typeof names === 'string') {
                try {
                    names = JSON.parse(names);
                } catch (e) {
                    names = {};
                }
            }

            getEl('edit-name-en').value = names?.en || '';

            // Remove existing non-English language fields
            $qa('#editLanguageFields .language-field:not([data-lang="en"])').forEach(el => el.remove());

            // Add other language fields from database
            if (names && typeof names === 'object') {
                Object.keys(names).forEach(lang => {
                    if (lang !== 'en' && names[lang]) {
                        const langOption = $q(
                            `#editLanguageOptions .language-option[data-lang="${lang}"]`);
                        if (langOption) {
                            addEditLanguageField(lang, langOption.dataset.name, langOption.dataset.flag,
                                names[lang]);
                        } else {
                            // Fallback for languages not in the list (like 'vi')
                            const flagMap = {
                                'vi': 'vn',
                                'en': 'us',
                                'zh': 'cn',
                                'ja': 'jp',
                                'ko': 'kr'
                            };
                            const flag = flagMap[lang] || lang;
                            addEditLanguageField(lang, lang.toUpperCase(), flag, names[lang]);
                        }
                    }
                });
            }

            // Update add button visibility
            updateEditAddButtonVisibility();

            // Category
            getEl('edit-category-id').value = service.category_id || '';
            if (service.category_id) {
                const catOption = $q(
                    `#editCategoryOptions .category-option[data-value="${service.category_id}"]`);
                if (catOption) {
                    updateEditSelectedCategory(
                        service.category_id,
                        catOption.dataset.platform,
                        catOption.querySelector('.category-name')?.textContent,
                        catOption.dataset.image
                    );
                }
            }

            // Rates
            getEl('edit-rate-original').value = formatRate(service.rate_original);
            getEl('edit-rate-retail').value = formatRate(service.rate_retail);
            getEl('edit-rate-agent').value = formatRate(service.rate_agent);
            getEl('edit-rate-distributor').value = formatRate(service.rate_distributor);
            getEl('edit-rate-retail-up').value = service.rate_retail_up || '';
            getEl('edit-rate-agent-up').value = service.rate_agent_up || '';
            getEl('edit-rate-distributor-up').value = service.rate_distributor_up || '';

            // Min/Max
            getEl('edit-min').value = service.min || '';
            getEl('edit-max').value = service.max || '';

            // Checkboxes
            getEl('edit-status').checked = Boolean(service.status);
            getEl('edit-refill').checked = Boolean(service.refill);
            getEl('edit-cancel').checked = Boolean(service.cancel);
            getEl('edit-dripfeed').checked = Boolean(service.dripfeed);
            getEl('edit-sync-rate').checked = Boolean(service.sync_rate);
            getEl('edit-sync-min-max').checked = Boolean(service.sync_min_max);
            getEl('edit-sync-action').checked = Boolean(service.sync_action);

            // Attributes - handle both array and JSON string
            $qa('#editMultiSelectDropdown input[type="checkbox"]').forEach(cb => cb.checked = false);
            let attrs = service.attributes;
            // Parse JSON string if needed
            if (typeof attrs === 'string') {
                try {
                    attrs = JSON.parse(attrs);
                } catch (e) {
                    attrs = [];
                }
            }
            if (attrs && Array.isArray(attrs)) {
                attrs.forEach(attr => {
                    const cb = getEl(`edit_attr_${attr}`);
                    if (cb) cb.checked = true;
                });
            }
            updateEditSelectedTags();

            // Provider & Service (for API type)
            if (service.provider_id) {
                getEl('provider_id').value = service.provider_id;

                // Find and display selected provider
                const providerOption = $q(
                    `#providerOptions .provider-option[data-value="${service.provider_id}"]`);
                if (providerOption) {
                    // Use provider_name from service if available, otherwise use from option
                    const providerName = service.provider_name || providerOption.dataset.name;

                    updateEditSelectedProvider(
                        service.provider_id,
                        providerName,
                        providerOption.dataset.url
                    );

                    // Load services from provider and auto-select the current service
                    if (service.service_api || service.provider_service) {
                        const serviceApiId = service.service_api || service.provider_service;
                        loadProviderServicesAndSelect(service.provider_id, serviceApiId, service);
                    }
                }
            }
            if (service.service_api || service.provider_service) {
                const serviceApiId = service.service_api || service.provider_service;
                getEl('edit-provider-service-id').value = serviceApiId;

                // Service display is now handled by loadProviderServicesAndSelect
                if (false && service.provider_service_name && service.provider_service_rate) {
                    const selectedService = getEl('editSelectedService');
                    const placeholder = getEl('editServicePlaceholder');

                    selectedService.innerHTML = `
                    <div class="selected-service-content">

                            <span class="selected-service-text">${service.provider_service} - ${service.provider_service_name} | Rate: $${service.provider_service_rate}</span>
                            <i class="bx bx-chevron-down"></i>

                    </div>
                `;
                    selectedService.style.display = 'flex';
                    placeholder.style.display = 'none';
                }
            }

            // Handle type display
            handleEditServiceType();

            // Trigger events to update UI states
            const typeSelect = getEl('edit-type');
            if (typeSelect) typeSelect.dispatchEvent(new Event('change'));
            
            const syncMinMaxCheckbox = getEl('edit-sync-min-max');
            if (syncMinMaxCheckbox) syncMinMaxCheckbox.dispatchEvent(new Event('change'));
            
            const syncActionCheckbox = getEl('edit-sync-action');
            if (syncActionCheckbox) syncActionCheckbox.dispatchEvent(new Event('change'));

            // Image preview
            updateImagePreview(service.image);
        };

        // Open edit modal
        window.editServiceModal = function(serviceId) {
            window.currentServiceId = serviceId;
            const modal = getEl('editServiceModal');

            if (!modal) {
                alertify.error('Modal không tìm thấy');
                return;
            }

            new bootstrap.Modal(modal).show();
            toggleEditForm(true);

            // Load categories first, then load service data
            Promise.all([
                loadEditCategories(),
                fetch(`/admin/services/${serviceId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    }
                }).then(r => r.json())
            ])
            .then(([categoriesResult, serviceResult]) => {
                const s = serviceResult.success && serviceResult.service ? serviceResult.service : (serviceResult.id ? serviceResult : null);

                if (s) {
                    loadServiceData(s);
                    toggleEditForm(false);
                } else {
                    alertify.error('Không tìm thấy dữ liệu');
                }
            })
            .catch(e => {
                console.error('Error:', e);
                alertify.error('Lỗi tải dữ liệu');
                toggleEditForm(false);
            });
        };

        // Load categories for edit modal
        function loadEditCategories() {
            return fetch('/admin/services/categories', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.categories) {
                    const categoriesContainer = document.getElementById('editCategoryOptions');
                    if (categoriesContainer) {
                        categoriesContainer.innerHTML = '';
                        
                        data.categories.forEach(category => {
                            const categoryOption = document.createElement('div');
                            categoryOption.className = 'category-option';
                            categoryOption.setAttribute('data-value', category.id);
                            categoryOption.setAttribute('data-platform', category.platform_name);
                            categoryOption.setAttribute('data-image', category.image || '');
                            categoryOption.setAttribute('data-search', category.search_text);
                            
                            categoryOption.innerHTML = `
                                <div class="category-info">
                                    ${category.image ? 
                                        `<img src="${category.image}" alt="${category.platform_name}" class="category-icon">` : 
                                        `<div class="category-icon-placeholder"><i class="bx bx-category"></i></div>`
                                    }
                                    <div class="category-details">
                                        <span class="category-platform">${category.platform_name}</span>
                                        <span class="category-name">${category.name}</span>
                                    </div>
                                </div>
                            `;
                            
                            categoriesContainer.appendChild(categoryOption);
                        });
                    }
                } else {
                    const categoriesContainer = document.getElementById('editCategoryOptions');
                    if (categoriesContainer) {
                        categoriesContainer.innerHTML = `
                            <div class="text-center p-3 text-muted">
                                <i class="bx bx-info-circle"></i>
                                <p class="mb-0">Không có danh mục nào</p>
                            </div>
                        `;
                    }
                }
            })
            .catch(error => {
                console.error('Error loading categories:', error);
                const categoriesContainer = document.getElementById('editCategoryOptions');
                if (categoriesContainer) {
                    categoriesContainer.innerHTML = `
                        <div class="text-center p-3 text-danger">
                            <i class="bx bx-error-circle"></i>
                            <p class="mb-0">Lỗi khi tải danh mục</p>
                        </div>
                    `;
                }
            });
        }

        // Save service
        window.saveService = function() {
            const form = getEl('editServiceForm');
            const btn = getEl('saveServiceBtn');

            if (!form || !btn) return;

            // Sync editor data before submit
            if (window.editDescriptionEditor) {
                const hiddenInput = getEl('edit-description');
                if (hiddenInput) {
                    hiddenInput.value = window.editDescriptionEditor.getData();
                }
            }

            const orig = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Đang lưu...';

            fetch(`/admin/services/${window.currentServiceId}`, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content')
                    }
                })
                .then(r => r.json())
                .then(d => {
                    if (d.success) {
                        alertify.success(d.message || 'Cập nhật thành công!');
                        bootstrap.Modal.getInstance(getEl('editServiceModal'))?.hide();
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

        // Initialize CKEditor for description
        const initEditDescriptionEditor = () => {
            if (typeof ClassicEditor === 'undefined') {
                console.warn('CKEditor not loaded');
                return;
            }

            const editorElement = document.querySelector('#edit-description-editor');
            if (!editorElement) return;

            ClassicEditor.create(editorElement, {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', '|',
                            'bulletedList', 'numberedList', '|',
                            'link', 'blockQuote', '|',
                            'undo', 'redo'
                        ]
                    },
                    heading: {
                        options: [{
                                model: 'paragraph',
                                title: 'Paragraph',
                                class: 'ck-heading_paragraph'
                            },
                            {
                                model: 'heading1',
                                view: 'h1',
                                title: 'Heading 1',
                                class: 'ck-heading_heading1'
                            },
                            {
                                model: 'heading2',
                                view: 'h2',
                                title: 'Heading 2',
                                class: 'ck-heading_heading2'
                            },
                            {
                                model: 'heading3',
                                view: 'h3',
                                title: 'Heading 3',
                                class: 'ck-heading_heading3'
                            }
                        ]
                    }
                })
                .then(editor => {
                    window.editDescriptionEditor = editor;

                    // Update hidden input when content changes
                    editor.model.document.on('change:data', () => {
                        const hiddenInput = document.getElementById('edit-description');
                        if (hiddenInput) {
                            hiddenInput.value = editor.getData();
                        }
                    });
                })
                .catch(error => {
                    console.error('Error initializing CKEditor:', error);
                });
        };

        // Initialize on DOM ready
        document.addEventListener('DOMContentLoaded', function() {
            initEditProviderSelect();
            initEditCategorySelect();
            initEditAttributesDropdown();
            // Use universal language fields function if available, fallback to edit-specific
            if (typeof window.initUniversalLanguageFields === 'function') {
                window.initUniversalLanguageFields('edit');
            } else {
                initEditLanguageFields();
            }
            initEditServiceSelect();
            initEditDescriptionEditor();

            // Initialize add language button visibility
            updateEditAddButtonVisibility();

            // Initialize add language button visibility
            setTimeout(() => {
                updateEditAddButtonVisibility();
            }, 100);

            // Type change handler
            getEl('edit-type')?.addEventListener('change', handleEditServiceType);

            // Initialize new handlers
            handleEditServiceTypeChange();
            handleEditSyncMinMaxToggle();
            handleEditSyncActionToggle();

            // Image preview handler
            getEl('edit-image')?.addEventListener('input', function() {
                updateImagePreview(this.value);
            });

            // Rate UP handlers
            ['edit-rate-retail-up', 'edit-rate-agent-up', 'edit-rate-distributor-up'].forEach(id => {
                getEl(id)?.addEventListener('input', updateEditRatesFromOriginal);
            });

            // Rate original handler
            getEl('edit-rate-original')?.addEventListener('input', function() {
                updateEditRatesFromOriginal();

                // Hide API rate indicator when user manually changes rate
                const apiRateIndicator = getEl('edit-api-rate-indicator');
                if (apiRateIndicator) {
                    apiRateIndicator.style.display = 'none';
                }
            });

            // Sync rate handler
            getEl('edit-sync-rate')?.addEventListener('change', function() {
                const rateFields = ['edit-rate-retail', 'edit-rate-agent', 'edit-rate-distributor'];
                rateFields.forEach(id => {
                    const el = getEl(id);
                    if (el) {
                        el.readOnly = this.checked;
                        el.classList.toggle('bg-light', this.checked);
                    }
                });
                if (this.checked) updateEditRatesFromOriginal();
            });
        });

        // Initialize service select functionality
        const initEditServiceSelect = () => {
            const selectBox = getEl('editServiceSelectBox');
            const dropdown = getEl('editServiceDropdown');

            if (!selectBox || !dropdown) return;

            // Click on select box to toggle dropdown
            selectBox.addEventListener('click', function(e) {
                e.stopPropagation();

                // Only show dropdown if provider is selected and has services
                const providerId = getEl('provider_id')?.value;
                if (!providerId) {
                    alertify.warning('Vui lòng chọn nhà cung cấp trước');
                    return;
                }

                // Load services if not loaded yet
                const optionsContainer = getEl('editServiceOptions');
                if (!optionsContainer.children.length) {
                    loadProviderServices(providerId);
                } else {
                    // Toggle dropdown
                    const isVisible = dropdown.classList.contains('show');
                    if (isVisible) {
                        dropdown.classList.remove('show');
                        dropdown.style.display = 'none';
                        dropdown.style.visibility = 'hidden';
                    } else {
                        dropdown.classList.add('show');
                        dropdown.style.display = 'block';
                        dropdown.style.visibility = 'visible';
                    }
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                const container = selectBox.closest('.edit-service-select-container');
                if (container && !container.contains(e.target)) {
                    dropdown.classList.remove('show');
                    dropdown.style.display = 'none';
                    dropdown.style.visibility = 'hidden';
                }
            });
        };

        // Clear functions for edit form


        window.clearEditCategory = function() {
            const selectedCategory = document.getElementById('editSelectedCategory');
            const placeholder = document.getElementById('editCategoryPlaceholder');
            const hiddenInput = document.getElementById('edit-category-id');

            if (selectedCategory) selectedCategory.style.display = 'none';
            if (placeholder) placeholder.style.display = 'flex';
            if (hiddenInput) hiddenInput.value = '';
        };

        window.clearEditProvider = function() {
            const selectedProvider = document.getElementById('selectedProvider');
            const placeholder = document.getElementById('providerPlaceholder');
            const hiddenInput = document.getElementById('provider_id');

            if (selectedProvider) selectedProvider.style.display = 'none';
            if (placeholder) placeholder.style.display = 'flex';
            if (hiddenInput) hiddenInput.value = '';

            // Also clear service when provider is cleared
            clearEditService();
        };
    })();
</script>