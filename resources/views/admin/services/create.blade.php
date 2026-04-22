    @extends('admin.layouts.app')

    @section('title', 'Thêm dịch vụ mới')


    @section('content')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    @include('admin.components.breadcrumb', [
                        'title' => 'Thêm dịch vụ mới',
                        'breadcrumb' => 'Dịch vụ',
                    ])

                    @include('admin.components.alert')

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title mb-0">Thông tin dịch vụ</h4>
                                    <p class="text-muted mb-0 mt-1">Nhập thông tin chi tiết của dịch vụ</p>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.services.store') }}" method="POST" id="createServiceForm">
                                        @csrf
                                        <input type="hidden" id="create-service-id" name="service_id">
                                        <div class="mb-3">
                                            <label for="create-type" class="form-label">Loại dịch vụ <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="create-type" name="type" required>
                                                <option value="">Vui lòng chọn loại dịch vụ</option>
                                                <option value="normal">Bình thường</option>
                                                <option value="api">API</option>
                                            </select>
                                            <small class="text-muted">Chọn loại dịch vụ để hiển thị các trường phù
                                                hợp</small>
                                        </div>

                                        <!-- Rate Original Field (Only for Normal type) -->
                                        <div class="mb-3 rate-original-field" id="create-rate-original-field" style="display: none;">
                                            <label for="create-rate-original" class="form-label">Giá gốc <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="text"
                                                    class="form-control @error('rate_original') is-invalid @enderror"
                                                    id="create-rate-original" name="rate_original" value="{{ old('rate_original') }}"
                                                    placeholder="0.1000" oninput="updateAllRatesFromOriginal()">
                                            </div>
                                            <small class="text-muted">Giá gốc từ nhà cung cấp. Nhập giá này sẽ tự động tính toán các giá bán lẻ, đại lý và nhà phân phối dựa trên tỷ lệ markup.</small>
                                        </div>

                                        <!-- API Provider Fields (Hidden by default) -->
                                        <div id="create-create-fields" style="display: none;">
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
                                                        <label for="create-provider-service-id" class="form-label">Dịch vụ
                                                            <span class="text-danger">*</span></label>
                                                        <div class="service-select-container create-service-select-container">
                                                            <div class="service-select-box" id="createServiceSelectBox">
                                                                <div class="selected-service" id="createSelectedService"
                                                                    style="display: none;">
                                                                    <div class="selected-service-content">
                                                                        <span class="selected-service-text"></span>
                                                                        <i class="bx bx-chevron-down"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="service-placeholder" id="createServicePlaceholder">
                                                                    <span>Chọn dịch vụ</span>
                                                                    <i class="bx bx-chevron-down"></i>
                                                                </div>
                                                            </div>
                                                            <div class="service-dropdown" id="createServiceDropdown"
                                                                style="display:none;visibility:hidden;">
                                                                <div class="search-container">
                                                                    <input type="text" class="search-input"
                                                                        id="createServiceSearch"
                                                                        placeholder="Tìm kiếm dịch vụ...">
                                                                    <i class="bx bx-search search-icon"></i>
                                                                </div>
                                                                <div class="options-container" id="createServiceOptions">
                                                                </div>
                                                                <input type="hidden" name="provider_service_id"
                                                                    id="create-provider-service-id">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Category Select -->
                                        <div class="mb-3">
                                            <label for="create-category-id" class="form-label">Danh mục <span
                                                    class="text-danger">*</span></label>
                                            <div class="category-select-container create-category-select-container">
                                                <div class="category-select-box" id="createCategorySelectBox">
                                                    <div class="selected-category" id="createSelectedCategory">
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
                                                    <div class="category-placeholder" id="createCategoryPlaceholder">
                                                        <span>Chọn danh mục</span>
                                                        <i class="bx bx-chevron-down"></i>
                                                    </div>
                                                </div>
                                                <div class="category-dropdown" id="createCategoryDropdown"
                                                    style="display:none;visibility:hidden;">
                                                    <div class="search-container">
                                                        <input type="text" class="search-input" id="createCategorySearch"
                                                            placeholder="Tìm kiếm danh mục...">
                                                        <i class="bx bx-search search-icon"></i>
                                                    </div>
                                                    <div class="options-container" id="createCategoryOptions"
                                                        style="max-height:200px;overflow-y:auto;">
                                                        @foreach ($categories as $category)
                                                            <div class="category-option" data-value="{{ $category->id }}"
                                                                data-platform="{{ $category->platform->name ?? 'N/A' }}"
                                                                data-image="{{ $category->image ?? '' }}"
                                                                data-search="{{ strtolower(($category->platform->name ?? 'N/A') . ' ' . $category->getName()) }}">
                                                                <div class="category-info">
                                                                    @if ($category->image)
                                                                        <img src="{{ $category->image }}"
                                                                            alt="{{ $category->platform->name ?? 'N/A' }}"
                                                                            class="category-icon">
                                                                    @else
                                                                        <div class="category-icon-placeholder"><i
                                                                                class="bx bx-category"></i></div>
                                                                    @endif
                                                                    <div class="category-details">
                                                                        <span
                                                                            class="category-platform">{{ $category->platform->name ?? 'N/A' }}</span>
                                                                        <span
                                                                            class="category-name">{{ $category->getName() }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <input type="hidden" name="category_id" id="create-category-id" required>
                                            </div>
                                        </div>

                                        <!-- Service Name Multi-Language -->
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <label class="form-label mb-0">Tên dịch vụ <span
                                                        class="text-danger">*</span></label>
                                                <button type="button" class="btn btn-outline-primary btn-sm"
                                                    id="createAddLanguageBtn">
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

                                            <div id="createLanguageFields">
                                                <!-- Default English field -->
                                                <div class="language-field mb-3" data-lang="en">
                                                    <div class="input-group">
                                                        <span class="input-group-text language-flag">
                                                            <img src="https://flagcdn.com/w20/us.png" alt="EN"
                                                                class="flag-icon">
                                                            <span class="ms-1">EN</span>
                                                        </span>
                                                        <input type="text" class="form-control" name="name[en]"
                                                            id="create-name-en" required
                                                            placeholder="Ví dụ: Instagram Followers">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Language Selection Modal -->
                                            <div class="language-selector" id="createLanguageSelector" style="display: none;">
                                                <div class="language-selector-content">
                                                    <div class="language-selector-header">
                                                        <h6 class="mb-0">Chọn ngôn ngữ để thêm</h6>
                                                        <button type="button" class="btn-close-selector"
                                                            id="createCloseLangSelector"><i class="bx bx-x"></i></button>
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

                                        <!-- Title -->
                                        <div class="mb-3">
                                            <label for="create-title" class="form-label">Tiêu đề dịch vụ</label>
                                            <input type="text" class="form-control" id="create-title" name="title"
                                                placeholder="Tiêu đề hiển thị cho dịch vụ">
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-3">
                                            <label for="create-description" class="form-label">Mô tả</label>
                                            <div id="create-description-editor" class="form-control"
                                                style="min-height: 150px;">
                                            </div>
                                            <input type="hidden" id="create-description" name="description">
                                            <small class="text-muted">Mô tả chi tiết dịch vụ</small>
                                        </div>

                                        <!-- Image URL -->
                                        <div class="mb-3">
                                            <label for="create-image" class="form-label">URL Hình ảnh</label>
                                            <input type="url" class="form-control" id="create-image" name="image"
                                                placeholder="https://example.com/image.png">
                                            <small class="text-muted">URL của hình ảnh dịch vụ (tùy chọn)</small>
                                        </div>

                                        <!-- Service Details Row -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="create-average-time" class="form-label">
                                                    <i class="bx bx-time text-warning me-1"></i>Thời gian trung bình
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-time text-warning"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="create-average-time"
                                                        name="average_time" placeholder="VD: 1h 50m 33s">
                                                </div>
                                                <small class="text-muted">Thời gian hoàn thành dự kiến</small>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="create-type-service" class="form-label">
                                                    <i class="bx bx-category text-info me-1"></i>Kiểu dịch vụ
                                                </label>
                                                <select class="form-select" id="create-type-service" name="type_service">
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
                                            <div class="multi-select-container create-multi-select-container">
                                                <div class="multi-select-box" id="createMultiSelectBox">
                                                    <div class="selected-tags" id="createSelectedTags"></div>
                                                    <div class="select-placeholder" id="createSelectPlaceholder">
                                                        <span>Nhận thông tin</span>
                                                        <i class="bx bx-chevron-down"></i>
                                                    </div>
                                                </div>
                                                <div class="multi-select-dropdown" id="createMultiSelectDropdown"
                                                    style="display:none;visibility:hidden;">
                                                    <div class="dropdown-option" data-value="owner">
                                                        <input type="checkbox" name="attributes[]" value="owner"
                                                            id="create_attr_owner">
                                                        <label for="create_attr_owner">Owner</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="exclusive">
                                                        <input type="checkbox" name="attributes[]" value="exclusive"
                                                            id="create_attr_exclusive">
                                                        <label for="create_attr_exclusive">Exclusive</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="provider_direct">
                                                        <input type="checkbox" name="attributes[]" value="provider_direct"
                                                            id="create_attr_provider_direct">
                                                        <label for="create_attr_provider_direct">Provider Direct</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="new">
                                                        <input type="checkbox" name="attributes[]" value="new"
                                                            id="create_attr_new">
                                                        <label for="create_attr_new">New</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="best_seller">
                                                        <input type="checkbox" name="attributes[]" value="best_seller"
                                                            id="create_attr_best_seller">
                                                        <label for="create_attr_best_seller">Best seller</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="promotion">
                                                        <input type="checkbox" name="attributes[]" value="promotion"
                                                            id="create_attr_promotion">
                                                        <label for="create_attr_promotion">Promotion</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="recommend">
                                                        <input type="checkbox" name="attributes[]" value="recommend"
                                                            id="create_attr_recommend">
                                                        <label for="create_attr_recommend">Recommend</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="instant">
                                                        <input type="checkbox" name="attributes[]" value="instant"
                                                            id="create_attr_instant">
                                                        <label for="create_attr_instant">Instant</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="super_fast">
                                                        <input type="checkbox" name="attributes[]" value="super_fast"
                                                            id="create_attr_super_fast">
                                                        <label for="create_attr_super_fast">Super Fast</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="real">
                                                        <input type="checkbox" name="attributes[]" value="real"
                                                            id="create_attr_real">
                                                        <label for="create_attr_real">Real</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="lifetime">
                                                        <input type="checkbox" name="attributes[]" value="lifetime"
                                                            id="create_attr_lifetime">
                                                        <label for="create_attr_lifetime">Lifetime</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="refill_7_days">
                                                        <input type="checkbox" name="attributes[]" value="refill_7_days"
                                                            id="create_attr_refill_7_days">
                                                        <label for="create_attr_refill_7_days">7 days Refill</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="refill_15_days">
                                                        <input type="checkbox" name="attributes[]" value="refill_15_days"
                                                            id="create_attr_refill_15_days">
                                                        <label for="create_attr_refill_15_days">15 days Refill</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="refill_30_days">
                                                        <input type="checkbox" name="attributes[]" value="refill_30_days"
                                                            id="create_attr_refill_30_days">
                                                        <label for="create_attr_refill_30_days">30 days Refill</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="refill_60_days">
                                                        <input type="checkbox" name="attributes[]" value="refill_60_days"
                                                            id="create_attr_refill_60_days">
                                                        <label for="create_attr_refill_60_days">60 days Refill</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="refill_90_days">
                                                        <input type="checkbox" name="attributes[]" value="refill_90_days"
                                                            id="create_attr_refill_90_days">
                                                        <label for="create_attr_refill_90_days">90 days Refill</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="refill_365_days">
                                                        <input type="checkbox" name="attributes[]" value="refill_365_days"
                                                            id="create_attr_refill_365_days">
                                                        <label for="create_attr_refill_365_days">365 days Refill</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="no_refill">
                                                        <input type="checkbox" name="attributes[]" value="no_refill"
                                                            id="create_attr_no_refill">
                                                        <label for="create_attr_no_refill">No refill</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="auto_refill">
                                                        <input type="checkbox" name="attributes[]" value="auto_refill"
                                                            id="create_attr_auto_refill">
                                                        <label for="create_attr_auto_refill">Auto Refill</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="no_refund">
                                                        <input type="checkbox" name="attributes[]" value="no_refund"
                                                            id="create_attr_no_refund">
                                                        <label for="create_attr_no_refund">No refund</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="refill_button">
                                                        <input type="checkbox" name="attributes[]" value="refill_button"
                                                            id="create_attr_refill_button">
                                                        <label for="create_attr_refill_button">Refill Button</label>
                                                    </div>
                                                    <div class="dropdown-option" data-value="cancel_button">
                                                        <input type="checkbox" name="attributes[]" value="cancel_button"
                                                            id="create_attr_cancel_button">
                                                        <label for="create_attr_cancel_button">Cancel Button</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <small class="text-muted">Chọn các thuộc tính đặc biệt cho dịch vụ (có thể chọn
                                                nhiều)</small>
                                        </div><!-- 3 Sync Control Buttons Row -->
                                        <div class="mb-4">
                                            <h6 class="text-muted mb-3">Cài đặt đồng bộ</h6>
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="create-sync-rate"
                                                            name="sync_rate">
                                                        <label class="form-check-label" for="create-sync-rate">
                                                            <i class="bx bx-dollar-circle text-success me-1"></i><strong>Sync
                                                                Rate</strong>
                                                        </label>
                                                    </div>
                                                    <small class="text-muted">Đồng bộ giá từ config</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="create-sync-min-max" name="sync_min_max">
                                                        <label class="form-check-label" for="create-sync-min-max">
                                                            <i class="bx bx-sort-alt-2 text-info me-1"></i><strong>Sync
                                                                Min/Max</strong>
                                                        </label>
                                                    </div>
                                                    <small class="text-muted">Đồng bộ từ API</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="create-sync-action" name="sync_action">
                                                        <label class="form-check-label" for="create-sync-action">
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
                                                <p id="create-api-rate-indicator" class="text-muted mb-3"
                                                    style="display: none;">
                                                    <i class="bx bx-dollar-circle text-success me-2"></i>
                                                    <small><strong>Giá dịch vụ: <span
                                                                id="create-api-rate-value">0</span></strong></small>
                                                </p>

                                                <div class="mb-3">
                                                    <label for="create-rate-retail" class="form-label">Giá bán lẻ</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="text" class="form-control" id="create-rate-retail"
                                                            name="rate_retail" placeholder="Tự động tính từ giá gốc + markup">
                                                        <div class="input-group-text p-1">
                                                            <input type="number"
                                                                class="form-control border-0 text-center rate-up-field"
                                                                id="create-rate-retail-up" name="rate_retail_up"
                                                                step="0.01" min="0" max="1000" style="width: 80px; font-size: 0.875rem;"
                                                                title="Markup bán lẻ (0-1000%)" placeholder="{{ $markupConfig['markup_retail'] ?? '110' }}" value="{{ $markupConfig['markup_retail'] ?? '110' }}" oninput="updateRateFromUp('retail')">
                                                            <span class="ms-1">%</span>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">
                                                        <i class="bx bx-cog text-primary me-1"></i>
                                                        Markup từ config: <strong>{{ $markupConfig['markup_retail'] ?? '110' }}%</strong>. 
                                                        Thay đổi % để tự động tính lại giá.
                                                    </small>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="create-rate-agent" class="form-label">Giá đại lý</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="text" class="form-control" id="create-rate-agent"
                                                            name="rate_agent" placeholder="Tự động tính từ giá gốc + markup">
                                                        <div class="input-group-text p-1">
                                                            <input type="number"
                                                                class="form-control border-0 text-center rate-up-field"
                                                                id="create-rate-agent-up" name="rate_agent_up" step="0.01"
                                                                min="0" max="1000" style="width: 80px; font-size: 0.875rem;"
                                                                title="Markup đại lý (0-1000%)" placeholder="{{ $markupConfig['markup_agent'] ?? '108' }}" value="{{ $markupConfig['markup_agent'] ?? '108' }}" oninput="updateRateFromUp('agent')">
                                                            <span class="ms-1">%</span>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">
                                                        <i class="bx bx-cog text-primary me-1"></i>
                                                        Markup từ config: <strong>{{ $markupConfig['markup_agent'] ?? '108' }}%</strong>. 
                                                        Thay đổi % để tự động tính lại giá.
                                                    </small>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="create-rate-distributor" class="form-label">Giá nhà phân
                                                        phối</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="text" class="form-control"
                                                            id="create-rate-distributor" name="rate_distributor"
                                                            placeholder="Tự động tính từ giá gốc + markup">
                                                        <div class="input-group-text p-1">
                                                            <input type="number"
                                                                class="form-control border-0 text-center rate-up-field"
                                                                id="create-rate-distributor-up" name="rate_distributor_up"
                                                                step="0.01" min="0" max="1000" style="width: 80px; font-size: 0.875rem;"
                                                                title="Markup nhà phân phối (0-1000%)" placeholder="{{ $markupConfig['markup_distributor'] ?? '105' }}" value="{{ $markupConfig['markup_distributor'] ?? '105' }}" oninput="updateRateFromUp('distributor')">
                                                            <span class="ms-1">%</span>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">
                                                        <i class="bx bx-cog text-primary me-1"></i>
                                                        Markup từ config: <strong>{{ $markupConfig['markup_distributor'] ?? '105' }}%</strong>. 
                                                        Thay đổi % để tự động tính lại giá.
                                                    </small>
                                                </div>
                                            </div>

                                            <!-- Min/Max Section -->
                                            <div class="col-md-4">
                                                <h6 class="text-muted mb-3">
                                                    <i class="bx bx-sort-alt-2 text-info me-2"></i>Giới hạn số lượng
                                                </h6>
                                                <div class="mb-3">
                                                    <label for="create-min" class="form-label">Số lượng tối thiểu</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="bx bx-down-arrow-alt text-success"></i></span>
                                                        <input type="number" class="form-control" id="create-min"
                                                            name="min" min="1" placeholder="1">
                                                    </div>
                                                    <small class="text-muted">Mặc định: 1</small>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="create-max" class="form-label">Số lượng tối đa</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="bx bx-up-arrow-alt text-danger"></i></span>
                                                        <input type="number" class="form-control" id="create-max"
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
                                                        <input class="form-check-input" type="checkbox" id="create-refill"
                                                            name="refill">
                                                        <label class="form-check-label" for="create-refill">
                                                            <i
                                                                class="bx bx-refresh me-1 text-success"></i><strong>Refill</strong>
                                                        </label>
                                                    </div>
                                                    <small class="text-muted">Hỗ trợ bù đắp khi giảm</small>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="create-cancel"
                                                            name="cancel">
                                                        <label class="form-check-label" for="create-cancel">
                                                            <i
                                                                class="bx bx-x-circle me-1 text-danger"></i><strong>Cancel</strong>
                                                        </label>
                                                    </div>
                                                    <small class="text-muted">Cho phép hủy đơn hàng</small>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="create-dripfeed"
                                                            name="dripfeed">
                                                        <label class="form-check-label" for="create-dripfeed">
                                                            <i
                                                                class="bx bx-droplet me-1 text-info"></i><strong>Dripfeed</strong>
                                                        </label>
                                                    </div>
                                                    <small class="text-muted">Hỗ trợ dripfeed</small>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="create-status"
                                                            name="status" checked>
                                                        <label class="form-check-label" for="create-status">
                                                            <i class="bx bx-check-circle me-1 text-primary"></i><strong>Kích
                                                                hoạt dịch vụ</strong>
                                                        </label>
                                                    </div>
                                                    <small class="text-muted">Cho phép sử dụng dịch vụ</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary me-2" onclick="history.back()">
                                                <i class="bx bx-arrow-back me-1"></i>Quay lại
                                            </button>
                                            <button type="button" id="createServiceBtn" class="btn btn-primary" onclick="createService()">
                                                <i class="bx bx-plus me-1"></i>Tạo dịch vụ
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
                                            <li>Chọn loại dịch vụ phù hợp</li>
                                            <li>Tên phải có cả tiếng Anh và Việt</li>
                                            <li>Hình ảnh nên có chất lượng cao</li>
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
    @endsection

    <style>
        /* Rate Original Field */
        .rate-original-field {
            transition: all 0.3s ease;
        }
        
        .rate-original-field.show {
            display: block !important;
            opacity: 1;
        }
        
        .rate-original-field.hide {
            display: none !important;
            opacity: 0;
        }

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

        /* Create Service Button */
        #createServiceBtn {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        #createServiceBtn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }

        #createServiceBtn:disabled {
            transform: none;
            box-shadow: none;
            opacity: 0.7;
        }

        #createServiceBtn .bx-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
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
            background: #f8f9fa !important;
            border: 1px solid #e9ecef !important;
            border-radius: 4px !important;
            transition: all 0.2s ease !important;
        }

        .rate-up-field:focus {
            background: #ffffff !important;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15) !important;
            outline: none !important;
            border-color: #007bff !important;
        }

        .rate-up-field:hover {
            background: #ffffff !important;
            border-color: #007bff !important;
        }

        /* Highlight rate fields when they are auto-calculated */
        .auto-calculated {
            background-color: #e8f5e8 !important;
            border-color: #28a745 !important;
            animation: highlight 0.5s ease-in-out;
        }

        @keyframes highlight {
            0% { background-color: #fff3cd; }
            100% { background-color: #e8f5e8; }
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
        #create-description-editor {
            border: 1px solid var(--bs-border-color);
            border-radius: .375rem;
            min-height: 150px;
        }

        #create-description-editor .ck-editor__editable {
            min-height: 120px;
            border: none;
            border-radius: 0 0 .375rem .375rem;
        }

        #create-description-editor .ck-toolbar {
            border-radius: .375rem .375rem 0 0;
            border-bottom: 1px solid var(--bs-border-color);
        }

        #create-description-editor.ck-focused {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
        }
    </style>


    <script>
        // Markup configuration from server
        const markupConfig = @json($markupConfig ?? [
            'markup_retail' => 110.0,
            'markup_agent' => 108.0, 
            'markup_distributor' => 105.0
        ]);
        
        // Debug: Log markup config
        console.log('Markup Config loaded:', markupConfig);

        // Edit Service Modal - Full functionality like Create
        (function() {
            'use strict';

            // Utility functions
            const getEl = id => document.getElementById(id);
            const $q = selector => document.querySelector(selector);
            const $qa = selector => document.querySelectorAll(selector);

            // Store selected service data from API
            let selectedApiServiceData = null;

            // Format rate - remove trailing zeros
            const formatRate = (rate) => {
                if (!rate && rate !== 0) return '';
                const num = parseFloat(rate);
                if (isNaN(num)) return '';
                return parseFloat(num.toFixed(6)).toString();
            };

            // Toggle loading/content
            const toggleEditForm = (showLoading) => {
                const loadEl = getEl('createServiceLoadingState');
                const contEl = getEl('createServiceFormContent');
                if (loadEl) loadEl.style.display = showLoading ? 'block' : 'none';
                if (contEl) contEl.style.display = showLoading ? 'none' : 'block';
            };

            // Update rates from original using UP percentage
            const updateEditRatesFromOriginal = () => {
                const syncRate = getEl('create-sync-rate');
                if (!syncRate || !syncRate.checked) return;

                const original = parseFloat(getEl('create-rate-original')?.value) || 0;
                if (original <= 0) return;

                const types = ['retail', 'agent', 'distributor'];
                types.forEach(type => {
                    const upEl = getEl(`create-rate-${type}-up`);
                    const rateEl = getEl(`create-rate-${type}`);
                    const upVal = parseFloat(upEl?.value) || 0;
                    if (upVal > 0 && rateEl) {
                        rateEl.value = formatRate(original * upVal / 100);
                    }
                });
            };

            function updateRateFromUp(type) {
                // Check if service type is "normal" (bình thường)
                const serviceType = $('#create-type').val();
                if (serviceType !== 'normal') {
                    return;
                }

                const originalRate = parseFloat($('#create-rate-original').val()) || 0;
                const upValue = parseFloat($('#create-rate-' + type + '-up').val()) || 0;
                const rateField = $('#create-rate-' + type);

                if (originalRate > 0 && upValue > 0) {
                    // Calculate: rate_original * rate_up / 100
                    // Example: rate_original = 0.1, rate_up = 110 => rate = 0.1 * 110 / 100 = 0.11
                    const finalRate = (originalRate * upValue / 100).toFixed(6);
                    rateField.val(formatRate(finalRate));
                    
                    // Add highlight effect
                    rateField.addClass('auto-calculated');
                    setTimeout(() => {
                        rateField.removeClass('auto-calculated');
                    }, 1000);
                } else if (upValue === 0) {
                    // Clear the rate field if rate_up is 0
                    rateField.val('');
                    rateField.removeClass('auto-calculated');
                }
            }

            function updateAllRatesFromOriginal() {
                // Check if service type is "normal" (bình thường)
                const serviceType = $('#create-type').val();
                if (serviceType !== 'normal') {
                    return;
                }

                const originalRate = parseFloat($('#create-rate-original').val()) || 0;

                if (originalRate > 0) {
                    // Auto-populate default rate_up values from config if they are empty
                    const retailUpEl = $('#create-rate-retail-up');
                    const agentUpEl = $('#create-rate-agent-up');
                    const distributorUpEl = $('#create-rate-distributor-up');

                    // Set markup percentages from config if empty (values already set in HTML)
                    // Only set if the field is completely empty (no value attribute)
                    if (!retailUpEl.val() && !retailUpEl.attr('value')) {
                        retailUpEl.val(markupConfig.markup_retail || '110');
                    }
                    if (!agentUpEl.val() && !agentUpEl.attr('value')) {
                        agentUpEl.val(markupConfig.markup_agent || '108');
                    }
                    if (!distributorUpEl.val() && !distributorUpEl.attr('value')) {
                        agentUpEl.val(markupConfig.markup_distributor || '105');
                    }

                    const retailUp = parseFloat(retailUpEl.val()) || 0;
                    const agentUp = parseFloat(agentUpEl.val()) || 0;
                    const distributorUp = parseFloat(distributorUpEl.val()) || 0;

                    // Calculate and highlight: rate_original * rate_up / 100
                    if (retailUp > 0) {
                        const retailRate = (originalRate * retailUp / 100).toFixed(6);
                        const retailField = $('#create-rate-retail');
                        retailField.val(formatRate(retailRate));
                        retailField.addClass('auto-calculated');
                        setTimeout(() => retailField.removeClass('auto-calculated'), 1000);
                    }
                    if (agentUp > 0) {
                        const agentRate = (originalRate * agentUp / 100).toFixed(6);
                        const agentField = $('#create-rate-agent');
                        agentField.val(formatRate(agentRate));
                        agentField.addClass('auto-calculated');
                        setTimeout(() => agentField.removeClass('auto-calculated'), 1000);
                    }
                    if (distributorUp > 0) {
                        const distributorRate = (originalRate * distributorUp / 100).toFixed(6);
                        const distributorField = $('#create-rate-distributor');
                        distributorField.val(formatRate(distributorRate));
                        distributorField.addClass('auto-calculated');
                        setTimeout(() => distributorField.removeClass('auto-calculated'), 1000);
                    }
                } else {
                    // Clear all rate fields if original rate is empty
                    const rateFields = ['#create-rate-retail', '#create-rate-agent', '#create-rate-distributor'];
                    rateFields.forEach(fieldId => {
                        $(fieldId).val('').removeClass('auto-calculated');
                    });
                }
            }

            // Image preview
            const updateImagePreview = (url) => {
                const preview = getEl('createImagePreview');
                const noPreview = getEl('createNoImagePreview');
                const img = getEl('createPreviewImg');

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
                    const form = getEl('createServiceForm');
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
                    const form = getEl('createServiceForm');
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
                getEl('createServiceOptions').innerHTML = '';
                getEl('create-provider-service-id').value = '';
            };

            const loadProviderServices = (providerId) => {
                const optionsContainer = getEl('createServiceOptions');
                const dropdown = getEl('createServiceDropdown');
                const selectBox = getEl('createServiceSelectBox');

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
                                    <small class="text-muted d-block"> $${service.rate}</small>
                                </div>
                            </div>
                        `;
                                option.addEventListener('click', () => selectEditService(service));
                                optionsContainer.appendChild(option);
                            });

                            // Setup search for services
                            const searchInput = getEl('createServiceSearch');
                            searchInput.value = '';
                            searchInput.addEventListener('input', function() {
                                const searchTerm = this.value.toLowerCase();
                                $qa('#createServiceOptions .service-option').forEach(opt => {
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
                    const container = $q('.create-service-select-container');
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
                
                // Store service data for sync functionality
                selectedApiServiceData = service;
                
                getEl('create-provider-service-id').value = id;

                // Also update service_api hidden input
                updateServiceApi(id);

                const selectedService = getEl('createSelectedService');
                selectedService.innerHTML = `
                <div class="selected-service-content">
                    <span class="selected-service-text">
                        <i class="bx bx-check-circle text-success me-1"></i>
                        ${id} - ${name} | $${rate}
                    </span>
                    <i class="bx bx-chevron-down"></i>
                </div>
            `;
                selectedService.style.display = 'flex';
                getEl('createServicePlaceholder').style.display = 'none';
                getEl('createServiceDropdown').style.display = 'none';
                getEl('createServiceDropdown').style.visibility = 'hidden';

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
                const nameEnEl = getEl('create-name-en');
                if (nameEnEl && name) {
                    nameEnEl.value = name;
                }

                // Fill title if empty
                const titleEl = getEl('create-title');
                if (titleEl && name && !titleEl.value.trim()) {
                    titleEl.value = name;
                }

                // Fill rate_original (API rate) and calculate other rates
                const rateOriginalEl = getEl('create-rate-original');
                if (rateOriginalEl && rate) {
                    rateOriginalEl.value = rate;

                    // Show API rate indicator
                    const apiRateIndicator = getEl('create-api-rate-indicator');
                    const apiRateValue = getEl('create-api-rate-value');
                    if (apiRateIndicator && apiRateValue) {
                        apiRateValue.textContent = rate;
                        apiRateIndicator.style.display = 'block';
                    }

                    // Auto-populate rate_up values from config
                    const retailUpEl = getEl('create-rate-retail-up');
                    const agentUpEl = getEl('create-rate-agent-up');
                    const distributorUpEl = getEl('create-rate-distributor-up');

                    // Values are already set in HTML from config, only set if completely empty
                    if (retailUpEl && !retailUpEl.value && !retailUpEl.getAttribute('value')) {
                        retailUpEl.value = markupConfig.markup_retail || '110';
                    }
                    if (agentUpEl && !agentUpEl.value && !agentUpEl.getAttribute('value')) {
                        agentUpEl.value = markupConfig.markup_agent || '108';
                    }
                    if (distributorUpEl && !distributorUpEl.value && !distributorUpEl.getAttribute('value')) {
                        distributorUpEl.value = markupConfig.markup_distributor || '105';
                    }

                    // Calculate rates automatically
                    const originalRate = parseFloat(rate);
                    if (originalRate > 0) {
                        const retailUp = parseFloat(retailUpEl?.value) || 0;
                        const agentUp = parseFloat(agentUpEl?.value) || 0;
                        const distributorUp = parseFloat(distributorUpEl?.value) || 0;

                        // Calculate: rate_original * rate_up / 100
                        if (retailUp > 0) {
                            const retailRate = (originalRate * retailUp / 100).toFixed(6);
                            const retailField = getEl('create-rate-retail');
                            if (retailField) {
                                retailField.value = formatRate(retailRate);
                                retailField.classList.add('auto-calculated');
                                setTimeout(() => retailField.classList.remove('auto-calculated'), 1000);
                            }
                        }
                        if (agentUp > 0) {
                            const agentRate = (originalRate * agentUp / 100).toFixed(6);
                            const agentField = getEl('create-rate-agent');
                            if (agentField) {
                                agentField.value = formatRate(agentRate);
                                agentField.classList.add('auto-calculated');
                                setTimeout(() => agentField.classList.remove('auto-calculated'), 1000);
                            }
                        }
                        if (distributorUp > 0) {
                            const distributorRate = (originalRate * distributorUp / 100).toFixed(6);
                            const distributorField = getEl('create-rate-distributor');
                            if (distributorField) {
                                distributorField.value = formatRate(distributorRate);
                                distributorField.classList.add('auto-calculated');
                                setTimeout(() => distributorField.classList.remove('auto-calculated'), 1000);
                            }
                        }
                    }
                }

                // Fill min/max
                const minEl = getEl('create-min');
                const maxEl = getEl('create-max');
                if (minEl) minEl.value = min || '';
                if (maxEl) maxEl.value = max || '';

                // Fill type_service
                const typeServiceEl = getEl('create-type-service');
                if (typeServiceEl && type) {
                    typeServiceEl.value = type;
                }

                // Set refill checkbox
                const refillEl = getEl('create-refill');
                if (refillEl) {
                    refillEl.checked = refill === true || refill === 'true' || refill === 1;
                }

                // Set cancel checkbox
                const cancelEl = getEl('create-cancel');
                if (cancelEl) {
                    cancelEl.checked = cancel === true || cancel === 'true' || cancel === 1;
                }

                // Auto-enable sync options when selecting API service
                const syncRateEl = getEl('create-sync-rate');
                const syncMinMaxEl = getEl('create-sync-min-max');
                const syncActionEl = getEl('create-sync-action');

                if (syncRateEl) {
                    syncRateEl.checked = true;
                    // Trigger change event to update rate fields and make them readonly
                    syncRateEl.dispatchEvent(new Event('change'));
                }
                if (syncMinMaxEl) {
                    syncMinMaxEl.checked = true;
                    // Trigger change event to make min/max readonly
                    syncMinMaxEl.dispatchEvent(new Event('change'));
                }
                if (syncActionEl) {
                    syncActionEl.checked = true;
                    // Trigger change event to disable refill/cancel
                    syncActionEl.dispatchEvent(new Event('change'));
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
                const optionsContainer = getEl('createServiceOptions');
                const dropdown = getEl('createServiceDropdown');

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
                                            <small class="text-muted d-block"> $${service.rate}</small>
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
                            const searchInput = getEl('createServiceSearch');
                            if (searchInput) {
                                searchInput.value = '';
                                searchInput.addEventListener('input', function() {
                                    const searchTerm = this.value.toLowerCase();
                                    $qa('#createServiceOptions .service-option').forEach(opt => {
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
                    const selectedService = getEl('createSelectedService');
                    const placeholder = getEl('createServicePlaceholder');

                    selectedService.innerHTML = `
                        <div class="selected-service-content">
                            <span class="selected-service-text">#${providerServiceId} - ${providerServiceName} | $${providerServiceRate || 'N/A'}</span>
                            <i class="bx bx-chevron-down"></i>
                        </div>
                    `;
                    selectedService.style.display = 'flex';
                    placeholder.style.display = 'none';

                    // Set the hidden input - use service_api as the value
                    getEl('create-provider-service-id').value = serviceData.service_api || providerServiceId;
                }
            };

            window.clearEditService = () => {
                const selectedService = getEl('createSelectedService');
                const placeholder = getEl('createServicePlaceholder');
                const hiddenInput = getEl('create-provider-service-id');

                if (hiddenInput) hiddenInput.value = '';
                if (selectedService) {
                    selectedService.style.display = 'none';
                    selectedService.innerHTML = '';
                }
                if (placeholder) placeholder.style.display = 'flex';

                // Reset sync options to default (off)
                const syncRateEl = getEl('create-sync-rate');
                const syncMinMaxEl = getEl('create-sync-min-max');
                const syncActionEl = getEl('create-sync-action');

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
                const apiRateIndicator = getEl('create-create-rate-indicator');
                if (apiRateIndicator) {
                    apiRateIndicator.style.display = 'none';
                }
            };

            // Category Select functionality
            const initEditCategorySelect = () => {
                const container = $q('.create-category-select-container');
                if (!container) return;

                const selectBox = getEl('createCategorySelectBox');
                const dropdown = getEl('createCategoryDropdown');
                const selectedCategory = getEl('createSelectedCategory');
                const placeholder = getEl('createCategoryPlaceholder');
                const hiddenInput = getEl('create-category-id');

                selectBox?.addEventListener('click', (e) => {
                    e.stopPropagation();
                    dropdown.classList.toggle('show');
                    placeholder.querySelector('i')?.classList.toggle('bx-chevron-up');
                });

                getEl('createCategorySearch')?.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    $qa('#createCategoryOptions .category-option').forEach(opt => {
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
                    getEl('createCategorySearch').value = '';
                    $qa('#createCategoryOptions .category-option').forEach(opt => opt.style.display = '');
                });

                document.addEventListener('click', (e) => {
                    if (!container.contains(e.target)) {
                        dropdown?.classList.remove('show');
                        placeholder?.querySelector('i')?.classList.remove('bx-chevron-up');
                    }
                });
            };

            const updateEditSelectedCategory = (value, platform, categoryName, image) => {
                const selectedCategory = getEl('createSelectedCategory');
                const placeholder = getEl('createCategoryPlaceholder');

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
                getEl('create-category-id').value = '';
                getEl('createSelectedCategory').style.display = 'none';
                getEl('createCategoryPlaceholder').style.display = 'flex';
            };

            // Multi-Select Attributes functionality
            const initEditAttributesDropdown = () => {
                const container = $q('.create-multi-select-container');
                if (!container) return;

                const selectBox = getEl('createMultiSelectBox');
                const dropdown = getEl('createMultiSelectDropdown');
                const selectedTags = getEl('createSelectedTags');
                const placeholder = getEl('createSelectPlaceholder');

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
                        const checkbox = getEl(`create_attr_${value}`);
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
                const dropdown = getEl('createMultiSelectDropdown');
                const selectedTags = getEl('createSelectedTags');
                const placeholder = getEl('createSelectPlaceholder');

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
                const addBtn = getEl('createAddLanguageBtn');
                const languageSelector = getEl('createLanguageSelector');
                const languageFields = getEl('createLanguageFields');
                const closeBtn = getEl('createCloseLangSelector');

                addBtn?.addEventListener('click', () => {
                    updateEditAvailableLanguages();
                    languageSelector.style.display = 'flex';
                    getEl('createLanguageSearch')?.focus();
                });

                closeBtn?.addEventListener('click', () => {
                    languageSelector.style.display = 'none';
                    getEl('createLanguageSearch').value = '';
                    showAllEditLanguageOptions();
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

                    addEditLanguageField(lang, name, flag);
                    languageSelector.style.display = 'none';
                    getEl('createLanguageSearch').value = '';
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
                        getEl('createLanguageSearch').value = '';
                        showAllEditLanguageOptions();
                    }
                });
            };

            const addEditLanguageField = (lang, name, flag, value = '') => {
                const languageFields = getEl('createLanguageFields');
                const placeholder = `Nhập tên dịch vụ bằng ${name}`;

                const fieldHtml = `
                <div class="language-field mb-3" data-lang="${lang}">
                    <div class="input-group">
                        <span class="input-group-text language-flag">
                            <img src="https://flagcdn.com/w20/${flag}.png" alt="${lang.toUpperCase()}" class="flag-icon">
                            <span class="ms-1">${lang.toUpperCase()}</span>
                        </span>
                        <input type="text" class="form-control" name="name[${lang}]" value="${value}" placeholder="${placeholder}" id="create-name-${lang}">
                        ${lang !== 'en' ? '<button type="button" class="btn btn-outline-danger remove-language"><i class="bx bx-x"></i></button>' : ''}
                    </div>
                </div>
            `;

                languageFields.insertAdjacentHTML('beforeend', fieldHtml);
                updateEditAddButtonVisibility();
            };

            const updateEditAvailableLanguages = () => {
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

                // Show message if no languages available
                const languageOptions = getEl('createLanguageOptions');
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
                const addBtn = getEl('createAddLanguageBtn');
                if (!addBtn) return;

                const allAdded = $qa('#createLanguageFields .language-field').length >= $qa('#createLanguageOptions .language-option').length;
                addBtn.disabled = allAdded;
                addBtn.innerHTML = allAdded 
                    ? '<i class="bx bx-check me-1"></i>Đã thêm tất cả ngôn ngữ'
                    : '<i class="bx bx-plus me-1"></i>Thêm tên ngôn ngữ khác';
            };

            const showAllEditLanguageOptions = () => {
                $qa('#createLanguageOptions .language-option').forEach(opt => opt.style.display = '');
            };

            // Service Type handler
            const handleEditServiceType = () => {
                const type = getEl('create-type')?.value;
                const apiFields = getEl('create-create-fields');
                const rateOriginalField = getEl('create-rate-original-field');

                // Hide both fields initially
                if (apiFields) apiFields.style.display = 'none';
                if (rateOriginalField) {
                    rateOriginalField.style.display = 'none';
                    rateOriginalField.classList.remove('show');
                    rateOriginalField.classList.add('hide');
                }
        

                if (type === 'api') {
                    if (apiFields) apiFields.style.display = 'block';
                    
                    // Add required attributes for API fields
                    const providerIdField = getEl('provider_id');
                    const providerServiceIdField = getEl('create-provider-service-id');
                    if (providerIdField) providerIdField.setAttribute('required', 'required');
                    if (providerServiceIdField) providerServiceIdField.setAttribute('required', 'required');
                    
                    // Remove required from rate_original
                    const rateOriginalField = getEl('create-rate-original');
                    if (rateOriginalField) rateOriginalField.removeAttribute('required');
                    
                } else if (type === 'normal') {
                    // Show rate original field for normal type
                    if (rateOriginalField) {
                        rateOriginalField.style.display = 'block';
                        rateOriginalField.classList.remove('hide');
                        rateOriginalField.classList.add('show');
                    }

                    
                    // Add required attribute for rate_original
                    const rateOriginalField = getEl('create-rate-original');
                    if (rateOriginalField) rateOriginalField.setAttribute('required', 'required');
                    
                    // Remove required from API fields
                    const providerIdField = getEl('provider_id');
                    const providerServiceIdField = getEl('create-provider-service-id');
                    if (providerIdField) providerIdField.removeAttribute('required');
                    if (providerServiceIdField) providerServiceIdField.removeAttribute('required');
                    
                    // Hide indicator for normal type
                    const apiIndicator = getEl('create-api-rate-indicator');
                    if (apiIndicator) apiIndicator.style.display = 'none';
                    
                    // Auto-populate default rate_up values from config for normal type
                    const retailUpEl = getEl('create-rate-retail-up');
                    const agentUpEl = getEl('create-rate-agent-up');
                    const distributorUpEl = getEl('create-rate-distributor-up');
                    
                    // Values are already set in HTML from config, only update placeholder if needed
                    if (retailUpEl && !retailUpEl.value && !retailUpEl.getAttribute('value')) {
                        retailUpEl.value = markupConfig.markup_retail || '110';
                    }
                    if (agentUpEl && !agentUpEl.value && !agentUpEl.getAttribute('value')) {
                        agentUpEl.value = markupConfig.markup_agent || '108';
                    }
                    if (distributorUpEl && !distributorUpEl.value && !distributorUpEl.getAttribute('value')) {
                        distributorUpEl.value = markupConfig.markup_distributor || '105';
                    }
                    
                    // If there's already a rate_original value, update all rates
                    const originalRate = parseFloat(getEl('create-rate-original')?.value) || 0;
                    if (originalRate > 0) {
                        updateAllRatesFromOriginal();
                    }
                } else {
                    // Remove required attributes when no type selected
                    const providerIdField = getEl('provider_id');
                    const providerServiceIdField = getEl('create-provider-service-id');
                    const rateOriginalField = getEl('create-rate-original');
                    
                    if (providerIdField) providerIdField.removeAttribute('required');
                    if (providerServiceIdField) providerServiceIdField.removeAttribute('required');
                    if (rateOriginalField) rateOriginalField.removeAttribute('required');
                    
                    // Clear all rate fields when switching away from normal type
                    const rateFields = ['create-rate-original', 'create-rate-retail', 'create-rate-agent', 'create-rate-distributor'];
                    const rateUpFields = ['create-rate-retail-up', 'create-rate-agent-up', 'create-rate-distributor-up'];
                    
                    rateFields.forEach(fieldId => {
                        const field = getEl(fieldId);
                        if (field) field.value = '';
                    });
                    
                    rateUpFields.forEach(fieldId => {
                        const field = getEl(fieldId);
                        if (field) field.value = '';
                    });
                }
            };

            // Load service data
            const loadServiceData = (service) => {
                // Basic info
                getEl('create-service-id').value = service.id;
                getEl('create-service-id-display').textContent = '#' + service.id;
                getEl('create-type').value = service.type || 'normal';
                getEl('create-type-service').value = service.type_service || '';
                getEl('create-title').value = service.title || '';
                // Set description using editor
                if (window.createDescriptionEditor) {
                    window.createDescriptionEditor.setData(service.description || '');
                } else {
                    // Fallback if editor not ready
                    const hiddenInput = getEl('create-description');
                    if (hiddenInput) hiddenInput.value = service.description || '';
                }
                getEl('create-image').value = service.image || '';
                getEl('create-average-time').value = service.average_time || '';

                // Names - handle both object and JSON string
                let names = service.name;
                if (typeof names === 'string') {
                    try {
                        names = JSON.parse(names);
                    } catch (e) {
                        names = {};
                    }
                }

                getEl('create-name-en').value = names?.en || '';

                // Remove existing non-English language fields
                $qa('#createLanguageFields .language-field:not([data-lang="en"])').forEach(el => el.remove());

                // Add other language fields from database
                if (names && typeof names === 'object') {
                    Object.keys(names).forEach(lang => {
                        if (lang !== 'en' && names[lang]) {
                            const langOption = $q(
                                `#createLanguageOptions .language-option[data-lang="${lang}"]`);
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
                getEl('create-category-id').value = service.category_id || '';
                if (service.category_id) {
                    const catOption = $q(
                        `#createCategoryOptions .category-option[data-value="${service.category_id}"]`);
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
                getEl('create-rate-original').value = formatRate(service.rate_original);
                getEl('create-rate-retail').value = formatRate(service.rate_retail);
                getEl('create-rate-agent').value = formatRate(service.rate_agent);
                getEl('create-rate-distributor').value = formatRate(service.rate_distributor);
                getEl('create-rate-retail-up').value = service.rate_retail_up || '';
                getEl('create-rate-agent-up').value = service.rate_agent_up || '';
                getEl('create-rate-distributor-up').value = service.rate_distributor_up || '';

                // Min/Max
                getEl('create-min').value = service.min || '';
                getEl('create-max').value = service.max || '';

                // Checkboxes
                getEl('create-status').checked = Boolean(service.status);
                getEl('create-refill').checked = Boolean(service.refill);
                getEl('create-cancel').checked = Boolean(service.cancel);
                getEl('create-dripfeed').checked = Boolean(service.dripfeed);
                getEl('create-sync-rate').checked = Boolean(service.sync_rate);
                getEl('create-sync-min-max').checked = Boolean(service.sync_min_max);
                getEl('create-sync-action').checked = Boolean(service.sync_action);

                // Attributes - handle both array and JSON string
                $qa('#createMultiSelectDropdown input[type="checkbox"]').forEach(cb => cb.checked = false);
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
                        const cb = getEl(`create_attr_${attr}`);
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
                    getEl('create-provider-service-id').value = serviceApiId;

                    // Service display is now handled by loadProviderServicesAndSelect
                    if (false && service.provider_service_name && service.provider_service_rate) {
                        const selectedService = getEl('createSelectedService');
                        const placeholder = getEl('createServicePlaceholder');

                        selectedService.innerHTML = `
                        <div class="selected-service-content">

                                <span class="selected-service-text">${service.provider_service} - ${service.provider_service_name} | $${service.provider_service_rate}</span>
                                <i class="bx bx-chevron-down"></i>

                        </div>
                    `;
                        selectedService.style.display = 'flex';
                        placeholder.style.display = 'none';
                    }
                }

                // Handle type display - call immediately and on change
                handleEditServiceType();

                // Image preview
                updateImagePreview(service.image);
            };

            // Open edit modal
            window.createServiceModal = function(serviceId) {
                window.currentServiceId = serviceId;
                const modal = getEl('createServiceModal');

                if (!modal) {
                    alertify.error('Modal không tìm thấy');
                    return;
                }

                new bootstrap.Modal(modal).show();
                toggleEditForm(true);

                fetch(`/admin/services/${serviceId}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                                'content')
                        }
                    })
                    .then(r => r.json())
                    .then(d => {
                        const s = d.success && d.service ? d.service : (d.id ? d : null);

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

            // Save service
            window.saveService = function() {
                const form = getEl('createServiceForm');
                const btn = getEl('saveServiceBtn');

                if (!form || !btn) return;

                // Sync editor data before submit
                if (window.createDescriptionEditor) {
                    const hiddenInput = getEl('create-description');
                    if (hiddenInput) {
                        hiddenInput.value = window.createDescriptionEditor.getData();
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
                            bootstrap.Modal.getInstance(getEl('createServiceModal'))?.hide();
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

            // Validation function for service form
            const validateServiceForm = () => {
                const form = getEl('createServiceForm');
                const serviceType = getEl('create-type')?.value;
                const providerServiceId = getEl('create-provider-service-id')?.value;
                const providerId = getEl('provider_id')?.value;
                
                if (serviceType === 'api') {
                    let errorMessage = '';
                    let highlightElement = null;
                    
                    if (!providerId || providerId.trim() === '') {
                        errorMessage = 'Vui lòng chọn nhà cung cấp khi loại dịch vụ là API.';
                        highlightElement = document.querySelector('.provider-select-container');
                    } else if (!providerServiceId || providerServiceId.trim() === '') {
                        errorMessage = 'Vui lòng chọn dịch vụ từ nhà cung cấp khi loại dịch vụ là API.';
                        highlightElement = document.querySelector('.service-select-container');
                    }
                    
                    if (errorMessage) {
                        // Remove existing error messages
                        const existingErrors = form.querySelectorAll('.alert-danger');
                        existingErrors.forEach(error => error.remove());
                        
                        // Show error message
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'alert alert-danger alert-dismissible fade show mt-3';
                        errorDiv.innerHTML = `
                            <i class="bx bx-error-circle me-2"></i>
                            <strong>Lỗi:</strong> ${errorMessage}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        `;
                        
                        // Insert error message at top of form
                        const formBody = form.querySelector('.card-body') || form;
                        formBody.insertBefore(errorDiv, formBody.firstChild);
                        
                        // Scroll to error
                        errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        
                        // Highlight the problematic element
                        if (highlightElement) {
                            highlightElement.style.border = '2px solid #dc3545';
                            highlightElement.style.borderRadius = '8px';
                            setTimeout(() => {
                                highlightElement.style.border = '';
                                highlightElement.style.borderRadius = '';
                            }, 3000);
                        }
                        
                        return false;
                    }
                }
                
                return true;
            };

            // Create new service
            window.createService = function() {
                const form = getEl('createServiceForm');
                const btn = getEl('createServiceBtn');

                if (!form || !btn) return;

                // Validate form first
                if (!validateServiceForm()) {
                    return;
                }

                // Sync editor data before submit
                if (window.createDescriptionEditor) {
                    const hiddenInput = getEl('create-description');
                    if (hiddenInput) {
                        hiddenInput.value = window.createDescriptionEditor.getData();
                    }
                }

                const orig = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Đang tạo...';

                fetch('/admin/services', {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                        }
                    })
                    .then(r => r.json())
                    .then(d => {
                        if (d.success) {
                            alertify.success(d.message || 'Tạo dịch vụ thành công!');
                            
                            // Show success message with service info if available
                            if (d.service && d.service.name) {
                                setTimeout(() => {
                                    alertify.success(`Dịch vụ "${d.service.name}" đã được tạo thành công!`);
                                }, 500);
                            }
                            
                            // Redirect to services list
                            setTimeout(() => {
                                window.location.href = '/admin/services';
                            }, 1500);
                        } else {
                            alertify.error(d.message || 'Có lỗi xảy ra');
                            
                            // Show validation errors if any
                            if (d.errors) {
                                let errorMessages = [];
                                Object.keys(d.errors).forEach(key => {
                                    if (Array.isArray(d.errors[key])) {
                                        errorMessages = errorMessages.concat(d.errors[key]);
                                    } else {
                                        errorMessages.push(d.errors[key]);
                                    }
                                });
                                
                                if (errorMessages.length > 0) {
                                    // Show each error separately for better readability
                                    errorMessages.forEach((msg, index) => {
                                        setTimeout(() => {
                                            alertify.error(msg);
                                        }, index * 200);
                                    });
                                }
                            }
                        }
                    })
                    .catch(e => {
                        console.error('Error:', e);
                        alertify.error('Có lỗi xảy ra khi tạo dịch vụ');
                    })
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

                const editorElement = document.querySelector('#create-description-editor');
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
                        window.createDescriptionEditor = editor;

                        // Update hidden input when content changes
                        editor.model.document.on('change:data', () => {
                            const hiddenInput = document.getElementById('create-description');
                            if (hiddenInput) {
                                hiddenInput.value = editor.getData();
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error initializing CKEditor:', error);
                    });
            };

            // Initialize markup values from config
            const initializeMarkupValues = () => {
                const retailUpEl = getEl('create-rate-retail-up');
                const agentUpEl = getEl('create-rate-agent-up');
                const distributorUpEl = getEl('create-rate-distributor-up');
                
                // Set values from config if not already set
                if (retailUpEl && !retailUpEl.value) {
                    retailUpEl.value = markupConfig.markup_retail || '110';
                }
                if (agentUpEl && !agentUpEl.value) {
                    agentUpEl.value = markupConfig.markup_agent || '108';
                }
                if (distributorUpEl && !distributorUpEl.value) {
                    distributorUpEl.value = markupConfig.markup_distributor || '105';
                }
            };

            // Initialize on DOM ready
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize markup values first
                initializeMarkupValues();
                
                initEditProviderSelect();
                initEditCategorySelect();
                initEditAttributesDropdown();
                // Use universal language fields function if available, fallback to create-specific
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

                // Type change handler - Use both approaches for reliability
                const typeSelect = getEl('create-type');
                if (typeSelect) {
                    typeSelect.addEventListener('change', handleEditServiceType);
                    
                    // Also add a direct handler for immediate response
                    typeSelect.addEventListener('change', function() {
                        const selectedType = this.value;
                        const rateField = document.getElementById('create-rate-original-field');
                        const apiFields = document.getElementById('create-create-fields');
                        
                        // Hide both first
                        if (rateField) {
                            rateField.style.display = 'none';
                            rateField.classList.remove('show');
                            rateField.classList.add('hide');
                        }
                        if (apiFields) {
                            apiFields.style.display = 'none';
                        }
                        
                        // Show appropriate field
                        if (selectedType === 'normal' && rateField) {
                            rateField.style.display = 'block';
                            rateField.classList.remove('hide');
                            rateField.classList.add('show');
                        } else if (selectedType === 'api' && apiFields) {
                            apiFields.style.display = 'block';
                        }
                    });
                }

                // Form validation - now handled by createService function
                // Remove the old submit event listener since we're using onclick now

                // Image preview handler
                getEl('create-image')?.addEventListener('input', function() {
                    updateImagePreview(this.value);
                });

                // Rate UP handlers
                ['create-rate-retail-up', 'create-rate-agent-up', 'create-rate-distributor-up'].forEach(id => {
                    getEl(id)?.addEventListener('input', updateEditRatesFromOriginal);
                });

                // Rate original handler
                getEl('create-rate-original')?.addEventListener('input', function() {
                    updateEditRatesFromOriginal();

                    // Hide API rate indicator when user manually changes rate
                    const apiRateIndicator = getEl('create-create-rate-indicator');
                    if (apiRateIndicator) {
                        apiRateIndicator.style.display = 'none';
                    }
                });

                // Sync rate handler
                getEl('create-sync-rate')?.addEventListener('change', function() {
                    const rateFields = ['create-rate-retail', 'create-rate-agent',
                        'create-rate-distributor'
                    ];
                    rateFields.forEach(id => {
                        const el = getEl(id);
                        if (el) {
                            el.readOnly = this.checked;
                            el.classList.toggle('bg-light', this.checked);
                        }
                    });
                    if (this.checked) updateEditRatesFromOriginal();
                });

                // Sync Min/Max handler
                getEl('create-sync-min-max')?.addEventListener('change', function() {
                    const minEl = getEl('create-min');
                    const maxEl = getEl('create-max');
                    
                    if (minEl) {
                        minEl.readOnly = this.checked;
                        minEl.classList.toggle('bg-light', this.checked);
                    }
                    if (maxEl) {
                        maxEl.readOnly = this.checked;
                        maxEl.classList.toggle('bg-light', this.checked);
                    }

                    // Update values from API when sync is enabled
                    if (this.checked && selectedApiServiceData) {
                        if (minEl) minEl.value = selectedApiServiceData.min || '';
                        if (maxEl) maxEl.value = selectedApiServiceData.max || '';
                    }
                });

                // Sync Action handler
                getEl('create-sync-action')?.addEventListener('change', function() {
                    const refillEl = getEl('create-refill');
                    const cancelEl = getEl('create-cancel');
                    
                    if (refillEl) {
                        refillEl.disabled = this.checked;
                        refillEl.closest('.form-check')?.classList.toggle('opacity-50', this.checked);
                    }
                    if (cancelEl) {
                        cancelEl.disabled = this.checked;
                        cancelEl.closest('.form-check')?.classList.toggle('opacity-50', this.checked);
                    }

                    // Update values from API when sync is enabled
                    if (this.checked && selectedApiServiceData) {
                        if (refillEl) {
                            refillEl.checked = selectedApiServiceData.refill === true || 
                                             selectedApiServiceData.refill === 'true' || 
                                             selectedApiServiceData.refill === 1;
                        }
                        if (cancelEl) {
                            cancelEl.checked = selectedApiServiceData.cancel === true || 
                                             selectedApiServiceData.cancel === 'true' || 
                                             selectedApiServiceData.cancel === 1;
                        }
                    }
                });
            });

            // Initialize service select functionality
            const initEditServiceSelect = () => {
                const selectBox = getEl('createServiceSelectBox');
                const dropdown = getEl('createServiceDropdown');

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
                    const optionsContainer = getEl('createServiceOptions');
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
                    const container = selectBox.closest('.create-service-select-container');
                    if (container && !container.contains(e.target)) {
                        dropdown.classList.remove('show');
                        dropdown.style.display = 'none';
                        dropdown.style.visibility = 'hidden';
                    }
                });
            };

            // Clear functions for edit form


            window.clearEditCategory = function() {
                const selectedCategory = document.getElementById('createSelectedCategory');
                const placeholder = document.getElementById('createCategoryPlaceholder');
                const hiddenInput = document.getElementById('create-category-id');

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
