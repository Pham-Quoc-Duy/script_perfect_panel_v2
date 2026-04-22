@extends('admin.layouts.app')

@section('title', 'Import dịch vụ')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Import dịch vụ',
                    'breadcrumb' => 'Dịch vụ',
                ])

                @include('admin.components.alert')

                <!-- Card 1: Select Options -->
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body p-3">
                                <div class="row g-2 align-items-end">
                                    <div class="col-lg-3">
                                        <label class="form-label mb-2 small fw-600 text-uppercase"
                                            style="letter-spacing: 0.5px;">
                                            <i class="bx bx-server text-primary me-2"></i>Nhà cung cấp
                                        </label>
                                        <div class="provider-select-container">
                                            <div class="provider-select-box" id="importProviderSelectBox">
                                                <div class="selected-provider" id="importSelectedProvider"
                                                    style="display: none;">
                                                    <div class="selected-provider-item">
                                                        <div class="selected-provider-icon-placeholder">
                                                            <i class="bx bx-server"></i>
                                                        </div>
                                                        <div class="selected-provider-details">
                                                            <span class="selected-provider-name"></span>
                                                        </div>
                                                        <button type="button" class="clear-provider"
                                                            onclick="clearImportProvider()">
                                                            <i class="bx bx-x"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="provider-placeholder" id="importProviderPlaceholder">
                                                    <span>Chọn nhà cung cấp</span>
                                                    <i class="bx bx-chevron-down"></i>
                                                </div>
                                            </div>

                                            <div class="provider-dropdown" id="importProviderDropdown"
                                                style="display:none;visibility:hidden;">
                                                <div class="search-container">
                                                    <input type="text" class="search-input" id="importProviderSearch"
                                                        placeholder="Tìm kiếm...">
                                                </div>
                                                <div class="options-container" id="importProviderOptions">
                                                    @forelse($providers as $provider)
                                                        <div class="provider-option" data-value="{{ $provider->id }}"
                                                            data-name="{{ $provider->name }}"
                                                            data-url="{{ $provider->url ?? '' }}"
                                                            data-search="{{ strtolower($provider->name . ' ' . ($provider->url ?? '')) }}">
                                                            <div class="provider-info">
                                                                <div class="provider-icon-placeholder">
                                                                    <i class="bx bx-server"></i>
                                                                </div>
                                                                <div class="provider-details">
                                                                    <span class="provider-name">{{ $provider->name }}</span>
                                                                    @if ($provider->url)
                                                                        <small class="text-muted d-block"
                                                                            title="{{ $provider->url }}">
                                                                            {{ Str::limit($provider->url, 25) }}
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="text-center p-3 text-muted">
                                                            <p class="mb-0">Không có nhà cung cấp</p>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                            <input type="hidden" id="import_provider_id" value="">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <label class="form-label mb-2 small fw-600 text-uppercase"
                                            style="letter-spacing: 0.5px;">
                                            <i class="bx bx-category text-info me-2"></i>Danh mục
                                        </label>
                                        <div class="category-select-container">
                                            <div class="category-select-box" id="importCategorySelectBox">
                                                <div class="selected-category" id="importSelectedCategory"
                                                    style="display: none;">
                                                    <div class="selected-category-item">
                                                        <div class="selected-category-icon-placeholder">
                                                            <i class="bx bx-category"></i>
                                                        </div>
                                                        <div class="selected-category-details">
                                                            <span class="selected-category-label"></span>
                                                        </div>
                                                        <button type="button" class="clear-category"
                                                            onclick="clearImportCategory()">
                                                            <i class="bx bx-x"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="category-placeholder" id="importCategoryPlaceholder">
                                                    <span>Chọn danh mục</span>
                                                    <i class="bx bx-chevron-down"></i>
                                                </div>
                                            </div>
                                            <div class="category-dropdown" id="importCategoryDropdown"
                                                style="display:none;visibility:hidden;">
                                                <div class="search-container">
                                                    <input type="text" class="search-input" id="importCategorySearch"
                                                        placeholder="Tìm kiếm...">
                                                </div>
                                                <div class="options-container" id="importCategoryOptions"
                                                    style="max-height:300px;overflow-y:auto;">
                                                    @foreach ($categories as $category)
                                                        <div class="category-option" data-value="{{ $category->id }}"
                                                            data-platform="{{ $category->platform->name ?? '' }}"
                                                            data-name="{{ $category->getName() }}"
                                                            data-image="{{ $category->image ?? '' }}"
                                                            data-search="{{ strtolower(($category->platform->name ?? '') . ' ' . $category->getName()) }}">
                                                            <div class="category-info">
                                                                @if ($category->image)
                                                                    <img src="{{ $category->image }}"
                                                                        alt="{{ $category->platform->name ?? '' }}"
                                                                        class="category-icon"
                                                                        title="{{ $category->image }}">
                                                                @else
                                                                    <div class="category-icon-placeholder"><i
                                                                            class="bx bx-category"></i></div>
                                                                @endif
                                                                <div class="category-details">
                                                                    <span
                                                                        class="category-label">{{ $category->platform->name ?? '' }}
                                                                        | {{ $category->getName() }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <input type="hidden" id="import_category_id" value="">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-primary w-100 h-100" id="loadServicesBtn"
                                            onclick="loadServices()">
                                            <i class="bx bx-download me-1"></i>Tải dịch vụ
                                        </button>
                                    </div>

                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-success w-100 h-100" id="importServicesBtn"
                                            onclick="importServices()" style="display: none;">
                                            <i class="bx bx-import me-1"></i>Nhập
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Services List -->
                <div class="row" id="importServicesSection" style="display: none;">
                    <div class="col-lg-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-white border-bottom">
                                <h6 class="card-title mb-0 fw-600 text-uppercase"
                                    style="letter-spacing: 0.5px; font-size: 0.875rem;">
                                    <i class="bx bx-list-ul text-success me-2"></i>Danh sách dịch vụ
                                </h6>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-sm mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="40" class="text-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="selectAllCheckbox" onchange="toggleAllServices()">
                                                </th>
                                                <th width="50" class="text-center"><small
                                                        class="text-uppercase fw-600"
                                                        style="font-size: 0.7rem;">ID</small></th>
                                                <th width="200" class="text-start"><small
                                                        class="text-uppercase fw-600" style="font-size: 0.7rem;">Tên dịch
                                                        vụ</small></th>
                                                <th width="70" class="text-center"><small
                                                        class="text-uppercase fw-600"
                                                        style="font-size: 0.7rem;">API</small></th>
                                                <th width="70" class="text-center"><small
                                                        class="text-uppercase fw-600"
                                                        style="font-size: 0.7rem;">Sync</small></th>
                                                <th width="150" class="text-center"><small
                                                        class="text-uppercase fw-600"
                                                        style="font-size: 0.7rem;">Retail</small></th>
                                                <th width="150" class="text-center"><small
                                                        class="text-uppercase fw-600"
                                                        style="font-size: 0.7rem;">Agent</small></th>
                                                <th width="150" class="text-center"><small
                                                        class="text-uppercase fw-600"
                                                        style="font-size: 0.7rem;">Distributor</small></th>
                                            </tr>
                                        </thead>
                                        <tbody id="servicesTableBody">
                                            <!-- Services will be loaded here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted small">
                                        <strong><span id="selectedCount">0</span></strong> dịch vụ được chọn
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            onclick="cancelImport()">
                                            <i class="bx bx-x me-1"></i>Hủy
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success" id="confirmImportBtn"
                                            onclick="confirmImport()">
                                            <i class="bx bx-check me-1"></i>Nhập
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loading State -->
                <div class="row" id="importLoadingState" style="display: none;">
                    <div class="col-lg-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center py-5">
                                <div class="spinner-border text-primary mb-3" role="status">
                                    <span class="visually-hidden">Đang tải...</span>
                                </div>
                                <p class="text-muted mb-0">Đang tải danh sách dịch vụ...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Import specific styles */
    .import-service-row {
        transition: all 0.2s ease;
    }

    .import-service-row:hover {
        background-color: #f8f9fa;
    }

    .import-service-row.selected {
        background-color: #e3f2fd;
        border-left: 3px solid #007bff;
    }

    .service-checkbox {
        transform: scale(1);
    }

    /* Table styling */
    .table {
        border-collapse: collapse;
        margin-bottom: 0;
        font-size: 0.8125rem;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: 700;
        font-size: 0.7rem;
        color: #495057;
        border-bottom: 1px solid #dee2e6;
        padding: 0.5rem 0.625rem;
        letter-spacing: 0.3px;
    }

    .table td {
        padding: 0.5rem 0.625rem;
        border-bottom: 1px solid #f1f3f5;
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .price-badge {
        font-size: 0.8125rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-weight: 500;
    }

    .status-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-weight: 500;
    }


    .service-name {
        font-weight: 600;
        color: #212529;
        font-size: 0.8125rem;
        line-height: 1.3;
    }

    .service-type {
        font-size: 0.75rem;
        color: #6c757d;
        font-style: italic;
    }

    .service-description {
        font-size: 0.75rem;
        line-height: 1.2;
    }

    .service-features {
        display: flex;
        gap: 0.25rem;
        flex-wrap: wrap;
    }

    .service-features .badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.5rem;
    }

    /* Compact select styles - matching create services */
    .provider-select-container,
    .category-select-container {
        position: relative;
        overflow: visible !important;
        z-index: 1;
    }

    .provider-select-box,
    .category-select-box {
        height: 38px;
        border: 1px solid var(--bs-border-color);
        border-radius: .375rem;
        background-color: var(--bs-body-bg);
        cursor: pointer;
        padding: .375rem .75rem;
        display: flex;
        align-items: center;
        transition: all .2s;
        position: relative;
        z-index: 1;
        font-size: 0.875rem;
    }

    .provider-select-box:hover,
    .category-select-box:hover {
        border-color: var(--bs-primary);
        z-index: 2;
    }

    .provider-select-box:focus-within,
    .category-select-box:focus-within {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
    }

    .provider-select-box:focus-within,
    .category-select-box:focus-within {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
    }

    .provider-dropdown,
    .category-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color);
        border-radius: .375rem;
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
        z-index: 999 !important;
        max-height: 250px;
        overflow-y: auto;
        display: none;
        margin-top: .25rem;
        width: 100%;
        min-width: 200px;
    }

    .provider-dropdown.show,
    .category-dropdown.show {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        animation: fadeInDown .2s;
        z-index: 999 !important;
    }

    /* Ensure dropdown stays within viewport */
    .provider-select-container,
    .category-select-container {
        position: relative;
        overflow: visible !important;
        z-index: 1;
    }

    /* Responsive dropdown positioning */
    @media (max-width: 768px) {

        .provider-dropdown,
        .category-dropdown {
            left: -50px;
            right: -50px;
            min-width: 250px;
        }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .provider-dropdown.dropdown-down,
    .category-dropdown.dropdown-down {
        top: 100%;
        bottom: auto;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        margin-top: 0.5rem;
        margin-bottom: 0;
    }

    .provider-option,
    .category-option {
        padding: .5rem .75rem;
        cursor: pointer;
        transition: all .2s;
        border-bottom: 1px solid var(--bs-border-color-translucent);
        font-size: 0.875rem;
    }

    .provider-option:hover,
    .category-option:hover {
        background-color: var(--bs-gray-100);
    }

    .provider-option:last-child,
    .category-option:last-child {
        border-bottom: none;
    }

    .search-container {
        padding: .5rem;
        border-bottom: 1px solid var(--bs-border-color-translucent);
        background-color: var(--bs-gray-50);
    }

    .search-input {
        width: 100%;
        border: 1px solid var(--bs-border-color);
        border-radius: .25rem;
        padding: .25rem .5rem;
        font-size: .8125rem;
        background-color: var(--bs-body-bg);
        transition: all 0.2s ease;
    }

    .search-input:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .25);
        outline: none;
    }

    .provider-info,
    .category-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        width: 100%;
    }

    .provider-icon-placeholder,
    .category-icon-placeholder {
        width: 20px;
        height: 20px;
        background: var(--bs-gray-200);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--bs-secondary);
        font-size: 0.75rem;
        flex-shrink: 0;
    }

    .category-icon {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    .category-star-icon {
        font-size: 0.875rem;
        color: #ffc107;
        flex-shrink: 0;
    }

    .selected-category-item .category-star-icon {
        font-size: 0.875rem;
        color: #ffc107;
        flex-shrink: 0;
    }

    .clear-provider,
    .clear-category {
        background: none;
        border: none;
        color: var(--bs-secondary);
        padding: 0.125rem;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        font-size: 0.75rem;
    }

    .clear-provider:hover,
    .clear-category:hover {
        background: var(--bs-danger);
        color: white;
    }

    .provider-details,
    .category-details {
        flex: 1;
        min-width: 0;
        display: flex;
        align-items: center;
    }

    .category-label {
        font-size: 0.875rem;
        color: #212529;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .provider-name,
    .category-platform {
        font-weight: 500;
        color: #212529;
        display: block;
        font-size: 0.875rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .category-name {
        font-size: 0.8125rem;
        color: #6c757d;
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Import table input-group styling - Single border box */
    .import-service-row .rate-input-group {
        max-width: 140px;
        margin: 0 auto;
        flex-wrap: nowrap !important;
        white-space: nowrap;
    }

    .import-service-row .rate-input-group .rate-field {
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
        height: 28px;
        text-align: center;
        border-right: none !important;
        flex: 0 0 65px;
        min-width: 65px;
        max-width: 65px;
        background-color: #f8f9fa !important;
    }

    .import-service-row .rate-input-group .rate-up-field {
        font-size: 0.7rem !important;
        padding: 0.2rem 0.4rem !important;
        height: 28px;
        text-align: center;
        border-left: 1px solid var(--bs-border-color) !important;
        border-right: none !important;
        color: #007bff !important;
        font-weight: 600 !important;
        flex: 0 0 50px;
        min-width: 50px;
        max-width: 50px;
        background-color: #fff !important;
    }

    .import-service-row .rate-input-group .rate-up-field:focus {
        background-color: #e3f2fd !important;
        border-color: #007bff !important;
        color: #0056b3 !important;
        z-index: 3;
    }

    .import-service-row .rate-input-group .input-group-text {
        font-size: 0.65rem;
        padding: 0.2rem 0.4rem;
        height: 28px;
        background-color: #e9ecef;
        border-color: var(--bs-border-color);
        color: #6c757d;
        font-weight: 500;
        flex: 0 0 25px;
        min-width: 25px;
        max-width: 25px;
    }

    /* Remove arrows from number input */
    .rate-up-field::-webkit-outer-spin-button,
    .rate-up-field::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .rate-up-field[type=number] {
        -moz-appearance: textfield;
    }

    /* Align table columns properly */
    .table th,
    .table td {
        vertical-align: middle !important;
    }

    .table th.text-center,
    .table td.text-center {
        text-align: center !important;
    }

    .table th.text-start,
    .table td.text-start {
        text-align: left !important;
    }

    /* Ensure fixed column widths */
    .table {
        table-layout: fixed;
        width: 100%;
    }

    /* Remove arrows from number input */
    .rate-up-field::-webkit-outer-spin-button,
    .rate-up-field::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .rate-up-field[type=number] {
        -moz-appearance: textfield;
    }

    .selected-provider,
    .selected-category {
        display: none;
        width: 100%;
    }

    .selected-provider-item,
    .selected-category-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        width: 100%;
    }

    .selected-provider-details,
    .selected-category-details {
        flex: 1;
        min-width: 0;
        display: flex;
        align-items: center;
    }

    .selected-provider-name,
    .selected-category-platform {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--bs-body-color);
        display: block;
    }

    .selected-category-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--bs-body-color);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .selected-category-name {
        font-size: 0.8125rem;
        color: #6c757d;
        display: block;
    }

    .provider-placeholder,
    .category-placeholder {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        color: var(--bs-secondary);
        font-size: .875rem;
    }

    .provider-placeholder i,
    .category-placeholder i {
        transition: transform .2s;
        color: var(--bs-secondary);
    }

    .provider-placeholder i.bx-chevron-up,
    .category-placeholder i.bx-chevron-up {
        transform: rotate(180deg);
    }

    /* Form styling improvements */
    .form-group {
        margin-bottom: 0;
    }

    .form-label {
        color: #495057;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .btn {
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background: #007bff;
        border-color: #007bff;
    }

    .btn-success {
        background: #28a745;
        border-color: #28a745;
    }

    /* Card improvements */
    .card {
        border-radius: 0.375rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
        margin-bottom: 0;
        overflow: visible !important;
    }

    .card.shadow-sm {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08) !important;
        overflow: visible !important;
    }

    .card-header {
        background: #fff;
        border-bottom: 1px solid #e9ecef;
        padding: 1rem 1.25rem;
        overflow: visible !important;
    }

    .card-body {
        padding: 1.25rem;
        overflow: visible !important;
    }

    .card-body.p-0 {
        padding: 0 !important;
    }

    .card-footer {
        background: #fff;
        border-top: 1px solid #e9ecef;
        padding: 0.875rem 1.25rem;
    }

    padding: 1rem 1.5rem;
    }

    .card-title {
        color: #2c3e50;
        font-weight: 600;
        font-size: 1.125rem;
    }

    /* Ensure parent containers don't clip dropdown */
    .row {
        overflow: visible !important;
    }

    .col-lg-4,
    .col-lg-2,
    .col-lg-5 {
        overflow: visible !important;
    }

    .main-content,
    .page-content,
    .container-fluid {
        overflow: visible !important;
    }

    /* Additional z-index management */
    .provider-dropdown.show,
    .category-dropdown.show {
        position: absolute !important;
        z-index: 999 !important;
    }

    /* Ensure dropdown appears above content but below header */
    .provider-dropdown *,
    .category-dropdown * {
        z-index: inherit;
    }

    /* Auto-calculated visual feedback */
    .auto-calculated {
        background-color: #d4edda !important;
        border-color: #28a745 !important;
        transition: all 0.3s ease;
        animation: pulse-green 0.6s ease-in-out;
    }

    @keyframes pulse-green {
        0% {
            background-color: #d4edda;
            transform: scale(1);
        }

        50% {
            background-color: #c3e6cb;
            transform: scale(1.02);
        }

        100% {
            background-color: #d4edda;
            transform: scale(1);
        }
    }

    /* Sync checkbox styling */
    .sync-checkbox {
        transform: scale(1.2);
    }

    .sync-checkbox:checked {
        background-color: #28a745;
        border-color: #28a745;
    }

    /* Rate group styling - display rate and rate-up horizontally */
    .rate-group {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .rate-group .form-control-sm {
        flex: 1;
        min-width: 0;
        font-size: 0.75rem;
        padding: 0.375rem 0.5rem;
        height: 32px;
    }

    .rate-group .rate-field {
        flex: 1.3;
        text-align: right;
    }

    .rate-group .rate-up-field {
        flex: 0.9;
        text-align: center;
        max-width: 60px;
    }

    /* Rate field styling when readonly (sync ON) */
    .rate-field.bg-light {
        background-color: #f8f9fa !important;
        color: #6c757d;
        cursor: not-allowed;
    }

    /* Rate field styling when editable (sync OFF) */
    .rate-field:not(.bg-light) {
        background-color: #fff !important;
        color: #212529;
        cursor: text;
    }

    /* Rate up field always editable styling */
    .rate-up-field {
        background-color: transparent !important;
        color: #007bff !important;
        font-weight: 600 !important;
    }

    .rate-up-field:focus {
        background-color: #e3f2fd !important;
        color: #0056b3 !important;
    }
</style>

<script>
    const markupConfig = @json($markupConfig ?? [
        'markup_retail' => 110.0,
        'markup_agent' => 110.0, 
        'markup_distributor' => 110.0
    ]);

    // Debug: Log markup config to console
    console.log('Markup Config:', markupConfig);

    // Toast notification function
    function showToast(type, message) {
        // Remove existing toasts
        document.querySelectorAll('.toast-notification').forEach(el => el.remove());

        const iconMap = {
            'success': 'bx-check-circle',
            'error': 'bx-x-circle',
            'info': 'bx-info-circle',
            'warning': 'bx-error-circle'
        };

        const colorMap = {
            'success': 'success',
            'error': 'danger',
            'info': 'info',
            'warning': 'warning'
        };

        const toast = document.createElement('div');
        toast.className = `alert alert-${colorMap[type] || 'info'} alert-dismissible fade show position-fixed toast-notification`;
        toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px; max-width: 400px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);';
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="bx ${iconMap[type] || 'bx-info-circle'} me-2" style="font-size: 18px;"></i>
                <span>${message}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        document.body.appendChild(toast);

        // Auto remove after duration based on type
        const duration = type === 'error' ? 6000 : (type === 'info' ? 3000 : 4000);
        setTimeout(() => {
            if (toast.parentNode) {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 150);
            }
        }, duration);
    }

    // Import Services functionality
    (function() {
        'use strict';

        const getEl = id => document.getElementById(id);
        let selectedServices = new Set();

        // Initialize provider select
        const initImportProviderSelect = () => {
            const container = document.querySelector('.provider-select-container');
            if (!container) return;

            const selectBox = getEl('importProviderSelectBox');
            const dropdown = getEl('importProviderDropdown');
            const selectedProvider = getEl('importSelectedProvider');
            const placeholder = getEl('importProviderPlaceholder');

            selectBox?.addEventListener('click', (e) => {
                e.stopPropagation();

                // Smart positioning to keep dropdown in viewport
                const rect = selectBox.getBoundingClientRect();
                const viewportHeight = window.innerHeight;
                const viewportWidth = window.innerWidth;
                const dropdownHeight = 250; // max-height

                // Check if dropdown would go outside viewport
                const spaceBelow = viewportHeight - rect.bottom;
                const spaceAbove = rect.top;

                // Position dropdown
                if (spaceBelow < dropdownHeight && spaceAbove > dropdownHeight) {
                    // Show above if more space above
                    dropdown.style.top = 'auto';
                    dropdown.style.bottom = '100%';
                    dropdown.style.marginTop = '0';
                    dropdown.style.marginBottom = '.25rem';
                } else {
                    // Show below (default)
                    dropdown.style.top = '100%';
                    dropdown.style.bottom = 'auto';
                    dropdown.style.marginTop = '.25rem';
                    dropdown.style.marginBottom = '0';
                }

                // Ensure dropdown doesn't go outside horizontal viewport
                if (rect.left < 50) {
                    dropdown.style.left = '0';
                    dropdown.style.right = 'auto';
                    dropdown.style.minWidth = '250px';
                } else if (rect.right > viewportWidth - 50) {
                    dropdown.style.left = 'auto';
                    dropdown.style.right = '0';
                    dropdown.style.minWidth = '250px';
                } else {
                    dropdown.style.left = '0';
                    dropdown.style.right = '0';
                }

                dropdown.classList.toggle('show');
                placeholder.querySelector('i')?.classList.toggle('bx-chevron-up');
            });

            getEl('importProviderSearch')?.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                document.querySelectorAll('#importProviderOptions .provider-option').forEach(opt => {
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

                getEl('import_provider_id').value = value;
                updateImportSelectedProvider(value, name, url);

                dropdown.classList.remove('show');
                placeholder.querySelector('i')?.classList.remove('bx-chevron-up');
                getEl('importProviderSearch').value = '';
                document.querySelectorAll('#importProviderOptions .provider-option').forEach(opt => opt
                    .style.display = '');
            });

            document.addEventListener('click', (e) => {
                if (!container.contains(e.target)) {
                    dropdown?.classList.remove('show');
                    placeholder?.querySelector('i')?.classList.remove('bx-chevron-up');
                }
            });
        };

        const updateImportSelectedProvider = (value, name, url) => {
            const selectedProvider = getEl('importSelectedProvider');
            const placeholder = getEl('importProviderPlaceholder');

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
                        <button type="button" class="clear-provider" onclick="clearImportProvider()"><i class="bx bx-x"></i></button>
                    </div>
                `;
            } else {
                selectedProvider.style.display = 'none';
                placeholder.style.display = 'flex';
            }
        };

        // Initialize category select
        const initImportCategorySelect = () => {
            const container = document.querySelector('.category-select-container');
            if (!container) return;

            const selectBox = getEl('importCategorySelectBox');
            const dropdown = getEl('importCategoryDropdown');
            const selectedCategory = getEl('importSelectedCategory');
            const placeholder = getEl('importCategoryPlaceholder');

            selectBox?.addEventListener('click', (e) => {
                e.stopPropagation();

                // Smart positioning to keep dropdown in viewport
                const rect = selectBox.getBoundingClientRect();
                const viewportHeight = window.innerHeight;
                const viewportWidth = window.innerWidth;
                const dropdownHeight = 250; // max-height

                // Check if dropdown would go outside viewport
                const spaceBelow = viewportHeight - rect.bottom;
                const spaceAbove = rect.top;

                // Position dropdown
                if (spaceBelow < dropdownHeight && spaceAbove > dropdownHeight) {
                    // Show above if more space above
                    dropdown.style.top = 'auto';
                    dropdown.style.bottom = '100%';
                    dropdown.style.marginTop = '0';
                    dropdown.style.marginBottom = '.25rem';
                } else {
                    // Show below (default)
                    dropdown.style.top = '100%';
                    dropdown.style.bottom = 'auto';
                    dropdown.style.marginTop = '.25rem';
                    dropdown.style.marginBottom = '0';
                }

                // Ensure dropdown doesn't go outside horizontal viewport
                if (rect.left < 50) {
                    dropdown.style.left = '0';
                    dropdown.style.right = 'auto';
                    dropdown.style.minWidth = '250px';
                } else if (rect.right > viewportWidth - 50) {
                    dropdown.style.left = 'auto';
                    dropdown.style.right = '0';
                    dropdown.style.minWidth = '250px';
                } else {
                    dropdown.style.left = '0';
                    dropdown.style.right = '0';
                }

                dropdown.classList.toggle('show');
                placeholder.querySelector('i')?.classList.toggle('bx-chevron-up');
            });

            getEl('importCategorySearch')?.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                document.querySelectorAll('#importCategoryOptions .category-option').forEach(opt => {
                    const searchData = opt.dataset.search || '';
                    opt.style.display = searchData.includes(searchTerm) ? '' : 'none';
                });
            });

            dropdown?.addEventListener('click', (e) => {
                const option = e.target.closest('.category-option');
                if (!option) return;

                const value = option.dataset.value;
                const platform = option.dataset.platform;
                const name = option.dataset.name;
                const image = option.dataset.image;

                getEl('import_category_id').value = value;
                updateImportSelectedCategory(value, platform, name, image);

                dropdown.classList.remove('show');
                placeholder.querySelector('i')?.classList.remove('bx-chevron-up');
                getEl('importCategorySearch').value = '';
                document.querySelectorAll('#importCategoryOptions .category-option').forEach(opt => opt
                    .style.display = '');
            });

            document.addEventListener('click', (e) => {
                if (!container.contains(e.target)) {
                    dropdown?.classList.remove('show');
                    placeholder?.querySelector('i')?.classList.remove('bx-chevron-up');
                }
            });
        };

        const updateImportSelectedCategory = (value, platform, name, image) => {
            const selectedCategory = getEl('importSelectedCategory');
            const placeholder = getEl('importCategoryPlaceholder');

            if (value) {
                placeholder.style.display = 'none';
                selectedCategory.style.display = 'block';
                selectedCategory.innerHTML = `
                    <div class="selected-category-item">
                        ${image ? 
                            `<img src="${image}" alt="${platform}" class="category-icon">` : 
                            `<div class="category-icon-placeholder"><i class="bx bx-category"></i></div>`
                        }
                        <div class="selected-category-details">
                            <span class="selected-category-label">${platform} | ${name}</span>
                        </div>
                        <button type="button" class="clear-category" onclick="clearImportCategory()"><i class="bx bx-x"></i></button>
                    </div>
                `;
            } else {
                selectedCategory.style.display = 'none';
                placeholder.style.display = 'flex';
            }
        };

        // Global functions
        window.clearImportProvider = () => {
            getEl('import_provider_id').value = '';
            getEl('importSelectedProvider').style.display = 'none';
            getEl('importProviderPlaceholder').style.display = 'flex';
        };

        window.clearImportCategory = () => {
            getEl('import_category_id').value = '';
            getEl('importSelectedCategory').style.display = 'none';
            getEl('importCategoryPlaceholder').style.display = 'flex';
        };

        // Load services function with retry logic
        window.loadServices = async () => {
            const providerId = getEl('import_provider_id').value;
            const categoryId = getEl('import_category_id').value;

            if (!providerId) {
                showToast('warning', 'Vui lòng chọn nhà cung cấp');
                return;
            }

            if (!categoryId) {
                showToast('warning', 'Vui lòng chọn danh mục');
                return;
            }

            const btn = getEl('loadServicesBtn');
            const orig = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i>Đang tải...';

            // Show loading state
            getEl('importLoadingState').style.display = 'block';
            getEl('importServicesSection').style.display = 'none';
            getEl('importServicesBtn').style.display = 'none';

            const maxRetries = 3;
            let lastError = null;

            for (let attempt = 1; attempt <= maxRetries; attempt++) {
                try {
                    const controller = new AbortController();
                    const timeoutId = setTimeout(() => controller.abort(), 90000); // 90 second timeout

                    const response = await fetch(`/admin/services/provider/${providerId}/services`, {
                        signal: controller.signal,
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                ?.getAttribute('content')
                        }
                    });

                    clearTimeout(timeoutId);

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }

                    const data = await response.json();

                    if (data.success && data.services && data.services.length > 0) {
                        displayServices(data.services);
                        getEl('importServicesSection').style.display = 'block';
                        getEl('importServicesBtn').style.display = 'block';
                        getEl('importLoadingState').style.display = 'none';
                        btn.disabled = false;
                        btn.innerHTML = orig;

                        // Show toast notification instead of modal
                        const notif = document.createElement('div');
                        const cacheText = data.cached ? ' (từ cache)' : '';
                        notif.style.cssText =
                            'position: fixed; top: 20px; right: 20px; background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 16px 20px; border-radius: 4px; z-index: 9999; max-width: 350px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);';
                        notif.innerHTML = `<div style="display: flex; align-items: center; gap: 10px;"></div>
                            <i class="bx bx-check-circle" style="font-size: 24px;"></i>
                            <div>
                                <strong>a.services.length} dịch vụ</strong>
                                <small style="display: block; color: #155724; opacity: 0.8;">${cacheText}</small>
                            </div>
                        </div>`;
                        document.body.appendChild(notif);
                        setTimeout(() => notif.remove(), 3000);
                        return;
                    } else {
                        throw new Error('Không tìm thấy dịch vụ nào');
                    }
                } catch (error) {
                    lastError = error.message;
                    console.warn(`Attempt ${attempt}/${maxRetries} failed:`, error);

                    if (attempt < maxRetries) {
                        const waitTime = Math.pow(2, attempt - 1) * 1000; // Exponential backoff: 1s, 2s, 4s
                        btn.innerHTML =
                            `<i class="bx bx-loader-alt bx-spin me-2"></i>Thử lại trong ${waitTime / 1000}s...`;
                        await new Promise(resolve => setTimeout(resolve, waitTime));
                    }
                }
            }

            // All retries failed
            getEl('importLoadingState').style.display = 'none';
            btn.disabled = false;
            btn.innerHTML = orig;

            // Show error toast notification instead of modal
            const errorNotif = document.createElement('div');
            errorNotif.style.cssText =
                'position: fixed; top: 20px; right: 20px; background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 16px 20px; border-radius: 4px; z-index: 9999; max-width: 350px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);';
            errorNotif.innerHTML = `<div style="display: flex; align-items: flex-start; gap: 10px;">
                <i class="bx bx-x-circle" style="font-size: 24px; flex-shrink: 0;"></i>
                <div>
                    <strong>Tải thất bại</strong>
                    <small style="display: block; color: #721c24; opacity: 0.8; margin-top: 4px;">Sau ${maxRetries} lần thử</small>
                    <small style="display: block; color: #721c24; opacity: 0.7; margin-top: 4px;">${lastError}</small>
                </div>
            </div>`;
            document.body.appendChild(errorNotif);
            setTimeout(() => errorNotif.remove(), 4000);
        };

        // Import services function (now separate from loading)
        window.importServices = () => {
            if (selectedServices.size === 0) {
                showToast('warning', 'Vui lòng chọn ít nhất một dịch vụ để import');
                return;
            }

            const categoryId = getEl('import_category_id').value;
            const providerId = getEl('import_provider_id').value;

            if (!categoryId) {
                showToast('warning', 'Vui lòng chọn danh mục trước khi import');
                return;
            }

            if (!providerId) {
                showToast('warning', 'Vui lòng chọn nhà cung cấp trước khi import');
                return;
            }

            // Show confirmation dialog
            alertify.confirm(
                'Xác nhận import',
                `Bạn có chắc chắn muốn import ${selectedServices.size} dịch vụ đã chọn?`,
                function() {
                    // User confirmed, proceed with import
                    performImport();
                },
                function() {
                    // User cancelled
                    showToast('info', 'Đã hủy import');
                }
            );
        };

        // Display services in hierarchical structure like the image
        const displayServices = (services) => {
            const tbody = getEl('servicesTableBody');
            tbody.innerHTML = '';
            selectedServices.clear();

            // Group services by category if available
            const groupedServices = {};
            services.forEach(service => {
                const categoryName = service.category || 'Uncategorized';
                if (!groupedServices[categoryName]) {
                    groupedServices[categoryName] = [];
                }
                groupedServices[categoryName].push(service);
            });

            // Display services grouped by category
            Object.keys(groupedServices).forEach(categoryName => {
                // Add category header row
                const categoryRow = document.createElement('tr');
                categoryRow.className = 'category-header-row bg-light';
                categoryRow.innerHTML = `
                    <td colspan="8" class="py-2">
                        <div class="d-flex align-items-center">
                            <div class="form-check me-2">
                                <input class="form-check-input category-checkbox" type="checkbox" 
                                       data-category-name="${categoryName}" 
                                       onchange="toggleCategoryServices('${categoryName}')">
                            </div>
                            <strong class="text-primary">${categoryName}</strong>
                            <span class="badge bg-primary ms-2">${groupedServices[categoryName].length} services</span>
                        </div>
                    </td>
                `;
                tbody.appendChild(categoryRow);

                // Add services for this category
                groupedServices[categoryName].forEach(service => {
                    const rateOriginal = parseFloat(service.rate);

                    // Calculate rates using the correct formula: rate_api * rate_up / 100
                    const rateRetail = (rateOriginal * markupConfig.markup_retail / 100)
                        .toFixed(4);
                    const rateAgent = (rateOriginal * markupConfig.markup_agent / 100).toFixed(
                        4);
                    const rateDistributor = (rateOriginal * markupConfig.markup_distributor /
                        100).toFixed(4);

                    const row = document.createElement('tr');
                    row.className = 'import-service-row';
                    row.setAttribute('data-service-id', service.id);
                    row.setAttribute('data-category-name', categoryName);
                    row.innerHTML = `
                        <td class="text-center">
                            <div class="form-check">
                                <input class="form-check-input service-checkbox" type="checkbox" 
                                       value="${service.id}" onchange="toggleService(${service.id})">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="service-id-container">
                                <span class="service-id">${service.id}</span>
                                ${service.type ? `<div class="service-type-badge mt-1"><span>${service.type}</span></div>` : ''}
                            </div>
                        </td>
                        <td>
                            <div class="service-info">
                                <div class="service-name">${service.name}</div>
                                ${service.description ? `<small class="service-description text-muted">${service.description}</small>` : ''}
                                <div class="service-features mt-1">
                                    ${service.cancel ? '<span class="badge bg-warning text-dark me-1"><i class="bx bx-block"></i> Cancel</span>' : ''}
                                    ${service.refill ? '<span class="badge bg-success me-1"><i class="bx bx-refresh"></i> Refill</span>' : ''}
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="api-rate-badge" data-service-id="${service.id}">$${rateOriginal.toFixed(4)}</span>
                        </td>
                        <td class="text-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input sync-checkbox" type="checkbox" checked 
                                       data-service-id="${service.id}" onchange="toggleSync(${service.id})">
                            </div>
                        </td>
                        <td class="text-center px-2">
                            <div class="input-group input-group-sm rate-input-group">
                                <input type="text" class="form-control rate-field bg-light" id="rate-retail-${service.id}" 
                                       value="${rateRetail}" readonly data-service-id="${service.id}" data-rate-type="retail"
                                       onchange="updateRateUpFromRate(${service.id}, 'retail')" placeholder="0.00">
                                <input type="number" class="form-control rate-up-field" 
                                       id="rate-retail-up-${service.id}" value="${markupConfig.markup_retail}" 
                                       step="0.01" min="0" max="1000" data-service-id="${service.id}" data-rate-type="retail" 
                                       onchange="updateRateFromUp(${service.id}, 'retail')" 
                                       oninput="updateRateFromUp(${service.id}, 'retail')" placeholder="0">
                                <span class="input-group-text">%</span>
                            </div>
                        </td>
                        <td class="text-center px-2">
                            <div class="input-group input-group-sm rate-input-group">
                                <input type="text" class="form-control rate-field bg-light" id="rate-agent-${service.id}" 
                                       value="${rateAgent}" readonly data-service-id="${service.id}" data-rate-type="agent"
                                       onchange="updateRateUpFromRate(${service.id}, 'agent')" placeholder="0.00">
                                <input type="number" class="form-control rate-up-field" 
                                       id="rate-agent-up-${service.id}" value="${markupConfig.markup_agent}" 
                                       step="0.01" min="0" max="1000" data-service-id="${service.id}" data-rate-type="agent" 
                                       onchange="updateRateFromUp(${service.id}, 'agent')" 
                                       oninput="updateRateFromUp(${service.id}, 'agent')" placeholder="0">
                                <span class="input-group-text">%</span>
                            </div>
                        </td>
                        <td class="text-center px-2">
                            <div class="input-group input-group-sm rate-input-group">
                                <input type="text" class="form-control rate-field bg-light" id="rate-distributor-${service.id}" 
                                       value="${rateDistributor}" readonly data-service-id="${service.id}" data-rate-type="distributor"
                                       onchange="updateRateUpFromRate(${service.id}, 'distributor')" placeholder="0.00">
                                <input type="number" class="form-control rate-up-field" 
                                       id="rate-distributor-up-${service.id}" value="${markupConfig.markup_distributor}" 
                                       step="0.01" min="0" max="1000" data-service-id="${service.id}" data-rate-type="distributor" 
                                       onchange="updateRateFromUp(${service.id}, 'distributor')" 
                                       oninput="updateRateFromUp(${service.id}, 'distributor')" placeholder="0">
                                <span class="input-group-text">%</span>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            });

            updateSelectedCount();
        };

        // Service selection functions
        window.toggleService = (serviceId) => {
            const checkbox = document.querySelector(`input.service-checkbox[value="${serviceId}"]`);
            if (!checkbox) {
                console.error('Checkbox not found for service:', serviceId);
                return;
            }
            
            const row = checkbox.closest('tr');
            if (!row) {
                console.error('Row not found for service:', serviceId);
                return;
            }
            
            const categoryName = row.getAttribute('data-category-name');

            if (checkbox.checked) {
                selectedServices.add(serviceId);
                row.classList.add('selected');
            } else {
                selectedServices.delete(serviceId);
                row.classList.remove('selected');
            }

            // Update category checkbox state
            if (categoryName) {
                const categoryCheckbox = document.querySelector(
                    `.category-checkbox[data-category-name="${categoryName}"]`);
                const allServicesInCategory = document.querySelectorAll(
                    `#servicesTableBody tr[data-category-name="${categoryName}"] .service-checkbox`);
                const allChecked = Array.from(allServicesInCategory).every(cb => cb.checked);

                if (categoryCheckbox) {
                    categoryCheckbox.checked = allChecked;
                }
            }

            updateSelectedCount();
            updateSelectAllCheckbox();
        };

        window.selectAllServices = () => {
            document.querySelectorAll('.service-checkbox').forEach(checkbox => {
                checkbox.checked = true;
                const serviceId = parseInt(checkbox.value);
                selectedServices.add(serviceId);
                checkbox.closest('tr').classList.add('selected');
            });
            updateSelectedCount();
            updateSelectAllCheckbox();
        };

        window.deselectAllServices = () => {
            document.querySelectorAll('.service-checkbox').forEach(checkbox => {
                checkbox.checked = false;
                const serviceId = parseInt(checkbox.value);
                selectedServices.delete(serviceId);
                checkbox.closest('tr').classList.remove('selected');
            });
            updateSelectedCount();
            updateSelectAllCheckbox();
        };

        window.toggleAllServices = () => {
            const selectAllCheckbox = getEl('selectAllCheckbox');
            if (selectAllCheckbox.checked) {
                selectAllServices();
            } else {
                deselectAllServices();
            }
        };

        const updateSelectedCount = () => {
            getEl('selectedCount').textContent = selectedServices.size;
        };

        // Toggle all services in a category
        window.toggleCategoryServices = (categoryName) => {
            const categoryCheckbox = document.querySelector(
                `.category-checkbox[data-category-name="${categoryName}"]`);

            if (!categoryCheckbox) {
                console.error('Category checkbox not found for:', categoryName);
                return;
            }

            const isChecked = categoryCheckbox.checked;

            // Find all service rows with matching category name
            const serviceRows = document.querySelectorAll(
                `#servicesTableBody tr[data-category-name]`);

            serviceRows.forEach(row => {
                if (row.getAttribute('data-category-name') === categoryName) {
                    const checkbox = row.querySelector('.service-checkbox');
                    if (checkbox) {
                        checkbox.checked = isChecked;
                        const serviceId = parseInt(checkbox.value);

                        if (isChecked) {
                            selectedServices.add(serviceId);
                            row.classList.add('selected');
                        } else {
                            selectedServices.delete(serviceId);
                            row.classList.remove('selected');
                        }
                    }
                }
            });

            updateSelectedCount();
        };

        // Sync toggle function
        window.toggleSync = (serviceId) => {
            const syncCheckbox = document.querySelector(`input[data-service-id="${serviceId}"].sync-checkbox`);
            const rateFields = document.querySelectorAll(`input[data-service-id="${serviceId}"].rate-field`);

            if (syncCheckbox.checked) {
                // Sync ON: rate fields readonly, only rate_up editable
                rateFields.forEach(field => {
                    field.readOnly = true;
                    field.classList.add('bg-light');
                });

                // Auto-calculate all rates when sync is turned ON
                updateAllRatesFromUp(serviceId);

                console.log(`Sync enabled for service ${serviceId} - rates auto-calculated`);
            } else {
                // Sync OFF: rate fields editable
                rateFields.forEach(field => {
                    field.readOnly = false;
                    field.classList.remove('bg-light');
                });

                console.log(`Sync disabled for service ${serviceId} - rates manually editable`);
            }
        };

        // Update rate from rate_up calculation
        window.updateRateFromUp = (serviceId, rateType) => {
            const rateUpField = document.getElementById(`rate-${rateType}-up-${serviceId}`);
            const rateField = document.getElementById(`rate-${rateType}-${serviceId}`);
            const syncCheckbox = document.querySelector(`input[data-service-id="${serviceId}"].sync-checkbox`);

            if (!rateUpField || !rateField) {
                console.error(`Missing fields for service ${serviceId}, rate type ${rateType}`);
                return;
            }

            // Always auto-calculate when rate_up changes (regardless of sync status for import)
            const rateUp = parseFloat(rateUpField.value) || 0;

            // Get rate_original from badge, remove $ symbol if present
            const rateOriginalElement = document.querySelector(
                `span.api-rate-badge[data-service-id="${serviceId}"]`);
            let rateOriginalText = rateOriginalElement?.textContent || '0';

            // Remove $ symbol if present
            if (rateOriginalText.startsWith('$')) {
                rateOriginalText = rateOriginalText.substring(1);
            }

            const rateOriginal = parseFloat(rateOriginalText) || 0;

            console.log(`Updating rate for service ${serviceId}, type ${rateType}:`, {
                rateUp: rateUp,
                rateOriginal: rateOriginal,
                rateOriginalText: rateOriginalText,
                syncChecked: syncCheckbox?.checked
            });

            if (rateOriginal > 0 && rateUp >= 0) {
                // Formula: rate = rate_original * rate_up / 100
                const calculatedRate = (rateOriginal * rateUp / 100).toFixed(4);
                rateField.value = calculatedRate;

                // Add visual feedback
                rateField.classList.add('auto-calculated');
                setTimeout(() => {
                    rateField.classList.remove('auto-calculated');
                }, 1000);

                console.log(
                    `Rate calculated for ${rateType}: ${rateOriginal} * ${rateUp}% / 100 = ${calculatedRate}`
                );
            } else {
                console.warn(`Invalid values for calculation: rateOriginal=${rateOriginal}, rateUp=${rateUp}`);
            }
        };

        // Update ALL rates when ANY rate_up changes (when sync is ON) - REMOVED
        // This function is no longer needed as each rate_up field updates its own rate individually

        // Update rate_up from direct rate input (when sync is OFF)
        window.updateRateUpFromRate = (serviceId, rateType) => {
            const rateField = document.getElementById(`rate-${rateType}-${serviceId}`);
            const rateUpField = document.getElementById(`rate-${rateType}-up-${serviceId}`);
            const syncCheckbox = document.querySelector(`input[data-service-id="${serviceId}"].sync-checkbox`);

            if (!rateField || !rateUpField || !syncCheckbox) return;

            // Only calculate rate_up if sync is OFF and user manually changed rate
            if (!syncCheckbox.checked) {
                const rate = parseFloat(rateField.value) || 0;

                // Get rate_original from badge, remove $ symbol if present
                const rateOriginalElement = document.querySelector(
                    `span.api-rate-badge[data-service-id="${serviceId}"]`);
                let rateOriginalText = rateOriginalElement?.textContent || '0';

                // Remove $ symbol if present
                if (rateOriginalText.startsWith('$')) {
                    rateOriginalText = rateOriginalText.substring(1);
                }

                const rateOriginal = parseFloat(rateOriginalText) || 0;

                if (rateOriginal > 0 && rate >= 0) {
                    // Formula: rate_up = (rate / rate_original) * 100
                    const calculatedRateUp = ((rate / rateOriginal) * 100).toFixed(2);
                    rateUpField.value = calculatedRateUp;

                    // Add visual feedback
                    rateUpField.classList.add('auto-calculated');
                    setTimeout(() => {
                        rateUpField.classList.remove('auto-calculated');
                    }, 1000);

                    console.log(
                        `Rate up calculated for ${rateType}: (${rate} / ${rateOriginal}) * 100 = ${calculatedRateUp}%`
                    );
                }
            }
        };

        const updateSelectAllCheckbox = () => {
            const selectAllCheckbox = getEl('selectAllCheckbox');
            const totalCheckboxes = document.querySelectorAll('.service-checkbox').length;

            if (selectedServices.size === 0) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = false;
            } else if (selectedServices.size === totalCheckboxes) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = true;
            } else {
                selectAllCheckbox.indeterminate = true;
                selectAllCheckbox.checked = false;
            }
        };

        window.cancelImport = () => {
            getEl('importServicesSection').style.display = 'none';
            getEl('importServicesBtn').style.display = 'none';
            selectedServices.clear();
        };

        window.confirmImport = () => {
            if (selectedServices.size === 0) {
                showToast('warning', 'Vui lòng chọn ít nhất một dịch vụ để import');
                return;
            }

            const categoryId = getEl('import_category_id').value;
            const providerId = getEl('import_provider_id').value;

            if (!categoryId) {
                showToast('warning', 'Vui lòng chọn danh mục trước khi import');
                return;
            }

            if (!providerId) {
                showToast('warning', 'Vui lòng chọn nhà cung cấp trước khi import');
                return;
            }

            // Directly perform import without confirmation dialog
            performImport();
        };

        const performImport = () => {
            const btn = getEl('importServicesBtn');
            const orig = btn.innerHTML;
            btn.disabled = true;

            const servicesArray = Array.from(selectedServices);
            let totalImported = 0,
                totalErrors = 0;
            const total = servicesArray.length;
            let currentIndex = 0;

            const importSingleService = async () => {
                if (currentIndex >= total) {
                    complete();
                    return;
                }

                const serviceId = servicesArray[currentIndex];
                const progressPercent = Math.round(((currentIndex + 1) / total) * 100);
                btn.innerHTML =
                    `<i class="bx bx-loader-alt bx-spin me-1"></i>Đang import... ${currentIndex + 1}/${total} (${progressPercent}%)`;

                try {
                    const serviceData = {
                        service_id: serviceId,
                        rate_retail: parseFloat(document.getElementById(`rate-retail-${serviceId}`)
                            ?.value) || 0,
                        rate_agent: parseFloat(document.getElementById(`rate-agent-${serviceId}`)
                            ?.value) || 0,
                        rate_distributor: parseFloat(document.getElementById(
                            `rate-distributor-${serviceId}`)?.value) || 0,
                        rate_retail_up: parseFloat(document.getElementById(
                                `rate-retail-up-${serviceId}`)?.value) || markupConfig
                            .markup_retail,
                        rate_agent_up: parseFloat(document.getElementById(
                            `rate-agent-up-${serviceId}`)?.value) || markupConfig.markup_agent,
                        rate_distributor_up: parseFloat(document.getElementById(
                                `rate-distributor-up-${serviceId}`)?.value) || markupConfig
                            .markup_distributor,
                        sync_enabled: document.querySelector(
                                `input[data-service-id="${serviceId}"].sync-checkbox`)?.checked ||
                            false
                    };

                    const response = await fetch('/admin/services/import', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                ?.getAttribute('content')
                        },
                        body: JSON.stringify({
                            category_id: getEl('import_category_id').value,
                            provider_id: getEl('import_provider_id').value,
                            services: [serviceId],
                            services_data: [serviceData],
                            markup_config: markupConfig,
                            batch_index: 0
                        })
                    });

                    const data = await response.json();

                    if (data.success && data.data) {
                        totalImported += data.data.imported_count;
                        totalErrors += data.data.error_count;

                        if (data.data.imported_count > 0) {
                            // Show success notification with icon (like original)
                            const notif = document.createElement('div');
                            notif.style.cssText =
                                'position: fixed; top: 20px; right: 20px; background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 12px 16px; border-radius: 4px; z-index: 9999; max-width: 300px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);';
                            notif.innerHTML =
                                `<i class="bx bx-check-circle" style="margin-right: 8px;"></i><strong>Service ${serviceId}</strong> imported`;
                            document.body.appendChild(notif);
                            setTimeout(() => notif.remove(), 2000);

                            // Remove service row from table
                            const serviceRow = document.querySelector(
                                `tr[data-service-id="${serviceId}"]`);
                            if (serviceRow) {
                                serviceRow.style.transition = 'opacity 0.3s ease';
                                serviceRow.style.opacity = '0';
                                setTimeout(() => serviceRow.remove(), 300);
                            }
                        }
                        if (data.data.errors && data.data.errors.length > 0) {
                            // Show error notification
                            const notif = document.createElement('div');
                            notif.style.cssText =
                                'position: fixed; top: 20px; right: 20px; background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px 16px; border-radius: 4px; z-index: 9999; max-width: 300px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);';
                            notif.innerHTML =
                                `<i class="bx bx-x-circle" style="margin-right: 8px;"></i><strong>Service ${serviceId}:</strong> ${data.data.errors[0]}`;
                            document.body.appendChild(notif);
                            setTimeout(() => notif.remove(), 3000);
                        }
                    } else {
                        totalErrors++;
                        const notif = document.createElement('div');
                        notif.style.cssText =
                            'position: fixed; top: 20px; right: 20px; background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px 16px; border-radius: 4px; z-index: 9999; max-width: 300px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);';
                        notif.innerHTML =
                            `<i class="bx bx-x-circle" style="margin-right: 8px;"></i><strong>Service ${serviceId}:</strong> ${data.message || 'Import failed'}`;
                        document.body.appendChild(notif);
                        setTimeout(() => notif.remove(), 3000);
                    }
                } catch (error) {
                    totalErrors++;
                    const notif = document.createElement('div');
                    notif.style.cssText =
                        'position: fixed; top: 20px; right: 20px; background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px 16px; border-radius: 4px; z-index: 9999; max-width: 300px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);';
                    notif.innerHTML =
                        `<i class="bx bx-x-circle" style="margin-right: 8px;"></i><strong>Service ${serviceId}:</strong> ${error.message}`;
                    document.body.appendChild(notif);
                    setTimeout(() => notif.remove(), 3000);
                }

                currentIndex++;
                // Delay 300ms between each service import to avoid server overload
                setTimeout(importSingleService, 300);
            };

            const complete = () => {
                btn.disabled = false;
                btn.innerHTML = orig;

                // Remove imported services from the table
                selectedServices.forEach(serviceId => {
                    const row = document.querySelector(`tr[data-service-id="${serviceId}"]`);
                    if (row) row.remove();
                });
                selectedServices.clear();

                // Check if there are remaining services
                const remainingServices = document.querySelectorAll('#servicesTableBody tr').length;

                // Show completion notification
                const successRate = total > 0 ? Math.round((totalImported / total) * 100) : 0;

                if (totalErrors === 0) {
                    showToast('success',
                        `Hoàn thành!\n${totalImported}/${total} dịch vụ - Tỷ lệ: ${successRate}%`);
                } else {
                    showToast('warning',
                        `Hoàn thành!\nThành công: ${totalImported}/${total} - Lỗi: ${totalErrors} - Tỷ lệ: ${successRate}%`
                        );
                }

                // Hide services section only if no services remain
                if (remainingServices === 0) {
                    getEl('importServicesSection').style.display = 'none';
                    getEl('importServicesBtn').style.display = 'none';
                } else {
                    // Reset selected count
                    getEl('selectedCount').textContent = '0';
                    getEl('selectAllCheckbox').checked = false;
                }
            };

            importSingleService();
        };

        // Initialize on DOM ready
        document.addEventListener('DOMContentLoaded', function() {
            initImportProviderSelect();
            initImportCategorySelect();
        });

    })();
</script>
