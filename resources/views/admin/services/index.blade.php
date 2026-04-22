@extends('admin.layouts.app')

@section('title', 'Quản lý dịch vụ')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Quản lý dịch vụ',
                    'breadcrumb' => 'Dịch vụ',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title mb-0">Danh sách dịch vụ</h4>
                                        <p class="text-muted mb-0 mt-1">Quản lý tất cả dịch vụ trong hệ thống</p>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.services.import') }}" class="btn btn-outline-success">
                                                <i class="bx bx-import me-1"></i>Nhập dịch vụ
                                            </a>
                                            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                                                <i class="bx bx-plus me-1"></i>Thêm dịch vụ
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <!-- Filters -->


                                <!-- Bulk Actions Toolbar -->
                                <div id="bulkActionsToolbar" class="bulk-actions-toolbar mb-3" style="display: none;">
                                    <div class="card border-primary">
                                        <div class="card-body py-2">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-check me-3">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="masterCheckAll">
                                                            <label class="form-check-label fw-medium" for="masterCheckAll">
                                                                Chọn tất cả
                                                            </label>
                                                        </div>
                                                        <span class="badge bg-primary" id="selectedCount">0 đã chọn</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="d-flex gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-sm btn-success"
                                                            id="bulkActivate">
                                                            <i class="bx bx-check-circle me-1"></i>Kích hoạt
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-warning"
                                                            id="bulkDeactivate">
                                                            <i class="bx bx-x-circle me-1"></i>Vô hiệu hóa
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            id="bulkDelete">
                                                            <i class="bx bx-trash me-1"></i>Xóa
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            id="clearSelection">
                                                            <i class="bx bx-x me-1"></i>Bỏ chọn
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($services && $services->count() > 0)
                                    <!-- Table Container with Loader -->
                                    <div class="table-responsive position-relative">
                                        <!-- Table Loader Overlay -->
                                        <div id="tableLoader" class="table-loader-overlay" style="display: none;">
                                            <div class="loader-content">
                                                <div class="loading-animation">
                                                    <div class="service-icons">
                                                        <i class="bx bx-package service-icon" style="--delay: 0s;"></i>
                                                        <i class="bx bx-server service-icon" style="--delay: 0.2s;"></i>
                                                        <i class="bx bx-category service-icon" style="--delay: 0.4s;"></i>
                                                        <i class="bx bx-cog service-icon" style="--delay: 0.6s;"></i>
                                                    </div>
                                                    <div class="loading-progress">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                </div>
                                                <h6 class="text-primary mb-2 loading-title">Đang tải dịch vụ...</h6>
                                                <p class="text-muted small loading-subtitle">Vui lòng chờ trong giây lát</p>
                                            </div>
                                        </div>

                                        <!-- Hierarchical Services Display -->
                                        <div class="services-hierarchy">
                                            @foreach ($groupedServices as $platformName => $categories)
                                                <!-- Platform Header - Compact -->
                                                <div class="platform-group mb-3">
                                                    <div class="platform-header bg-light rounded py-2 px-3 mb-1">
                                                        <div class="d-flex align-items-center">
                                                            @php
                                                                $platform = $services->first(function ($s) use (
                                                                    $platformName,
                                                                ) {
                                                                    return (isset($s->category->platform->name)
                                                                        ? $s->category->platform->name
                                                                        : 'Others') === $platformName;
                                                                });
                                                                $platform =
                                                                    $platform && isset($platform->category->platform)
                                                                        ? $platform->category->platform
                                                                        : null;
                                                            @endphp

                                                            @if ($platform && $platform->image)
                                                                <img src="{{ $platform->image }}" alt="{{ $platformName }}"
                                                                    class="rounded me-2 platform-image"
                                                                    style="width: 24px; height: 24px; object-fit: cover; border: 1px solid #e9ecef; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                                                            @else
                                                                <div class="bg-primary rounded d-flex align-items-center justify-content-center me-2 platform-placeholder"
                                                                    style="width: 24px; height: 24px; border: 1px solid #e9ecef; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                                                                    <i class="bx bx-server text-white"
                                                                        style="font-size: 14px;"></i>
                                                                </div>
                                                            @endif

                                                            <div class="flex-grow-1">
                                                                <span class="fw-bold text-primary"
                                                                    style="font-size: 14px;">{{ $platformName }}</span>
                                                                <span class="text-muted ms-2"
                                                                    style="font-size: 11px;">{{ array_sum(array_map('count', $categories)) }}
                                                                    dịch vụ</span>
                                                            </div>

                                                            <button class="btn btn-sm btn-link p-0 platform-toggle"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#platform-{{ Str::slug($platformName) }}"
                                                                aria-expanded="true">
                                                                <i class="bx bx-chevron-down" style="font-size: 16px;"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Platform Content -->
                                                    <div class="collapse show" id="platform-{{ Str::slug($platformName) }}">
                                                        @foreach ($categories as $categoryName => $categoryServices)
                                                            <!-- Category Header - Compact -->
                                                            <div class="category-group ms-3 mb-2">
                                                                <div
                                                                    class="category-header border rounded py-1 px-2 mb-1">
                                                                    <div class="d-flex align-items-center">
                                                                        @php
                                                                            $category = isset(
                                                                                $categoryServices[0]->category,
                                                                            )
                                                                                ? $categoryServices[0]->category
                                                                                : null;
                                                                        @endphp

                                                                        <div class="category-indent me-2">
                                                                            <i class="bx bx-subdirectory-right text-muted"
                                                                                style="font-size: 12px;"></i>
                                                                        </div>

                                                                        @if ($category && $category->image)
                                                                            <img src="{{ $category->image }}"
                                                                                alt="{{ $categoryName }}"
                                                                                class="rounded me-2 category-image"
                                                                                style="width: 20px; height: 20px; object-fit: cover; border: 1px solid #dee2e6; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
                                                                        @else
                                                                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center me-2 category-placeholder"
                                                                                style="width: 20px; height: 20px; border: 1px solid #dee2e6; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
                                                                                <i class="bx bx-category text-white"
                                                                                    style="font-size: 12px;"></i>
                                                                            </div>
                                                                        @endif

                                                                        <div class="flex-grow-1">
                                                                            <span class="fw-medium"
                                                                                style="font-size: 13px;">{{ $categoryName }}</span>
                                                                            <span class="text-muted ms-2"
                                                                                style="font-size: 10px;">{{ count($categoryServices) }}
                                                                                dịch vụ</span>
                                                                        </div>

                                                                        <button
                                                                            class="btn btn-sm btn-link p-0 category-toggle"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#category-{{ Str::slug($platformName . '-' . $categoryName) }}"
                                                                            aria-expanded="true">
                                                                            <i class="bx bx-chevron-down"
                                                                                style="font-size: 14px;"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                                <!-- Services Table for this Category -->
                                                                <div class="collapse show"
                                                                    id="category-{{ Str::slug($platformName . '-' . $categoryName) }}">
                                                                    <div class="services-table ms-2">
                                                                        <div class="table-responsive">
                                                                            <table
                                                                                class="table align-middle datatable dt-responsive table-check nowrap"
                                                                                style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                                                                <thead>
                                                                                    <tr class="bg-transparent">
                                                                                        <th style="width: 30px;">
                                                                                            <div class="form-check font-size-16">
                                                                                                <input type="checkbox"
                                                                                                    name="check"
                                                                                                    class="form-check-input checkAll-{{ Str::slug($platformName . '-' . $categoryName) }}"
                                                                                                    id="checkAll-{{ Str::slug($platformName . '-' . $categoryName) }}">
                                                                                                <label class="form-check-label"
                                                                                                    for="checkAll-{{ Str::slug($platformName . '-' . $categoryName) }}"></label>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th style="width: 50px;"></th>
                                                                                        <th style="width: 80px;">ID</th>
                                                                                        <th>Dịch vụ</th>
                                                                                        <th style="width: 180px;">Giá bán</th>
                                                                                        <th style="width: 120px;">Provider</th>
                                                                                        <th style="width: 100px;">Min/Max</th>
                                                                                        <th style="width: 100px;">Trạng thái</th>
                                                                                        <th style="width: 140px;">Thao tác</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="sortable-services"
                                                                                    data-platform="{{ $platformName }}"
                                                                                    data-category="{{ $categoryName }}">
                                                                                    @foreach ($categoryServices as $service)
                                                                                        <tr class="service-row {{ (isset($service->status) ? $service->status : 0) == 0 ? 'service-disabled' : '' }}"
                                                                                            data-id="{{ $service->id }}"
                                                                                            data-position="{{ isset($service->position) ? $service->position : 0 }}"
                                                                                            data-status="{{ (isset($service->status) ? $service->status : 0) }}">
                                                                                            <!-- Checkbox -->
                                                                                            <td>
                                                                                                <div
                                                                                                    class="form-check font-size-12">
                                                                                                    <input type="checkbox"
                                                                                                        class="form-check-input service-checkbox category-checkbox-{{ Str::slug($platformName . '-' . $categoryName) }}"
                                                                                                        value="{{ $service->id }}"
                                                                                                        data-platform="{{ $platformName }}"
                                                                                                        data-category="{{ $categoryName }}">
                                                                                                </div>
                                                                                            </td>

                                                                                            <!-- Drag Handle -->
                                                                                            <td class="text-center drag-handle align-middle"
                                                                                                style="cursor: grab;">
                                                                                                <div class="drag-icon d-flex justify-content-center">
                                                                                                    <i class="bx bx-menu text-muted"
                                                                                                        style="font-size: 18px;"></i>
                                                                                                </div>
                                                                                            </td>

                                                                                            <!-- Service ID -->
                                                                                            <td>
                                                                                                <div class="text-center">
                                                                                                    <a href="javascript:void(0);"
                                                                                                        class="text-body fw-medium"
                                                                                                        onclick="showServiceModal({{ $service->id }})">#{{ $service->id }}</a>
                                                                                                    @if ($service->type_service)
                                                                                                        <div
                                                                                                            class="mt-1">
                                                                                                            <span
                                                                                                                class="font-size-11">{{ $service->type_service }}</span>
                                                                                                        </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </td>

                                                                                            <!-- Service Name & Details -->
                                                                                            <td>
                                                                                                <div>
                                                                                                    @php
                                                                                                        // Get user's language preference, default to 'en'
