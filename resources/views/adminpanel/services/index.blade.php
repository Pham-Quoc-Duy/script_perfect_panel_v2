@extends('adminpanel.layouts.app')
@section('title', 'Services')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        <span class="title d-none">List</span>

        <!-- Search and Action Buttons -->
        <div class="row g-3 g-xl-3 mb-5">
            <div class="col-md-4 col-12">
                <div class="d-flex align-items-center">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control ipt-keyword" placeholder="Mã dịch vụ hoặc tên"
                            data-lang="ID or Name">
                        <button class="btn btn-primary btn-sm btn-icon px-4" type="button"
                            onclick="filter(document.querySelector('.ipt-keyword').value.trim())">
                            <i class="las la-search fs-2"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-start gap-2">
                    <a class="btn btn-primary btn-sm" href="/admin/services/add">
                        <span data-lang="Add service">Thêm dịch vụ</span>
                    </a>
                    <a class="btn btn-primary btn-sm" href="/admin/services/import">
                        <span data-lang="Import services">Nhập dịch vụ</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Collapse All Button -->
        <div class="p-5 text-muted text-end pointer" onclick="collapseAll()" id="collapse-all-btn">
            <span class="fst-italic" data-lang="Collapse all">Thu gọn tất cả</span>
            <i class="bi bi-arrows-collapse fs-4 ms-2" id="collapse-all-icon"></i>
        </div>

        <!-- Services Table -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed table-hover fs-7 gy-0 gx-2 gs-3 mb-0"
                        id="table-service">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-1px"></th>
                                <th class="text-nowrap">ID</th>
                                <th class="text-nowrap" data-lang="Provider">Nhà cung cấp</th>
                                <th data-lang="Service">Dịch vụ</th>
                                <th class="text-nowrap" data-lang="Rate">Giá bán</th>
                                <th class="text-nowrap">Min/Max</th>
                                <th class="text-nowrap">
                                    <span data-lang="Avg time">Thời gian TB</span>
                                    <span class="ms-1 fa fa-exclamation-circle"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        aria-label="Thời gian trung bình được tính dựa trên 10 đơn hàng hoàn thành gần nhất trên mỗi số lượng 1000."
                                        data-bs-original-title="Thời gian trung bình được tính dựa trên 10 đơn hàng hoàn thành gần nhất trên mỗi số lượng 1000."></span>
                                </th>
                                <th class="w-1px"></th>
                                <th class="w-1px"></th>
                            </tr>
                        </thead>

                        @foreach ($plat_cat as $platform)
                            <!-- Platform Header -->
                            <thead class="platform platform-{{ $platform['id'] }}">
                                <tr class="static bg-secondary">
                                    <td colspan="10">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 fs-5 fw-bold">
                                                @if (filter_var($platform['image'], FILTER_VALIDATE_URL))
                                                    <img src="{{ $platform['image'] }}" class="me-2"
                                                        alt="{{ $platform['name'] }}"
                                                        style="width: 24px; height: 24px; object-fit: contain; border-radius: 4px;"
                                                        loading="lazy"
                                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                                                    <i class="fas fa-image text-muted me-2"
                                                        style="display: none; font-size: 1.2rem;"
                                                        title="Không thể tải hình ảnh"></i>
                                                @else
                                                    <i class="{{ $platform['image'] }} me-2"
                                                        style="font-size: 1.2rem;" aria-hidden="true"></i>
                                                @endif
                                                <span class="ls-1">{{ $platform['name'] }}</span>
                                            </div>
                                            <div data-status="Show" class="text-end fs-8 show-hide pointer"
                                                style="border-bottom: 0.5px dashed"
                                                onclick="collapsePlatform(this, this.getAttribute('data-status'), {{ $platform['id'] }})">
                                                <span class="show-hide-text" data-lang="Hide">Ẩn</span>
                                                ({{ count($platform['categories']) }})
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </thead>

                            @foreach ($platform['categories'] as $category)
                                <!-- Category Header -->
                                <thead class="category category-{{ $category['id'] }}" data-status="0" data-cat="{{ $category['id'] }}" data-platform="{{ $platform['id'] }}">
                                    <tr class="static bg-secondary">
                                        <td colspan="10" class="py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 fs-5 fw-bold">
                                                    @if (filter_var($category['image'], FILTER_VALIDATE_URL))
                                                        <img src="{{ $category['image'] }}" class="me-2 ms-5"
                                                            alt="{{ $category['name'] }}"
                                                            style="width: 20px; height: 20px; object-fit: contain; border-radius: 4px;"
                                                            loading="lazy"
                                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                                                        <i class="fas fa-image text-muted me-2 ms-5"
                                                            style="display: none; font-size: 1rem;"
                                                            title="Không thể tải hình ảnh"></i>
                                                    @else
                                                        <i class="{{ $category['image'] }} me-2 ms-5"
                                                            style="font-size: 1rem;"></i>
                                                    @endif
                                                    {{ $category['name'] }}
                                                </div>
                                                <div data-status="Show" class="text-end fs-9 show-hide pointer"
                                                    style="border-bottom: 0.5px dashed"
                                                    onclick="collapseCategory(this, this.getAttribute('data-status'), {{ $platform['id'] }}, {{ $category['id'] }})">
                                                    <span class="show-hide-text" data-lang="Show">Hiện</span>
                                                    ({{ count($category['services']) }})
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>

                                <!-- Services for this category -->
                                <tbody class="tbody-{{ $category['id'] }}" data-status="0" data-platform-id="{{ $platform['id'] }}" data-cat-id="{{ $category['id'] }}">
                                @foreach ($category['services'] as $service)
                                    <tr class="row-{{ $service->id }} {{ !$service->status ? 'text-muted' : '' }} service fs-7" 
                                        data-id="{{ $service->id }}" 
                                        data-status="{{ $service->status }}" 
                                        data-platform="{{ $platform['id'] }}" 
                                        data-category="{{ $category['id'] }}" 
                                        data-psid="{{ $service->service_api ?? '' }}">
                                        <td width="1"><i class="fas fa-bars"></i></td>
                                        <td width="1">
                                            <span class="fw-bolder fs-6 ls-1">{{ $service->id }}</span>
                                            <p class="mb-0 text-muted fs-7 text-nowrap">{{ $service->type_service ?? 'Default' }}
                                                @if($service->refill)
                                                    <i class="las la-fill-drip fs-6 text-success" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Bảo hành" data-bs-original-title="Bảo hành"></i>
                                                @endif
                                                @if($service->cancel)
                                                    <i class="las la-ban fs-7 text-warning" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Hủy" data-bs-original-title="Hủy"></i>
                                                @endif
                                                @if(!$service->status)
                                                    <i class="las la-ban fs-7 text-danger" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Vô hiệu hóa" data-bs-original-title="Vô hiệu hóa"></i>
                                                @endif
                                            </p>
                                        </td>
                                        <td width="1">{{ $service->provider_name ?? '' }}<p class="mb-0 text-muted fs-7">{{ $service->service_api ?? '' }}</p></td>
                                        <td class="wrap">{{ $service->getName() }}
                                            <p class="mb-1 text-muted">
                                                @php
                                                    $attributes = is_string($service->attributes) ? json_decode($service->attributes, true) : $service->attributes;
                                                    $badges = is_array($attributes) ? $attributes : [];
                                                    $badgeColors = [
                                                        // Đỏ - danger
                                                        'Best seller'               => 'danger',
                                                        'Exclusive'                 => 'danger',
                                                        'Độc quyền'                 => 'danger',
                                                        'Provider Direct'           => 'danger',
                                                        'Trực tiếp từ nhà sản xuất' => 'danger',
                                                        // Xanh lá - success
                                                        'Instant'                   => 'success',
                                                        'Super Fast'                => 'success',
                                                        'Siêu nhanh'                => 'success',
                                                        'Refill'                    => 'success',
                                                        '30 days Refill'            => 'success',
                                                        'Lifetime Refill'           => 'success',
                                                        'Lifetime'                  => 'success',
                                                        'Bảo hành trọn đời'         => 'success',
                                                        'Promotion'                 => 'success',
                                                        'Khuyến mãi'                => 'success',
                                                        'Real'                      => 'success',
                                                        'Người dùng thật'           => 'success',
                                                        // Xanh dương - primary
                                                        'New'                       => 'primary',
                                                        'Non Drop'                  => 'primary',
                                                        // Vàng - warning
                                                        'Recommend'                 => 'warning',
                                                    ];
                                                @endphp
                                                @foreach($badges as $badge)
                                                    @php
                                                        $label = is_array($badge) ? ($badge['label'] ?? '') : $badge;
                                                        $fallbackColors = ['primary', 'info', 'warning', 'danger', 'success'];
                                                        $fallback = $fallbackColors[abs(crc32($label)) % count($fallbackColors)];
                                                        $color = is_array($badge) ? ($badge['color'] ?? $fallback) : ($badgeColors[$label] ?? $fallback);
                                                    @endphp
                                                    <span class="badge badge-outline badge-{{ $color }} fw-light fs-9 py-1 px-1 me-1"
                                                        data-lang="label::{{ $label }}">{{ $label }}</span>
                                                @endforeach
                                            </p>
                                        </td>
                                        <td width="1" class="text-nowrap">
                                            <span class="d-block td-row1">{{ formatCharge($service->rate_retail) }} - {{ formatCharge($service->rate_agent) }} - {{ formatCharge($service->rate_distributor) }}</span>
                                            <span class="text-gray-600 fs-7 d-block">
                                                <i class="fa fa-circle {{ $service->sync_rate ? 'text-success' : 'text-secondary' }} fs-10 me-1" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Tự đồng bộ" data-bs-original-title="Tự đồng bộ"></i>{{ formatCharge($service->rate_original ?? $service->rate_retail) }}
                                            </span>
                                        </td>
                                        <td width="1">
                                            <span class="d-block td-row1">{{ formatCharge($service->min) }}</span>
                                            <span class="d-block">
                                                <i class="fa fa-circle {{ $service->sync_min_max ? 'text-success' : 'text-secondary' }} fs-10 me-1" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Tự đồng bộ" data-bs-original-title="Tự đồng bộ"></i>{{ formatCharge($service->max) }}
                                            </span>
                                        </td>
                                        <td width="1" class="text-nowrap">{{ formatAverageTime($service->average_time) }}</td>
                                        <td width="1">
                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input h-15px w-25px" type="checkbox" value="{{ $service->id }}" {{ $service->status ? 'checked' : '' }} data-cat-status="0" onchange="statusService(this.value, this.checked, this.getAttribute('data-cat-status'))">
                                            </div>
                                        </td>
                                        <td width="1"><a href="/admin/services/edit?id={{ $service->id }}"><i class="bi bi-pencil fs-8"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Drag & Drop Styles */
    .sortable-ghost {
        opacity: 0.4;
        background: #f8f9fa !important;
    }

    .sortable-chosen {
        background: #e3f2fd !important;
    }

    .sortable-drag {
        background: #ffffff !important;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2) !important;
        transform: rotate(2deg);
    }

    /* Service row styling */
    .service.sortable-chosen {
        background: #f0f8ff !important;
    }

    /* Updating state */
    .updating {
        opacity: 0.6;
        pointer-events: none;
    }

    /* Pointer cursor for show/hide */
    .show-hide.pointer {
        cursor: pointer;
        user-select: none;
    }

    .show-hide.pointer:hover {
        opacity: 0.8;
    }

        /* Table responsive improvements */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

    /* Service row wrap text */
    td.wrap {
        white-space: normal;
        word-wrap: break-word;
    }

    /* Compact table rows */
    #table-service tbody td {
        padding-top: 4px !important;
        padding-bottom: 4px !important;
        vertical-align: middle;
        line-height: 1.3;
    }

    #table-service tbody td p {
        margin-bottom: 0;
        line-height: 1.3;
    }

    /* Fix symbol-circle khoảng cách thừa từ Metronic */
    #table-service .symbol.symbol-circle {
        width: auto !important;
        height: auto !important;
        min-width: unset !important;
    }

    #table-service .symbol.symbol-circle::after,
    #table-service .symbol.symbol-circle::before {
        display: none !important;
    }

    /* Dòng 1 thụt vào bằng width dot (fa-circle fs-10 ~8px + me-1 ~4px = ~12px) */
    #table-service td .td-row1 {
        padding-left: 9.5px;
    }

    /* Responsive improvements for small devices */
    @media (max-width: 768px) {
        /* Make Service column wider on small devices */
        th[data-lang="Service"],
        td.wrap {
            min-width: 200px;
            max-width: 300px;
        }

        /* Reduce width of other columns on small devices */
        th:not([data-lang="Service"]),
        td:not(.wrap) {
            font-size: 0.75rem;
        }

        /* Make ID column narrower */
        th:nth-child(2),
        td:nth-child(2) {
            min-width: 60px;
        }

        /* Make Provider column narrower */
        th[data-lang="Provider"],
        td:nth-child(3) {
            min-width: 80px;
            font-size: 0.7rem;
        }

        /* Adjust Rate column */
        th[data-lang="Rate"],
        td:nth-child(5) {
            min-width: 100px;
            font-size: 0.7rem;
        }

        /* Adjust Min/Max column */
        th:nth-child(6),
        td:nth-child(6) {
            min-width: 60px;
            font-size: 0.7rem;
        }

        /* Adjust Avg time column */
        th:nth-child(7),
        td:nth-child(7) {
            min-width: 70px;
            font-size: 0.7rem;
        }
    }

    @media (max-width: 576px) {
        /* Even more space for Service column on very small devices */
        th[data-lang="Service"],
        td.wrap {
            min-width: 250px;
            max-width: 350px;
        }

        /* Further reduce other columns */
        th:not([data-lang="Service"]),
        td:not(.wrap) {
            font-size: 0.7rem;
            padding: 0.25rem !important;
        }
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translate(-50%, calc(-50% + 20px));
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
    }
</style>

<script src="{{ asset('adminpanel/js/services/index.js') }}" defer></script>