$userLang = isset(
    auth()->user()
        ->lang,
)
    ? auth()->user()
        ->lang
    : 'en';
$serviceName =
    '';

if (
    $service->name
) {
    // If name is a JSON string, decode it first
    if (
        is_string(
            $service->name,
        )
    ) {
        $nameData = json_decode(
            $service->name,
            true,
        );
        if (
            json_last_error() ===
                JSON_ERROR_NONE &&
            is_array(
                $nameData,
            )
        ) {
            $service->name = $nameData;
        }
    }

    // Now handle the name data
    if (
        is_array(
            $service->name,
        )
    ) {
        // Try to get name in user's language first
                                                                                                                if (
                                                                                                                    isset(
                                                                                                                        $service
                                                                                                                            ->name[
                                                                                                                            $userLang
                                                                                                                        ],
                                                                                                                    ) &&
                                                                                                                    !empty(
                                                                                                                        trim(
                                                                                                                            $service
                                                                                                                                ->name[
                                                                                                                                $userLang
                                                                                                                            ],
                                                                                                                        )
                                                                                                                    )
                                                                                                                ) {
                                                                                                                    $serviceName =
                                                                                                                        $service
                                                                                                                            ->name[
                                                                                                                            $userLang
                                                                                                                        ];
                                                                                                                }
                                                                                                                // Fallback to English if user's language not available
        elseif (
            isset(
                $service
                    ->name[
                    'en'
                ],
            ) &&
            !empty(
                trim(
                    $service
                        ->name[
                        'en'
                    ],
                )
            )
        ) {
            $serviceName =
                $service
                    ->name[
                    'en'
                ];
        }
        // Fallback to first available language
        else {
            $firstValue = reset(
                $service->name,
            );
            $serviceName = !empty(
                trim(
                    $firstValue,
                )
            )
                ? $firstValue
                : '';
        }
    } else {
        // If name is not array (plain string), use it directly
        $serviceName = !empty(
            trim(
                $service->name,
            )
        )
            ? $service->name
            : '';
    }
}

// Clean up the service name - decode HTML entities and handle unicode
$serviceName = html_entity_decode(
    $serviceName,
    ENT_QUOTES,
    'UTF-8',
                                                                                                        );
                                                                                                    @endphp

                                                                                                    <div
                                                                                                        class="d-flex align-items-start">
                                                                                                        @if ($service->image)
                                                                                                            <img src="{{ $service->image }}"
                                                                                                                alt="{{ $serviceName }}"
                                                                                                                class="rounded me-2 service-image"
                                                                                                                style="width: 24px; height: 24px; object-fit: cover; border: 1px solid #e9ecef; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                                                                                                        @endif
                                                                                                        <div
                                                                                                            class="flex-grow-1">
                                                                                                            <h6
                                                                                                                class="mb-1 fw-medium">
                                                                                                                {{ $serviceName }}
                                                                                                            </h6>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <!-- Service Attributes -->
                                                                                                    @php
                                                                                                        // Handle attributes - could be JSON string or array
                                                                                                        $attributes = [];
                                                                                                        if (
                                                                                                            $service->attributes
                                                                                                        ) {
                                                                                                            if (
                                                                                                                is_string(
                                                                                                                    $service->attributes,
                                                                                                                )
                                                                                                            ) {
                                                                                                                $decoded = json_decode(
                                                                                                                    $service->attributes,
                                                                                                                    true,
                                                                                                                );
                                                                                                                if (
                                                                                                                    json_last_error() ===
                                                                                                                        JSON_ERROR_NONE &&
                                                                                                                    is_array(
                                                                                                                        $decoded,
                                                                                                                    )
                                                                                                                ) {
                                                                                                                    $attributes = $decoded;
                                                                                                                }
                                                                                                            } elseif (
                                                                                                                is_array(
                                                                                                                    $service->attributes,
                                                                                                                )
                                                                                                            ) {
                                                                                                                $attributes =
                                                                                                                    $service->attributes;
                                                                                                            }
                                                                                                        }
                                                                                                    @endphp

                                                                                                    @if (count($attributes) > 0)
                                                                                                        <div
                                                                                                            class="mb-1">
                                                                                                            @php
                                                                                                                $attrLabels = [
                                                                                                                    'owner' => [
                                                                                                                        'Chủ sở hữu',
                                                                                                                        'primary',
                                                                                                                    ],
                                                                                                                    'exclusive' => [
                                                                                                                        'Độc quyền',
                                                                                                                        'warning',
                                                                                                                    ],
                                                                                                                    'provider_direct' => [
                                                                                                                        'Nhà cung cấp trực tiếp',
                                                                                                                        'success',
                                                                                                                    ],
                                                                                                                    'new' => [
                                                                                                                        'Mới',
                                                                                                                        'success',
                                                                                                                    ],
                                                                                                                    'best_seller' => [
                                                                                                                        'Bán chạy',
                                                                                                                        'danger',
                                                                                                                    ],
                                                                                                                    'promotion' => [
                                                                                                                        'Khuyến mãi',
                                                                                                                        'success',
                                                                                                                    ],
                                                                                                                    'recommend' => [
                                                                                                                        'Đề xuất',
                                                                                                                        'primary',
                                                                                                                    ],
                                                                                                                    'instant' => [
                                                                                                                        'Tức thì',
                                                                                                                        'info',
                                                                                                                    ],
                                                                                                                    'super_fast' => [
                                                                                                                        'Siêu nhanh',
                                                                                                                        'info',
                                                                                                                    ],
                                                                                                                    'real' => [
                                                                                                                        'Thật',
                                                                                                                        'primary',
                                                                                                                    ],
                                                                                                                    'lifetime' => [
                                                                                                                        'Trọn đời',
                                                                                                                        'dark',
                                                                                                                    ],
                                                                                                                    'refill_7_days' => [
                                                                                                                        'BH 7 ngày',
                                                                                                                        'info',
                                                                                                                    ],
                                                                                                                    'refill_15_days' => [
                                                                                                                        'BH 15 ngày',
                                                                                                                        'info',
                                                                                                                    ],
                                                                                                                    'refill_30_days' => [
                                                                                                                        'BH 30 ngày',
                                                                                                                        'warning',
                                                                                                                    ],
                                                                                                                    'refill_60_days' => [
                                                                                                                        'BH 60 ngày',
                                                                                                                        'warning',
                                                                                                                    ],
                                                                                                                    'refill_90_days' => [
                                                                                                                        'BH 90 ngày',
                                                                                                                        'warning',
                                                                                                                    ],
                                                                                                                    'refill_365_days' => [
                                                                                                                        'BH 365 ngày',
                                                                                                                        'danger',
                                                                                                                    ],
                                                                                                                    'no_refill' => [
                                                                                                                        'Không bảo hành',
                                                                                                                        'secondary',
                                                                                                                    ],
                                                                                                                    'auto_refill' => [
                                                                                                                        'Tự động bảo hành',
                                                                                                                        'success',
                                                                                                                    ],
                                                                                                                    'no_refund' => [
                                                                                                                        'Không hoàn tiền',
                                                                                                                        'secondary',
                                                                                                                    ],
                                                                                                                    'refill_button' => [
                                                                                                                        'Nút bảo hành',
                                                                                                                        'info',
                                                                                                                    ],
                                                                                                                    'cancel_button' => [
                                                                                                                        'Nút hủy',
                                                                                                                        'warning',
                                                                                                                    ],
                                                                                                                    'direct' => [
                                                                                                                        'Trực tiếp',
                                                                                                                        'success',
                                                                                                                    ],
                                                                                                                ];
                                                                                                            @endphp
                                                                                                            @foreach ($attributes as $attr)
                                                                                                                @if (isset($attrLabels[$attr]))
                                                                                                                    <span
                                                                                                                        class="badge badge-soft-{{ $attrLabels[$attr][1] }} font-size-10 me-1">{{ $attrLabels[$attr][0] }}</span>
                                                                                                                @else
                                                                                                                    <span
                                                                                                                        class="badge badge-soft-secondary font-size-10 me-1">{{ ucfirst($attr) }}</span>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    @endif

                                                                                                    <!-- Features -->
                                                                                                    <div
                                                                                                        class="d-flex align-items-center flex-wrap gap-1">
                                                                                                        @if ($service->cancel == 1)
                                                                                                            <span
                                                                                                                class="badge badge-soft-warning font-size-10">
                                                                                                                <i
                                                                                                                    class="bx bx-block me-1"></i>Hủy
                                                                                                                được
                                                                                                            </span>
                                                                                                        @endif
                                                                                                        @if ($service->refill == 1)
                                                                                                            <span
                                                                                                                class="badge badge-soft-success font-size-10">
                                                                                                                <i
                                                                                                                    class="bx bxs-droplet me-1"></i>Bảo
                                                                                                                hành
                                                                                                            </span>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>

                                                                                            <!-- Price -->
                                                                                            <td>
                                                                                                @php
                                                                                                    // Enhanced helper function to format rate - preserve precision, remove trailing zeros
                                                                                                    $formatRate = function (
                                                                                                        $rate,
                                                                                                    ) {
                                                                                                        if (
                                                                                                            !$rate ||
                                                                                                            $rate == 0
                                                                                                        ) {
                                                                                                            return '0';
                                                                                                        }

                                                                                                        // Convert to float to handle string inputs
                                                                                                        $rate = (float) $rate;

                                                                                                        // Format to maximum 6 decimal places to preserve precision
                                                                                                        $formatted = number_format(
                                                                                                            $rate,
                                                                                                            6,
                                                                                                            '.',
                                                                                                            '',
                                                                                                        );

                                                                                                        // Remove trailing zeros but keep at least one decimal if needed
                                                                                                        $formatted = rtrim(
                                                                                                            $formatted,
                                                                                                            '0',
                                                                                                        );
                                                                                                        $formatted = rtrim(
                                                                                                            $formatted,
                                                                                                            '.',
                                                                                                        );

                                                                                                        // If result is empty or just a dot, return 0
                                                                                                        return $formatted ?:
                                                                                                            '0';
                                                                                                    };
                                                                                                @endphp
                                                                                                <div class="rates-display">
                                                                                                    <!-- Top Rates (Horizontal) -->
                                                                                                    @if ($service->rate_retail || $service->rate_agent || $service->rate_distributor)
                                                                                                        <div
                                                                                                            class="top-rates text-center mb-2">
                                                                                                            @php
                                                                                                                $topRates = [];
                                                                                                                if (
                                                                                                                    $service->rate_retail
                                                                                                                ) {
                                                                                                                    $topRates[] =
                                                                                                                        '<span class="text-success fw-medium">$' .
                                                                                                                        $formatRate(
                                                                                                                            $service->rate_retail,
                                                                                                                        ) .
                                                                                                                        '</span>';
                                                                                                                }
                                                                                                                if (
                                                                                                                    $service->rate_agent
                                                                                                                ) {
                                                                                                                    $topRates[] =
                                                                                                                        '<span class="text-info fw-medium">$' .
                                                                                                                        $formatRate(
                                                                                                                            $service->rate_agent,
                                                                                                                        ) .
                                                                                                                        '</span>';
                                                                                                                }
                                                                                                                if (
                                                                                                                    $service->rate_distributor
                                                                                                                ) {
                                                                                                                    $topRates[] =
                                                                                                                        '<span class="text-primary fw-medium">$' .
                                                                                                                        $formatRate(
                                                                                                                            $service->rate_distributor,
                                                                                                                        ) .
                                                                                                                        '</span>';
                                                                                                                }
                                                                                                            @endphp
                                                                                                            <div class="horizontal-rates"
                                                                                                                style="font-size: 12px; font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;">
                                                                                                                {!! implode(' - ', $topRates) !!}
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endif

                                                                                                    <!-- Rate Original (Bottom) -->
                                                                                                    @if ($service->rate_original)
                                                                                                        <div
                                                                                                            class="rate-original text-center">
                                                                                                            <div class="rate-value text-warning fw-medium"
                                                                                                                style="font-size: 11px; line-height: 1;">
                                                                                                                ${{ $formatRate($service->rate_original) }}
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endif

                                                                                                    @if (!$service->rate_original && !$service->rate_retail && !$service->rate_agent && !$service->rate_distributor)
                                                                                                        <div
                                                                                                            class="text-center text-muted">
                                                                                                            <small>Chưa có
                                                                                                                giá</small>
                                                                                                        </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </td>

                                                                                            <!-- Provider -->
                                                                                            <td>
                                                                                                <div class="provider-info">
                                                                                                    @if ($service->provider)
                                                                                                        @if ($service->service_api)
                                                                                                            <div
                                                                                                                class="service-api mt-1">
                                                                                                                <div
                                                                                                                    class="fw-medium text-muted small">
                                                                                                                    {{ $service->provider->name }}
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="text-primary fw-medium small">
                                                                                                                    {{ $service->service_api }}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    @else
                                                                                                        <div
                                                                                                            class="text-center text-muted">
                                                                                                            <small>-</small>
                                                                                                        </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </td>

                                                                                            <!-- Min/Max -->
                                                                                            <td>
                                                                                                <div class="text-center">
                                                                                                    <span
                                                                                                        class="fw-medium text-primary small">{{ number_format(isset($service->min) ? $service->min : 0) }}/{{ number_format(isset($service->max) ? $service->max : 0) }}</span>
                                                                                                </div>
                                                                                            </td>

                                                                                            <!-- Status -->
                                                                                            <td>
                                                                                                <div
                                                                                                    class="d-flex align-items-center justify-content-center">
                                                                                                    <div
                                                                                                        class="form-check form-switch mb-0">
                                                                                                        <input
                                                                                                            class="form-check-input status-toggle"
                                                                                                            type="checkbox"
                                                                                                            data-service-id="{{ $service->id }}"
                                                                                                            {{ (isset($service->status) ? $service->status : 0) == 1 ? 'checked' : '' }}>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>

                                                                                            <!-- Actions -->
                                                                                            <td>
                                                                                                <div class="d-flex gap-2">
                                                                                                    <!-- Nút Xem -->
                                                                                                    <button type="button"
                                                                                                        class="btn btn-sm btn-outline-info"
                                                                                                        title="Xem thông tin"
                                                                                                        onclick="showServiceModal({{ $service->id }})">
                                                                                                        <i
                                                                                                            class="bx bx-show"></i>
                                                                                                    </button>

                                                                                                    <!-- Nút Sửa -->
                                                                                                    <button type="button"
                                                                                                        class="btn btn-sm btn-outline-primary"
                                                                                                        title="Chỉnh sửa"
                                                                                                        onclick="editServiceModal({{ $service->id }})">
                                                                                                        <i
                                                                                                            class="bx bx-edit"></i>
                                                                                                    </button>

                                                                                                    <!-- Nút Xóa -->
                                                                                                    <button type="button"
                                                                                                        class="btn btn-sm btn-outline-danger delete-service-btn"
                                                                                                        title="Xóa dịch vụ"
                                                                                                        data-service-id="{{ $service->id }}"
                                                                                                        data-service-name="{{ $serviceName }}">
                                                                                                        <i
                                                                                                            class="bx bx-trash"></i>
                                                                                                    </button>

                                                                                                    <!-- Hidden delete form -->
                                                                                                    <form
                                                                                                        id="delete-form-{{ $service->id }}"
                                                                                                        action="{{ route('admin.services.destroy', $service) }}"
                                                                                                        method="POST"
                                                                                                        style="display: none;">
                                                                                                        @csrf
                                                                                                        @method('DELETE')
                                                                                                    </form>
                                                                                                    <form
                                                                                                        id="delete-form-{{ $service->id }}"
                                                                                                        action="{{ route('admin.services.destroy', $service) }}"
                                                                                                        method="POST"
                                                                                                        style="display: none;">
                                                                                                        @csrf
                                                                                                        @method('DELETE')
                                                                                                    </form>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <!-- Empty State -->
                                    <div class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bx bx-package" style="font-size: 48px; color: #dee2e6;"></i>
                                            <h5 class="text-muted mt-3">Không có dịch vụ</h5>
                                            <p class="text-muted mb-3">Chưa có dịch vụ nào được tạo.</p>
                                            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                                                <i class="bx bx-plus me-1"></i>Thêm dịch vụ
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('admin.services.show')
    @include('admin.services.edit')
    @include('admin.services.delete')
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize drag & drop for each category
            initializeSortable();

            // Status toggle functionality
            $(document).on('change', '.status-toggle', function() {
                const serviceId = $(this).data('service-id');
                const isChecked = $(this).is(':checked');
                const row = $(`.service-row[data-id="${serviceId}"]`);

                // Update UI immediately
                if (isChecked) {
                    row.removeClass('service-disabled');
                    row.attr('data-status', '1');
                } else {
                    row.addClass('service-disabled');
                    row.attr('data-status', '0');
                }

                // Send request to server
                $.ajax({
                    url: `/admin/services/${serviceId}/toggle-status`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('success', response.message);
                        } else {
                            showToast('error', response.message);
                            // Revert UI if server error
                            if (isChecked) {
                                row.addClass('service-disabled');
                                row.attr('data-status', '0');
                            } else {
                                row.removeClass('service-disabled');
                                row.attr('data-status', '1');
                            }
                            $(this).prop('checked', !isChecked);
                        }
                    },
                    error: function() {
                        showToast('error', 'Có lỗi xảy ra khi cập nhật trạng thái');
                        // Revert UI if network error
                        if (isChecked) {
                            row.addClass('service-disabled');
                            row.attr('data-status', '0');
                        } else {
                            row.removeClass('service-disabled');
                            row.attr('data-status', '1');
                        }
                        $(`.status-toggle[data-service-id="${serviceId}"]`).prop('checked', !isChecked);
                    }
                });
            });


            // Platform/Category toggle functionality - Optimized
            $(document).on('click', '.service-toggle, .category-toggle', function() {
                const icon = $(this).find('i');
                const target = $(this).data('bs-target');

                // Use requestAnimationFrame for better performance
                requestAnimationFrame(() => {
                    if ($(target).hasClass('show')) {
                        icon.removeClass('bx-chevron-right').addClass('bx-chevron-down');
                    } else {
                        icon.removeClass('bx-chevron-down').addClass('bx-chevron-right');
                    }
                });
            });
        });

        function initializeSortable() {
            $('.sortable-services').each(function() {
                const tbody = this;
                const platform = $(tbody).data('platform');
                const category = $(tbody).data('category');

                new Sortable(tbody, {
                    handle: '.drag-handle',
                    animation: 200,
                    ghostClass: 'sortable-ghost',
                    chosenClass: 'sortable-chosen',
                    dragClass: 'sortable-drag',
                    onStart: function(evt) {
                        document.body.style.cursor = 'grabbing';
                    },
                    onEnd: function(evt) {
                        document.body.style.cursor = '';

                        const serviceId = evt.item.dataset.id;
                        const newIndex = evt.newIndex;
                        const oldIndex = evt.oldIndex;

                        if (newIndex !== oldIndex) {
                            updateServicePosition(tbody, platform, category);
                        }
                    }
                });
            });
        }

        function updateServicePosition(tbody, platform, category) {
            showToast('info', 'Đang cập nhật thứ tự...');

            const serviceIds = [];
            $(tbody).find('tr').each(function(index) {
                serviceIds.push({
                    id: $(this).data('id'),
                    position: index + 1
                });
            });

            $.ajax({
                url: '{{ route('admin.services.index') }}',
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    action: 'reorder',
                    services: serviceIds,
                    platform: platform,
                    category: category
                },
                beforeSend: function() {
                    $(tbody).find('.drag-handle').css('pointer-events', 'none').addClass('updating');
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', 'Thứ tự đã được cập nhật thành công!');
                        $(tbody).find('tr').each(function(index) {
                            $(this).data('position', index + 1);
                        });
                    } else {
                        showToast('error', response.message || 'Có lỗi xảy ra khi cập nhật thứ tự!');
                    }
                },
                error: function() {
                    showToast('error', 'Có lỗi xảy ra khi cập nhật thứ tự!');
                },
                complete: function() {
                    $(tbody).find('.drag-handle').css('pointer-events', '').removeClass('updating');
                }
            });
        }

        // Optimized toast notification function
        function showToast(type, message, autoRemove = true) {
            // Only remove existing toasts if not loading type
            if (type !== 'info' || !message.includes('Đang')) {
                $('.toast-notification').remove();
            }

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
            toast.className =
                `alert alert-${colorMap[type] || 'info'} alert-dismissible fade show position-fixed toast-notification`;
            toast.style.cssText =
                'top: 20px; right: 20px; z-index: 9999; min-width: 300px; max-width: 400px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);';

            // Add loading spinner for info messages that contain "Đang"
            const isLoading = type === 'info' && message.includes('Đang');
            const spinnerHtml = isLoading ? '<div class="spinner-border spinner-border-sm me-2" role="status"></div>' : '';

            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    ${spinnerHtml}
                    <i class="bx ${iconMap[type] || 'bx-info-circle'} me-2" style="font-size: 18px;"></i>
                    <span>${message}</span>
                </div>
                ${!isLoading ? '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' : ''}
            `;

            document.body.appendChild(toast);

            // Auto remove based on type and autoRemove parameter
            if (autoRemove) {
                const duration = type === 'error' ? 6000 : (type === 'info' ? 3000 : 4000);
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.style.transition = 'opacity 0.3s';
                        toast.style.opacity = '0';
                        setTimeout(() => toast.remove(), 300);
                    }
                }, duration);
            }

            return toast; // Return the toast element for manual control
        }

        // ===== BULK ACTIONS & CHECKALL FUNCTIONALITY =====

        // Initialize bulk actions
        function initBulkActions() {
            const masterCheckAll = document.getElementById('masterCheckAll');
            const bulkToolbar = document.getElementById('bulkActionsToolbar');
            const selectedCountEl = document.getElementById('selectedCount');

            // Update selected count and toolbar visibility
            function updateBulkToolbar() {
                const checkedBoxes = document.querySelectorAll('.service-checkbox:checked');
                const count = checkedBoxes.length;

                if (count > 0) {
                    bulkToolbar.style.display = 'block';
                    selectedCountEl.textContent = `${count} đã chọn`;

                    // Update master checkbox state
                    const allBoxes = document.querySelectorAll('.service-checkbox');
                    if (count === allBoxes.length) {
                        masterCheckAll.checked = true;
                        masterCheckAll.indeterminate = false;
                    } else {
                        masterCheckAll.checked = false;
                        masterCheckAll.indeterminate = true;
                    }
                } else {
                    bulkToolbar.style.display = 'none';
                    masterCheckAll.checked = false;
                    masterCheckAll.indeterminate = false;
                }
            }

            // Master check all functionality
            masterCheckAll?.addEventListener('change', function() {
                const isChecked = this.checked;
                document.querySelectorAll('.service-checkbox').forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
                updateBulkToolbar();
            });

            // Category check all functionality
            document.addEventListener('change', function(e) {
                if (e.target.matches('[class*="checkAll-"]')) {
                    const isChecked = e.target.checked;
                    const categoryClass = e.target.className.match(/checkAll-([^\s]+)/)[1];

                    document.querySelectorAll(`.category-checkbox-${categoryClass}`).forEach(checkbox => {
                        checkbox.checked = isChecked;
                    });
                    updateBulkToolbar();
                }
            });

            // Individual checkbox change
            document.addEventListener('change', function(e) {
                if (e.target.matches('.service-checkbox')) {
                    updateBulkToolbar();

                    // Update category checkAll state
                    const platformName = e.target.dataset.platform;
                    const categoryName = e.target.dataset.category;

                    if (platformName && categoryName) {
                        // Use the same slug generation as in Blade template
                        const categorySlug = (platformName + '-' + categoryName)
                            .toLowerCase()
                            .replace(/[^a-z0-9\-]/g, '-')
                            .replace(/-+/g, '-')
                            .replace(/^-|-$/g, '');

                        const categoryCheckboxes = document.querySelectorAll(`.category-checkbox-${categorySlug}`);
                        const categoryCheckAll = document.querySelector(`.checkAll-${categorySlug}`);

                        if (categoryCheckAll && categoryCheckboxes.length > 0) {
                            const checkedCount = Array.from(categoryCheckboxes).filter(cb => cb.checked).length;

                            if (checkedCount === 0) {
                                categoryCheckAll.checked = false;
                                categoryCheckAll.indeterminate = false;
                            } else if (checkedCount === categoryCheckboxes.length) {
                                categoryCheckAll.checked = true;
                                categoryCheckAll.indeterminate = false;
                            } else {
                                categoryCheckAll.checked = false;
                                categoryCheckAll.indeterminate = true;
                            }
                        }
                    }
                }
            });

            // Clear selection
            document.getElementById('clearSelection')?.addEventListener('click', function() {
                document.querySelectorAll('.service-checkbox:checked').forEach(checkbox => {
                    checkbox.checked = false;
                });
                document.querySelectorAll('[class*="checkAll-"]:checked').forEach(checkbox => {
                    checkbox.checked = false;
                });
                updateBulkToolbar();
            });

            // Bulk activate
            document.getElementById('bulkActivate')?.addEventListener('click', function() {
                const selectedIds = Array.from(document.querySelectorAll('.service-checkbox:checked'))
                    .map(cb => cb.value);

                if (selectedIds.length === 0) {
                    showToast('warning', 'Vui lòng chọn ít nhất một dịch vụ');
                    return;
                }

                bulkUpdateStatus(selectedIds, true, 'Kích hoạt');
            });

            // Bulk deactivate
            document.getElementById('bulkDeactivate')?.addEventListener('click', function() {
                const selectedIds = Array.from(document.querySelectorAll('.service-checkbox:checked'))
                    .map(cb => cb.value);

                if (selectedIds.length === 0) {
                    showToast('warning', 'Vui lòng chọn ít nhất một dịch vụ');
                    return;
                }

                bulkUpdateStatus(selectedIds, false, 'Vô hiệu hóa');
            });

            // Bulk delete
            document.getElementById('bulkDelete')?.addEventListener('click', function() {
                const selectedIds = Array.from(document.querySelectorAll('.service-checkbox:checked'))
                    .map(cb => cb.value);

                if (selectedIds.length === 0) {
                    showToast('warning', 'Vui lòng chọn ít nhất một dịch vụ');
                    return;
                }

                if (confirm(`Bạn có chắc chắn muốn xóa ${selectedIds.length} dịch vụ đã chọn không?`)) {
                    bulkDelete(selectedIds);
                }
            });
        }

        // Bulk update status function
        function bulkUpdateStatus(serviceIds, status, actionName) {
            const loadingToast = showToast('info', `Đang ${actionName.toLowerCase()} ${serviceIds.length} dịch vụ...`,
                false);

            Promise.all(serviceIds.map(serviceId =>
                    fetch(`/admin/services/${serviceId}`, {
                        method: 'PUT',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            toggle_status: true,
                            status: status,
                            entity_id: serviceId
                        })
                    }).then(r => r.json())
                ))
                .then(results => {
                    if (loadingToast && loadingToast.parentNode) {
                        loadingToast.remove();
                    }

                    const successCount = results.filter(r => r.success).length;
                    const failCount = results.length - successCount;

                    if (successCount > 0) {
                        showToast('success', `${actionName} thành công ${successCount} dịch vụ!`);

                        // Update UI for successful items
                        results.forEach((result, index) => {
                            if (result.success) {
                                const serviceId = serviceIds[index];
                                const statusToggle = document.querySelector(
                                    `.status-toggle[data-service-id="${serviceId}"]`);

                                if (statusToggle) {
                                    statusToggle.checked = status;
                                }
                                // Status is now only shown by the toggle switch
                            }
                        });
                    }

                    if (failCount > 0) {
                        showToast('error', `Có ${failCount} dịch vụ không thể ${actionName.toLowerCase()}`);
                    }

                    // Clear selection after bulk action
                    document.getElementById('clearSelection')?.click();
                })
                .catch(error => {
                    if (loadingToast && loadingToast.parentNode) {
                        loadingToast.remove();
                    }
                    console.error('Bulk update error:', error);
                    showToast('error', `Lỗi khi ${actionName.toLowerCase()} dịch vụ`);
                });
        }

        // Bulk delete function
        function bulkDelete(serviceIds) {
            const loadingToast = showToast('info', `Đang xóa ${serviceIds.length} dịch vụ...`, false);

            Promise.all(serviceIds.map(serviceId =>
                    fetch(`/admin/services/${serviceId}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    }).then(r => r.json())
                ))
                .then(results => {
                    if (loadingToast && loadingToast.parentNode) {
                        loadingToast.remove();
                    }

                    const successCount = results.filter(r => r.success).length;
                    const failCount = results.length - successCount;

                    if (successCount > 0) {
                        showToast('success', `Xóa thành công ${successCount} dịch vụ!`);

                        // Remove successful items from DOM
                        results.forEach((result, index) => {
                            if (result.success) {
                                const serviceId = serviceIds[index];
                                const serviceRow = document.querySelector(`[data-service-id="${serviceId}"]`)
                                    ?.closest('tr');
                                if (serviceRow) {
                                    serviceRow.style.transition = 'opacity 0.3s';
                                    serviceRow.style.opacity = '0';
                                    setTimeout(() => serviceRow.remove(), 300);
                                }
                            }
                        });
                    }

                    if (failCount > 0) {
                        showToast('error', `Có ${failCount} dịch vụ không thể xóa`);
                    }

                    // Clear selection after bulk action
                    setTimeout(() => {
                        document.getElementById('clearSelection')?.click();
                    }, 500);
                })
                .catch(error => {
                    if (loadingToast && loadingToast.parentNode) {
                        loadingToast.remove();
                    }
                    console.error('Bulk delete error:', error);
                    showToast('error', 'Lỗi khi xóa dịch vụ');
                });
        }

        // Initialize bulk actions when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            initBulkActions();
        });
    </script>

@endpush


<style>
    /* Service row styling based on status */
    .service-row {
        transition: all 0.3s ease;
    }

    /* Disabled service row - secondary/dark color */
    .service-row.service-disabled {
        background-color: #f8f9fa !important;
        opacity: 0.7;
    }

    .service-row.service-disabled td {
        color: #6c757d;
    }

    .service-row.service-disabled h6 {
        color: #6c757d;
    }

    .service-row.service-disabled .badge {
        opacity: 0.8;
    }

    /* Hover effect for disabled rows */
    .service-row.service-disabled:hover {
        background-color: #e9ecef !important;
        opacity: 0.85;
    }

    /* Status toggle styling */
    .status-toggle {
        cursor: pointer;
    }

    .status-toggle:checked {
        background-color: #198754;
        border-color: #198754;
    }

    .status-toggle:not(:checked) {
        background-color: #6c757d;
        border-color: #6c757d;
    }
</style>

