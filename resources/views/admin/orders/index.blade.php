@extends('admin.layouts.app')

@section('title', 'Đơn hàng')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Đơn hàng',
                    'breadcrumb' => 'Đơn hàng',
                ])

                @include('admin.components.alert')

                <!-- Filters Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.orders.index') }}" id="filterForm">
                            <!-- Hidden inputs for status filters -->
                            <input type="hidden" name="status" id="statusInput" value="{{ request('status') }}">
                            <input type="hidden" name="main_status" id="mainStatusInput" value="{{ request('main_status') }}">
                            
                            <!-- Main Status Tabs -->
                            <div class="mb-3">
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-primary status-tab {{ !$status ? 'active' : '' }} fw-medium px-3" data-status="">Tất cả</button>
                                    <button type="button" class="btn btn-sm btn-outline-info status-tab {{ $status === 'manual' ? 'active' : '' }} fw-medium px-3" data-status="manual">Thủ công</button>
                                    <button type="button" class="btn btn-sm btn-outline-warning status-tab {{ $status === 'failed' ? 'active' : '' }} fw-medium px-3" data-status="failed">Thất bại</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary status-tab {{ $status === 'awaiting' ? 'active' : '' }} fw-medium px-3" data-status="waiting">Đang chờ</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger status-tab {{ $status === 'ticket' ? 'active' : '' }} fw-medium px-3" data-status="support">Hỗ trợ</button>
                                </div>
                            </div>

                            <!-- Detailed Status Filters -->
                            <div class="mb-3">
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-secondary detail-status {{ $status === 'pending' ? 'active' : '' }} fw-medium px-3" data-status="pending">Chờ xử lý</button>
                                    <button type="button" class="btn btn-sm btn-outline-info detail-status {{ $status === 'processing' ? 'active' : '' }} fw-medium px-3" data-status="processing">Đang xử lý</button>
                                    <button type="button" class="btn btn-sm btn-outline-primary detail-status {{ $status === 'inprogress' ? 'active' : '' }} fw-medium px-3" data-status="inprogress">Đang chạy</button>
                                    <button type="button" class="btn btn-sm btn-outline-success detail-status {{ $status === 'completed' ? 'active' : '' }} fw-medium px-3" data-status="completed">Hoàn thành</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger detail-status {{ $status === 'partial' ? 'active' : '' }} fw-medium px-3" data-status="partial">Hoàn tiền một phần</button>
                                    <button type="button" class="btn btn-sm btn-outline-warning detail-status {{ $status === 'canceled' ? 'active' : '' }} fw-medium px-3" data-status="canceled">Hủy</button>
                                </div>
                            </div>

                            <!-- Search Fields -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-2">
                                    <input type="text" name="order_id" class="form-control form-control-sm" placeholder="Mã đơn hàng" value="{{ request('order_id') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="orders_api" class="form-control form-control-sm" placeholder="Mã đơn hàng API" value="{{ request('orders_api') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="ncc_order_id" class="form-control form-control-sm" placeholder="Mã đơn hàng NCC" value="{{ request('ncc_order_id') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="link" class="form-control form-control-sm" placeholder="Link" value="{{ request('link') }}">
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-primary btn-sm fw-medium" onclick="searchOrders()">
                                            <i class="bx bx-search me-1"></i>Tìm kiếm
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-sm fw-medium px-3" onclick="toggleAdvanced()">
                                            <i class="bx bx-cog me-1"></i>Nâng cao
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm fw-medium" onclick="resetFilters()">
                                            <i class="bx bx-refresh me-1"></i>Thiết lập lại
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Advanced Filters (Hidden by default) -->
                            <div id="advancedFilters" class="row g-3" style="display: none;">
                                <div class="col-md-3">
                                    <select name="user_id" class="form-select form-select-sm">
                                        <option value="">Tất cả tài khoản</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->username }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="service_id" class="form-select form-select-sm">
                                        <option value="">Tất cả dịch vụ</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service['id'] }}" {{ request('service_id') == $service['id'] ? 'selected' : '' }}>
                                                @php
                                                    $serviceName = $service['name'] ?? 'N/A';
                                                    $userLang = auth()->user()->lang ?? app()->getLocale() ?? 'en';
                                                    
                                                    if (is_string($serviceName) && str_starts_with($serviceName, '{')) {
                                                        $nameJson = json_decode($serviceName, true);
                                                        if (is_array($nameJson)) {
                                                            $serviceName = $nameJson[$userLang] ?? $nameJson['en'] ?? reset($nameJson) ?? 'N/A';
                                                        }
                                                    } elseif (is_array($serviceName)) {
                                                        $serviceName = $serviceName[$userLang] ?? $serviceName['en'] ?? reset($serviceName) ?? 'N/A';
                                                    }
                                                    
                                                    $serviceName = is_string($serviceName) ? $serviceName : 'N/A';
                                                @endphp
                                                {{ $serviceName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="provider_id" class="form-select form-select-sm">
                                        <option value="">Tất cả</option>
                                        <option value="manual" {{ request('provider_id') == 'manual' ? 'selected' : '' }}>Tất cả đơn thủ công</option>
                                        <option value="all_providers" {{ request('provider_id') == 'all_providers' ? 'selected' : '' }}>Tất cả nhà cung cấp</option>
                                        <option disabled>──────────</option>
                                        @foreach ($providers as $provider)
                                            <option value="{{ $provider->id }}" {{ request('provider_id') == $provider->id ? 'selected' : '' }}>
                                                {{ $provider->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="sort" class="form-select form-select-sm">
                                        <option value="">Sắp xếp</option>
                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Orders List -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            @if ($orders->count() > 0)
                                <div class="card-header border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h4 class="card-title mb-0">Danh sách đơn hàng</h4>
                                            <p class="text-muted mb-0 mt-1">Quản lý tất cả đơn hàng trong hệ thống ({{ $orders->total() }})</p>
                                        </div>
                                        <div class="col-auto">
                                            <div class="d-flex gap-2">
                                                <div class="dropdown d-none" id="bulkOptionsDropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="bulkOptionsBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bx bx-cog me-1"></i>Tùy chọn
                                                    </button>
                                                    <ul class="dropdown-menu shadow-lg border-0" style="min-width: 220px;">
                                                        <!-- Chuyển trạng thái với submenu -->
                                                        <li class="dropdown-submenu">
                                                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" onclick="return false;">
                                                                <span>
                                                                    <i class="bx bx-transfer me-2 text-primary"></i>
                                                                    Chuyển trạng thái
                                                                </span>
                                                                <i class="bx bx-chevron-right"></i>
                                                            </a>
                                                            <ul class="dropdown-menu submenu shadow-lg border-0" style="min-width: 280px; padding: 0.75rem;">
                                                                <li class="mb-2">
                                                                    <h6 class="dropdown-header text-primary fw-bold mb-2 border-bottom pb-2">
                                                                        <i class="bx bx-transfer me-2"></i>Chuyển trạng thái đơn hàng
                                                                    </h6>
                                                                </li>
                                                                <li>
                                                                    <div class="d-flex flex-wrap gap-2">
                                                                        <button type="button" class="btn btn-sm btn-outline-secondary fw-medium px-3" onclick="bulkChangeStatus('pending')">
                                                                            <i class="bx bx-time me-1"></i>Chờ xử lý
                                                                        </button>
                                                                        <button type="button" class="btn btn-sm btn-outline-info fw-medium px-3" onclick="bulkChangeStatus('processing')">
                                                                            <i class="bx bx-loader-alt me-1"></i>Đang xử lý
                                                                        </button>
                                                                        <button type="button" class="btn btn-sm btn-outline-primary fw-medium px-3" onclick="bulkChangeStatus('in_progress')">
                                                                            <i class="bx bx-play me-1"></i>Đang chạy
                                                                        </button>
                                                                        <button type="button" class="btn btn-sm btn-outline-success fw-medium px-3" onclick="bulkChangeStatus('completed')">
                                                                            <i class="bx bx-check-circle me-1"></i>Hoàn thành
                                                                        </button>
                                                                        <button type="button" class="btn btn-sm btn-outline-danger fw-medium px-3" onclick="bulkChangeStatus('partial')">
                                                                            <i class="bx bx-pie-chart-alt me-1"></i>Hoàn tiền một phần
                                                                        </button>
                                                                        <button type="button" class="btn btn-sm btn-outline-warning fw-medium px-3" onclick="bulkChangeStatus('canceled')">
                                                                            <i class="bx bx-x-circle me-1"></i>Hủy
                                                                        </button>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        
                                                        <li><hr class="dropdown-divider"></li>
                                                        
                                                        <!-- Cập nhật số lượng bắt đầu -->
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center" href="#" onclick="bulkAddStartCount(); return false;">
                                                                <i class="bx bx-plus-circle me-2 text-success"></i>
                                                                Cập nhật start_count
                                                            </a>
                                                        </li>
                                                        
                                                        <!-- Cập nhật mã đơn hàng NCC -->
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center" href="#" onclick="bulkUpdateOrderCode(); return false;">
                                                                <i class="bx bx-edit me-2 text-warning"></i>
                                                                Cập nhật orders_api
                                                            </a>
                                                        </li>
                                                        
                                                        <li><hr class="dropdown-divider"></li>
                                                        
                                                        <!-- Hủy đã chọn -->
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center text-warning" href="#" onclick="bulkCancelOrders(); return false;">
                                                                <i class="bx bx-x-circle me-2"></i>
                                                                Hủy đã chọn
                                                            </a>
                                                        </li>
                                                        
                                                        <!-- Xóa đã chọn -->
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center text-danger" href="#" onclick="bulkDeleteOrders(); return false;">
                                                                <i class="bx bx-trash me-2"></i>
                                                                Xóa đã chọn
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <!-- Table Loader Overlay -->
                                    <div id="tableLoader" class="table-loader-overlay" style="display: none;">
                                        <div class="loader-content">
                                            <div class="loading-animation">
                                                <div class="platform-icons">
                                                    <i class="bx bx-package platform-icon" style="--delay: 0s;"></i>
                                                    <i class="bx bx-cart platform-icon" style="--delay: 0.2s;"></i>
                                                    <i class="bx bx-check-circle platform-icon" style="--delay: 0.4s;"></i>
                                                    <i class="bx bx-trending-up platform-icon" style="--delay: 0.6s;"></i>
                                                </div>
                                                <div class="loading-progress">
                                                    <div class="progress-bar"></div>
                                                </div>
                                            </div>
                                            <h6 class="text-primary mb-2 loading-title">Đang tải dữ liệu...</h6>
                                            <p class="text-muted small loading-subtitle">Vui lòng chờ trong giây lát</p>
                                        </div>
                                    </div>

                                    <div class="table-responsive position-relative">
                                        <table id="datatable" class="table align-middle datatable table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                            <thead>
                                                <tr class="bg-transparent">
                                                    <th style="width: 30px;">
                                                        <div class="form-check font-size-16">
                                                            <input type="checkbox" name="check" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Trạng thái</th>
                                                    <th>Thông tin đơn hàng</th>
                                                    <th>Tài chính & Tiến độ</th>
                                                    <th>Dịch vụ & Liên kết</th>
                                                </tr>
                                            </thead>
                                            <tbody id="ordersTableBody">
                                                @foreach ($orders as $order)
                                                    <tr class="order-row" data-order-id="{{ $order->id }}">
                                                        <!-- Checkbox -->
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input" value="{{ $order->id }}">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>

                                                        <!-- Trạng thái -->
                                                        <td>
                                                            @php
                                                                $statusConfig = match ($order->status) {
                                                                    'pending' => ['class' => 'bg-warning text-dark', 'text' => 'Chờ xử lý', 'icon' => 'bx-time'],
                                                                    'processing' => ['class' => 'bg-primary text-white', 'text' => 'Đang xử lý', 'icon' => 'bx-loader-alt'],
                                                                    'in_progress' => ['class' => 'bg-info text-white', 'text' => 'Đang chạy', 'icon' => 'bx-loader-alt'],
                                                                    'completed' => ['class' => 'bg-success text-white', 'text' => 'Hoàn thành', 'icon' => 'bx-check-circle'],
                                                                    'failed' => ['class' => 'bg-danger text-white', 'text' => 'Thất bại', 'icon' => 'bx-x-circle'],
                                                                    'canceled' => ['class' => 'bg-secondary text-white', 'text' => 'Đã hủy', 'icon' => 'bx-ban'],
                                                                    'partial' => ['class' => 'bg-warning text-white', 'text' => 'Một phần', 'icon' => 'bx-pie-chart-alt'],
                                                                    'refunded' => ['class' => 'bg-dark text-white', 'text' => 'Hoàn tiền', 'icon' => 'bx-undo'],
                                                                    default => ['class' => 'bg-light text-dark', 'text' => 'Không xác định', 'icon' => 'bx-help-circle'],
                                                                };
                                                            @endphp
                                                            
                                                            <div class="d-flex align-items-center gap-2">
                                                                <!-- Status Badge with Actions Dropdown -->
                                                                <div class="dropdown">
                                                                    <button class="btn p-0 border-0 bg-transparent dropdown-toggle-custom" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <span class="badge {{ $statusConfig['class'] }} d-flex align-items-center position-relative" style="font-size: 0.75rem; font-weight: 500; cursor: pointer;">
                                                                            <i class="bx {{ $statusConfig['icon'] }} me-1"></i>
                                                                            {{ $statusConfig['text'] }}
                                                                            <i class="bx bx-chevron-down ms-1" style="font-size: 0.8rem;"></i>
                                                                        </span>
                                                                    </button>
                                                                    
                                                                    <ul class="dropdown-menu shadow-lg border-0" style="min-width: 220px;">
                                                                        <!-- Chuyển trạng thái với submenu -->
                                                                        <li class="dropdown-submenu">
                                                                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" onclick="return false;">
                                                                                <span>
                                                                                    <i class="bx bx-transfer me-2 text-primary"></i>
                                                                                    Chuyển trạng thái
                                                                                </span>
                                                                                <i class="bx bx-chevron-right"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu submenu shadow-lg border-0" style="min-width: 280px; padding: 0.75rem;">
                                                                                <li class="mb-2">
                                                                                    <h6 class="dropdown-header text-primary fw-bold mb-2 border-bottom pb-2">
                                                                                        <i class="bx bx-transfer me-2"></i>Chuyển trạng thái đơn hàng
                                                                                    </h6>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="d-flex flex-wrap gap-2">
                                                                                        @if($order->status !== 'pending')
                                                                                            <button type="button" class="btn btn-sm btn-outline-secondary fw-medium px-3" onclick="changeOrderStatus({{ $order->id }}, 'pending')">
                                                                                                <i class="bx bx-time me-1"></i>Chờ xử lý
                                                                                            </button>
                                                                                        @endif
                                                                                        @if($order->status !== 'processing')
                                                                                            <button type="button" class="btn btn-sm btn-outline-info fw-medium px-3" onclick="changeOrderStatus({{ $order->id }}, 'processing')">
                                                                                                <i class="bx bx-loader-alt me-1"></i>Đang xử lý
                                                                                            </button>
                                                                                        @endif
                                                                                        @if($order->status !== 'in_progress')
                                                                                            <button type="button" class="btn btn-sm btn-outline-primary fw-medium px-3" onclick="changeOrderStatus({{ $order->id }}, 'inprogress')">
                                                                                                <i class="bx bx-play me-1"></i>Đang chạy
                                                                                            </button>
                                                                                        @endif
                                                                                        @if($order->status !== 'completed')
                                                                                            <button type="button" class="btn btn-sm btn-outline-success fw-medium px-3" onclick="changeOrderStatus({{ $order->id }}, 'completed')">
                                                                                                <i class="bx bx-check-circle me-1"></i>Hoàn thành
                                                                                            </button>
                                                                                        @endif
                                                                                        @if($order->status !== 'partial')
                                                                                            <button type="button" class="btn btn-sm btn-outline-danger fw-medium px-3" onclick="changeOrderStatus({{ $order->id }}, 'partial')">
                                                                                                <i class="bx bx-pie-chart-alt me-1"></i>Hoàn tiền một phần
                                                                                            </button>
                                                                                        @endif
                                                                                        @if($order->status !== 'canceled')
                                                                                            <button type="button" class="btn btn-sm btn-outline-warning fw-medium px-3" onclick="changeOrderStatus({{ $order->id }}, 'canceled')">
                                                                                                <i class="bx bx-x-circle me-1"></i>Hủy
                                                                                            </button>
                                                                                        @endif
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        
                                                                        <li><hr class="dropdown-divider"></li>
                                                                        
                                                                        <!-- Thêm số lượng bắt đầu -->
                                                                        <li>
                                                                            <a class="dropdown-item d-flex align-items-center" href="#" onclick="addStartCount({{ $order->id }})">
                                                                                <i class="bx bx-plus-circle me-2 text-success"></i>
                                                                                Thêm số lượng bắt đầu
                                                                            </a>
                                                                        </li>
                                                                        
                                                                        <!-- Cập nhật trạng thái -->
                                                                        <li>
                                                                            <a class="dropdown-item d-flex align-items-center" 
                                                                               href="#" 
                                                                               onclick="updateOrderStatus({{ $order->id }}, '{{ $order->orders_api ?? '' }}', {{ $order->provider_id ?? 'null' }}); return false;">
                                                                                <i class="bx bx-refresh me-2 text-info"></i>
                                                                                Cập nhật trạng thái
                                                                            </a>
                                                                        </li>
                                                                        
                                                                        <!-- Gửi lại đơn hàng (chỉ hiển thị nếu status là failed) -->
                                                                        <li>
                                                                            @if($order->status === 'failed')
                                                                            <a class="dropdown-item d-flex align-items-center" 
                                                                               href="#" 
                                                                               onclick="resendOrder({{ $order->id }}, '{{ $order->link ?? '' }}', {{ $order->quantity ?? 0 }}, {{ $order->provider_id ?? 'null' }}); return false;">
                                                                                <i class="bx bx-send me-2 text-success"></i>
                                                                                Gửi lại đơn hàng
                                                                            </a>
                                                                            @endif
                                                                        </li>
                                                                        
                                                                        <!-- Cập nhật mã đơn hàng NCC -->
                                                                        <li>
                                                                            <a class="dropdown-item d-flex align-items-center" href="#" onclick="updateOrderCode({{ $order->id }})">
                                                                                <i class="bx bx-edit me-2 text-warning"></i>
                                                                                Cập nhật mã đơn hàng NCC
                                                                            </a>
                                                                        </li>
                                                                        
                                                                        <!-- Thêm yêu cầu với submenu -->
                                                                        <li class="dropdown-submenu">
                                                                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" onclick="return false;">
                                                                                <span>
                                                                                    <i class="bx bx-message-add me-2 text-primary"></i>
                                                                                    Thêm yêu cầu
                                                                                </span>
                                                                                <i class="bx bx-chevron-right"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu submenu shadow-lg border-0" style="min-width: 150px;">
                                                                                <li>
                                                                                    <a class="dropdown-item d-flex align-items-center" href="#" onclick="addRequest({{ $order->id }}, 'cancel')">
                                                                                        <i class="bx bx-x-circle me-2 text-danger"></i>
                                                                                        Hủy đơn
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item d-flex align-items-center" href="#" onclick="addRequest({{ $order->id }}, 'warranty')">
                                                                                        <i class="bx bx-shield-check me-2 text-success"></i>
                                                                                        Bảo hành
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item d-flex align-items-center" href="#" onclick="addRequest({{ $order->id }}, 'speed_up')">
                                                                                        <i class="bx bx-rocket me-2 text-warning"></i>
                                                                                        Tăng tốc
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        
                                                                        <!-- Xóa yêu cầu -->
                                                                        <li>
                                                                            <a class="dropdown-item d-flex align-items-center text-danger" href="#" onclick="deleteRequest({{ $order->id }})">
                                                                                <i class="bx bx-trash me-2"></i>
                                                                                Xóa yêu cầu
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <!-- Thông tin đơn hàng -->
                                                        <td>
                                                            <div class="d-flex flex-column">
                                                                <small class="text-muted mb-1" onclick="showOrderModal({{ $order->id }})">
                                                                <b>{{ $order->id }}</b>
                                                                </small>
                                                                <small class="text-muted mb-1">
                     {{ $order->provider_name ?? '' }} - {{ $order->orders_api }}
                                                                </small>
                                                             
                                                                <small class="text-muted mt-1">
                                                                    {{ $order->created_at->format('d/m/Y H:i:s') }}
                                                                </small>
                                                                 <small class="text-muted mt-1">
                                                   {{ $order->updated_at->format('d/m/Y H:i:s') }}
                                                                </small>
                                                            </div>
                                                        </td>

                                                        <!-- Cột 3: Financial & Progress -->
                                                        <td>
                                                            <div class="d-flex flex-column" style="line-height: 1.4;">
                                                                <div class="mb-1">
                                                                    <strong class="text-primary">${{ rtrim(rtrim(number_format($order->charge, 8, '.', ''), '0'), '.') }}</strong>
                                                                </div>
                                                                <small class="text-muted">
                                                                    Số lượng: <strong>{{ number_format($order->quantity) }}</strong>
                                                                </small>
                                                                <small class="text-muted">
                                                                    Số lượng ban đầu: <strong data-field="start_count">{{ number_format($order->start_count ?? 0) }}</strong>
                                                                </small>
                                                                <small class="text-warning">
                                                                    Số lượng còn lại: <strong data-field="remains">{{ number_format($order->remains ?? 0) }}</strong>
                                                                </small>
                                                                
                                                                <!-- Progress Bar -->
                                                                @php
                                                                    $progress = 0;
                                                                    if ($order->quantity > 0) {
                                                                        $delivered = $order->quantity - ($order->remains ?? 0);
                                                                        $progress = ($delivered / $order->quantity) * 100;
                                                                    }
                                                                @endphp
                                                                <div class="mt-2">
                                                                    <div class="progress" style="height: 6px;">
                                                                        <div class="progress-bar bg-success" style="width: {{ $progress }}%"></div>
                                                                    </div>
                                                                    <small class="text-success">{{ number_format($progress, 1) }}% hoàn thành</small>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <!-- Cột 4: Link & Service Info -->
                                                        <td>
                                                            <div class="d-flex flex-column" style="line-height: 1.4;">
                                                                <!-- Link -->
                                                                <a href="{{ $order->link }}" target="_blank" class="text-primary text-decoration-none mb-1" title="{{ $order->link }}" style="font-size: 0.9rem;">
                                                                    {{ $order->link }}
                                                                </a>
                                                                
                                                                <!-- Service ID | Name -->
                                                                <div class="mb-1">
                                                                    <strong class="text-dark">{{ $order->service->id ?? '1473' }}</strong>
                                                                    <span class="text-muted"> | </span>
                                                                    <span class="text-muted">
                                                                        @php
                                                                            $serviceName = 'Facebook Story View';
                                                                            if ($order->service) {
                                                                                $userLang = auth()->user()->lang ?? app()->getLocale() ?? 'en';
                                                                                $nameData = $order->service->name;
                                                                                
                                                                                if (is_string($nameData) && str_starts_with($nameData, '{')) {
                                                                                    $nameJson = json_decode($nameData, true);
                                                                                    if (is_array($nameJson)) {
                                                                                        $serviceName = $nameJson[$userLang] ?? $nameJson['en'] ?? reset($nameJson) ?? 'Facebook Story View';
                                                                                    } else {
                                                                                        $serviceName = $nameData;
                                                                                    }
                                                                                } elseif (is_array($nameData)) {
                                                                                    $serviceName = $nameData[$userLang] ?? $nameData['en'] ?? reset($nameData) ?? 'Facebook Story View';
                                                                                } else {
                                                                                    $serviceName = $nameData ?? 'Facebook Story View';
                                                                                }
                                                                            }
                                                                            
                                                                            $serviceName = is_string($serviceName) ? $serviceName : 'Facebook Story View';
                                                                        @endphp
                                                                        {{ $serviceName }}
                                                                    </span>
                                                                </div>
                                                                
                                                                <!-- Username - Note -->
                                                                <div>
                                                                    <small class="text-muted">
                                                                        {{ $order->user->username }}
                                                                        @if($order->note)
                                                                            <span class="bg-info text-white px-2 py-1 border rounded" >
                                                                                {{ Str::limit($order->note, 40) }}
                                                                            </span>
                                                                        @endif
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            @else
                                <div class="card-body">
                                    <div class="text-center py-5">
                                        <i class="bx bx-package font-size-48 text-muted mb-3"></i>
                                        <h5 class="text-muted">Không có đơn hàng nào</h5>
                                        <p class="text-muted">Chưa có đơn hàng nào được tạo với bộ lọc hiện tại.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Orders Index Script v3.1 - {{ now()->format('YmdHis') }}
        console.log('Orders script loaded v3.1 - {{ now()->format("Y-m-d H:i:s") }}');
        
        // Handle unhandled promise rejections
        window.addEventListener('unhandledrejection', event => {
            if (event.reason && event.reason.message && event.reason.message.includes('checkout popup config')) {
                console.warn('Checkout popup config error caught and suppressed:', event.reason);
                event.preventDefault();
            }
        });
        
        // Initialize dropdown click handlers for responsive behavior
        function initializeDropdownClickHandlers() {
            const dropdownSubmenus = document.querySelectorAll('.dropdown-submenu');

            dropdownSubmenus.forEach(submenu => {
                const link = submenu.querySelector('a');
                const menu = submenu.querySelector('.dropdown-menu');

                if (link && menu) {
                    // Prevent default link behavior
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        // Toggle current submenu
                        submenu.classList.toggle('show');
                        
                        // Close other submenus at same level
                        const siblings = submenu.parentElement.querySelectorAll('.dropdown-submenu');
                        siblings.forEach(sibling => {
                            if (sibling !== submenu) {
                                sibling.classList.remove('show');
                            }
                        });
                    });

                    // Close submenu when clicking outside
                    document.addEventListener('click', function(e) {
                        if (!submenu.contains(e.target)) {
                            submenu.classList.remove('show');
                        }
                    });

                    // Handle keyboard navigation
                    link.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            submenu.classList.toggle('show');
                        }
                        if (e.key === 'Escape') {
                            submenu.classList.remove('show');
                        }
                    });
                }
            });

            // Handle button clicks inside submenu - close after selection
            const statusButtons = document.querySelectorAll('.dropdown-menu.submenu button');
            statusButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // Close parent dropdown after selection
                    const parentDropdown = this.closest('.dropdown-submenu');
                    if (parentDropdown) {
                        parentDropdown.classList.remove('show');
                    }
                });
            });
        }

        $(document).ready(function() {
            // Initialize dropdown click handlers
            initializeDropdownClickHandlers();

            // Initialize DataTable like platform (horizontal layout without dtr-control)
            if ($.fn.DataTable.isDataTable('.datatable')) {
                $('.datatable').DataTable().destroy();
            }

            $('.datatable').DataTable({
                responsive: false, // Disable responsive mode to prevent dtr-control
                scrollX: true, // Enable horizontal scrolling
                autoWidth: false, // Disable auto width calculation
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/vi.json'
                },
                columnDefs: [{
                        orderable: false,
                        targets: [0, -1]
                    },
                    {
                        searchable: false,
                        targets: [0, -1]
                    }
                ],
                pageLength: 15,
                lengthMenu: [
                    [15, 25, 50, 100],
                    [15, 25, 50, 100]
                ],
                order: [
                    [2, 'desc']
                ]
            });

            // Check all functionality
            $('#checkAll').change(function() {
                $('.form-check-input[value]').prop('checked', this.checked);
                toggleBulkButtons();
                
                // Show warning if checking all
                if (this.checked) {
                    const checkedCount = $('.form-check-input[value]:checked').length;
                    const totalCount = {{ $orders->total() }};
                    if (checkedCount < totalCount) {
                        console.warn(`Chỉ chọn ${checkedCount} đơn hàng trên trang này. Tổng cộng ${totalCount} đơn hàng trong hệ thống.`);
                    }
                }
            });

            // Individual checkbox change
            $(document).on('change', '.form-check-input[value]', function() {
                const total = $('.form-check-input[value]').length;
                const checked = $('.form-check-input[value]:checked').length;
                $('#checkAll').prop('indeterminate', checked > 0 && checked < total);
                $('#checkAll').prop('checked', checked === total);
                toggleBulkButtons();
            });

            // Toggle bulk action buttons
            function toggleBulkButtons() {
                const checkedCount = $('.form-check-input[value]:checked').length;
                if (checkedCount > 0) {
                    $('#bulkOptionsDropdown').removeClass('d-none');
                } else {
                    $('#bulkOptionsDropdown').addClass('d-none');
                }
            }

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Handle submenu interactions
            setupSubmenuHandlers();
        });

        function setupSubmenuHandlers() {
            // Enhanced submenu handling with smooth animations and better UX
            
            // Adjust submenu position when parent dropdown is shown
            $(document).on('shown.bs.dropdown', '.dropdown', function() {
                const $dropdown = $(this);
                setTimeout(() => {
                    $dropdown.find('.dropdown-submenu.show').each(function() {
                        const $parent = $(this);
                        const $submenu = $parent.find('.submenu');
                        adjustSubmenuPosition($parent, $submenu);
                    });
                }, 50);
            });
            
            // Handle submenu click for all devices with smooth animation
            $(document).on('click', '.dropdown-submenu > a', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const $parent = $(this).parent();
                const $submenu = $parent.find('.submenu');
                const isMobile = window.innerWidth <= 768;
                
                // Toggle submenu
                if ($parent.hasClass('show')) {
                    $parent.removeClass('show');
                    if (isMobile) {
                        $submenu.slideUp(200);
                    } else {
                        $submenu.fadeOut(200);
                    }
                } else {
                    // Close other submenus at same level
                    const $siblings = $parent.parent().find('.dropdown-submenu').not($parent);
                    $siblings.removeClass('show');
                    if (isMobile) {
                        $siblings.find('.submenu').slideUp(200);
                    } else {
                        $siblings.find('.submenu').fadeOut(200);
                    }
                    
                    // Open this submenu
                    $parent.addClass('show');
                    if (isMobile) {
                        $submenu.slideDown(200, function() {
                            adjustSubmenuPosition($parent, $submenu);
                        });
                    } else {
                        $submenu.fadeIn(200, function() {
                            adjustSubmenuPosition($parent, $submenu);
                        });
                    }
                }
            });

            // Close submenu when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown-submenu').length && !$(e.target).closest('.dropdown-menu').length) {
                    $('.dropdown-submenu.show').removeClass('show').find('.submenu').fadeOut(200);
                }
            });

            // Adjust submenu positions on window resize with debounce
            let resizeTimeout;
            $(window).on('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    $('.dropdown-submenu.show').each(function() {
                        const $parent = $(this);
                        const $submenu = $parent.find('.submenu');
                        adjustSubmenuPosition($parent, $submenu);
                    });
                }, 250);
            });

            // Handle button clicks inside submenu - close after selection
            $(document).on('click', '.submenu button', function(e) {
                e.stopPropagation();
                // Close parent dropdown after selection with delay for visual feedback
                const $parent = $(this).closest('.dropdown-submenu');
                if ($parent.length) {
                    setTimeout(() => {
                        $parent.removeClass('show').find('.submenu').fadeOut(200);
                    }, 300);
                }
            });

            // Close all submenus when main dropdown closes
            $(document).on('hidden.bs.dropdown', '.dropdown', function() {
                $('.dropdown-submenu').removeClass('show mobile-open dropstart dropup');
                $('.submenu').hide();
            });

            // Prevent dropdown from closing when clicking on submenu items
            $(document).on('click', '.submenu .dropdown-item', function(e) {
                e.stopPropagation();
            });

            // Enhanced hover behavior on desktop for better UX
            if (window.innerWidth > 1024) {
                let hoverDelay = 150;
                
                $(document).on('mouseenter', '.dropdown-submenu', function(e) {
                    const $this = $(this);
                    const $submenu = $this.find('.submenu');
                    
                    clearTimeout($this.data('hideTimeout'));
                    
                    const showTimeout = setTimeout(() => {
                        if (!$this.hasClass('show')) {
                            $this.addClass('show');
                            $submenu.stop(true, true).fadeIn(200, function() {
                                adjustSubmenuPosition($this, $submenu);
                            });
                        }
                    }, hoverDelay);
                    
                    $this.data('showTimeout', showTimeout);
                });

                $(document).on('mouseleave', '.dropdown-submenu', function(e) {
                    const $this = $(this);
                    const $submenu = $this.find('.submenu');
                    
                    clearTimeout($this.data('showTimeout'));
                    
                    const hideTimeout = setTimeout(() => {
                        if (!$this.is(':hover') && !$submenu.is(':hover')) {
                            $submenu.stop(true, true).fadeOut(200);
                            $this.removeClass('show dropstart dropup');
                        }
                    }, 300);
                    
                    $this.data('hideTimeout', hideTimeout);
                });

                $(document).on('mouseenter', '.submenu', function(e) {
                    const $parent = $(this).closest('.dropdown-submenu');
                    clearTimeout($parent.data('hideTimeout'));
                    clearTimeout($parent.data('showTimeout'));
                });

                $(document).on('mouseleave', '.submenu', function(e) {
                    const $parent = $(this).closest('.dropdown-submenu');
                    const $this = $(this);
                    
                    const hideTimeout = setTimeout(() => {
                        if (!$parent.is(':hover') && !$this.is(':hover')) {
                            $this.stop(true, true).fadeOut(200);
                            $parent.removeClass('show dropstart dropup');
                        }
                    }, 300);
                    
                    $parent.data('hideTimeout', hideTimeout);
                });
            

                $(document).on('mouseleave', '.submenu', function(e) {
                    const $parent = $(this).closest('.dropdown-submenu');
                    const $this = $(this);
                    
                    const hideTimeout = setTimeout(() => {
                        if (!$parent.is(':hover') && !$this.is(':hover')) {
                            $this.stop(true, true).slideUp(150);
                            $parent.removeClass('show');
                        }
                    }, 200);
                    
                    $parent.data('hideTimeout', hideTimeout);
                });
            }
        }

        // Function to adjust submenu position based on screen space
        function adjustSubmenuPosition($parent, $submenu) {
            // Reset positioning classes
            $parent.removeClass('dropstart dropup');
            
            // Get viewport dimensions
            const viewportWidth = $(window).width();
            const viewportHeight = $(window).height();
            const scrollTop = $(window).scrollTop();
            
            // Get parent position and dimensions
            const parentOffset = $parent.offset();
            const parentWidth = $parent.outerWidth();
            const parentHeight = $parent.outerHeight();
            
            // Get submenu dimensions
            const submenuWidth = $submenu.outerWidth() || 220; // min-width of submenu
            const submenuHeight = $submenu.outerHeight() || 300; // estimated height
            
            if (!parentOffset) return;
            
            // Check horizontal positioning (left/right)
            const spaceOnRight = viewportWidth - (parentOffset.left + parentWidth);
            const spaceOnLeft = parentOffset.left;
            
            if (spaceOnRight < submenuWidth && spaceOnLeft > submenuWidth) {
                // Not enough space on right, but enough on left
                $parent.addClass('dropstart');
            }
            
            // Check vertical positioning (top/bottom)
            const parentTop = parentOffset.top - scrollTop;
            const spaceBelow = viewportHeight - parentTop;
            const spaceAbove = parentTop + parentHeight;
            
            if (spaceBelow < submenuHeight && spaceAbove > submenuHeight) {
                // Not enough space below, but enough above
                $parent.addClass('dropup');
            }
            
            // If submenu is too tall for viewport, ensure it's scrollable
            if (submenuHeight > viewportHeight * 0.8) {
                $submenu.css({
                    'max-height': (viewportHeight * 0.8) + 'px',
                    'overflow-y': 'auto'
                });
            }
        }

        // Search functionality
        function searchOrders(page = 1) {
            const form = document.getElementById('filterForm');
            
            // Build query string from form data
            const formData = new FormData(form);
            const params = new URLSearchParams();
            
            for (let [key, value] of formData.entries()) {
                if (value) { // Only add non-empty values
                    params.append(key, value);
                }
            }
            
            // Add page parameter
            params.append('page', page);
            
            // Navigate to the filtered URL
            window.location.href = '{{ route("admin.orders.index") }}?' + params.toString();
        }

        // Toggle advanced filters
        function toggleAdvanced() {
            const advancedFilters = document.getElementById('advancedFilters');
            if (advancedFilters.style.display === 'none') {
                advancedFilters.style.display = 'flex';
            } else {
                advancedFilters.style.display = 'none';
            }
        }

        // Reset filters
        function resetFilters() {
            window.location.href = '{{ route("admin.orders.index") }}';
        }

        // Status tab functionality - Alternative approach using form submission
        $(document).on('click', '.status-tab, .detail-status', function(e) {
            e.preventDefault();
            
            const status = $(this).data('status');
            console.log('Status clicked:', status); // Debug log
            
            // Remove active class from all tabs in the same group
            if ($(this).hasClass('status-tab')) {
                $('.status-tab').removeClass('active');
            } else {
                $('.detail-status').removeClass('active');
            }
            
            // Add active class to clicked tab
            $(this).addClass('active');
            
            // Update the hidden input with the selected status
            $('#statusInput').val(status);
            console.log('Status input updated to:', $('#statusInput').val()); // Debug log
            
            // Build URL with all current filters + new status
            const form = document.getElementById('filterForm');
            const formData = new FormData(form);
            
            // Build query string from form data
            const params = new URLSearchParams();
            for (let [key, value] of formData.entries()) {
                if (value) { // Only add non-empty values
                    params.append(key, value);
                }
            }
            
            // Navigate to the filtered URL
            window.location.href = '{{ route("admin.orders.index") }}?' + params.toString();
        });
        // Show order modal with enhanced content
        function showOrderModal(orderId) {
            if (!orderId) {
                console.error('Order ID is required');
                return;
            }

            console.log('Opening modal for order:', orderId);
            
            const modalElement = document.getElementById('showOrderModal');
            const modalContent = document.getElementById('orderModalContent');
            const modalTitle = document.querySelector('#showOrderModalLabel');
            
            if (!modalElement) {
                console.error('Modal element not found');
                return;
            }
            
            if (!modalContent) {
                console.error('Modal content element not found');
                return;
            }

            const modal = new bootstrap.Modal(modalElement);
            
            // Update modal title
            if (modalTitle) {
                modalTitle.innerHTML = `<i class="bx bx-receipt me-2"></i>Chi tiết đơn hàng #${orderId}`;
            }
            
            // Find the order row to get data
            const orderRow = document.querySelector(`tr[data-order-id="${orderId}"]`);
            if (!orderRow) {
                console.error('Order row not found for ID:', orderId);
                modalContent.innerHTML = `
                    <div class="d-flex flex-column align-items-center justify-content-center p-5">
                        <div class="alert alert-danger border-0 shadow-sm">
                            <div class="d-flex align-items-center">
                                <i class="bx bx-error-circle fs-3 me-3 text-danger"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Không tìm thấy thông tin</h6>
                                    <p class="mb-0">Không thể tìm thấy thông tin đơn hàng #${orderId}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                modal.show();
                return;
            }

            console.log('Order row found, generating content...');

            // Show loading with beautiful animation
            modalContent.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center p-5" style="min-height: 300px;">
                    <div class="spinner-border text-primary mb-4" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Đang tải...</span>
                    </div>
                    <h5 class="text-primary mb-2">Đang tải thông tin đơn hàng</h5>
                    <p class="text-muted mb-0">Vui lòng chờ trong giây lát...</p>
                </div>
            `;
            modal.show();

            // Generate enhanced content from available data with smooth transition
            setTimeout(() => {
                modalContent.innerHTML = generateEnhancedOrderModalContent(orderRow, orderId);
                
                // Add fade-in animation to content
                const contentElements = modalContent.querySelectorAll('.card');
                contentElements.forEach((element, index) => {
                    element.style.opacity = '0';
                    element.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        element.style.transition = 'all 0.4s ease';
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }, index * 100);
                });
                
                console.log('Modal content loaded successfully');
            }, 600);
            
            console.log('Modal should be visible now');
        }
        // Generate enhanced order modal content with Bootstrap classes
        function generateEnhancedOrderModalContent(orderRow, orderId) {
            // Extract data from the table row
            const statusBadge = orderRow.querySelector('.badge');
            const status = statusBadge ? statusBadge.textContent.trim() : 'N/A';
            const statusClass = statusBadge ? statusBadge.className : '';
            
            const orderIdCell = orderRow.querySelector('td:nth-child(3)');
            const apiCode = orderIdCell ? orderIdCell.querySelector('small')?.textContent.replace('API: ', '') || 'N/A' : 'N/A';
            
            const userCell = orderRow.querySelector('td:nth-child(5)');
            const userName = userCell ? userCell.querySelector('h6')?.textContent || 'N/A' : 'N/A';
            const userUsername = userCell ? userCell.querySelector('small')?.textContent || 'N/A' : 'N/A';
            const userEmail = userCell ? userCell.querySelectorAll('small')[1]?.textContent || 'N/A' : 'N/A';
            
            // Extract service information
            const serviceIdBadge = userCell ? userCell.querySelector('.badge') : null;
            const serviceId = serviceIdBadge ? serviceIdBadge.textContent.replace('ID: ', '') : 'N/A';
            const serviceName = userCell ? userCell.querySelector('.fw-medium')?.textContent || 'N/A' : 'N/A';
            const providerName = userCell ? userCell.querySelector('small:last-child')?.textContent || 'Manual' : 'Manual';
            
            const financialCell = orderRow.querySelector('td:nth-child(6)');
            const priceText = financialCell ? financialCell.querySelector('strong')?.textContent || '0' : '0';
            const totalText = financialCell ? financialCell.querySelectorAll('strong')[1]?.textContent || '0' : '0';
            const quantityText = financialCell ? financialCell.querySelectorAll('strong')[2]?.textContent || '0' : '0';
            
            const progressCell = orderRow.querySelector('td:nth-child(7)');
            const linkElement = progressCell ? progressCell.querySelector('a') : null;
            const link = linkElement ? linkElement.href : 'N/A';
            const linkText = linkElement ? linkElement.textContent : 'N/A';
            const startCount = progressCell ? progressCell.textContent.match(/Bắt đầu: (\d+)/)?.[1] || '0' : '0';
            const remains = progressCell ? progressCell.textContent.match(/Còn: (\d+)/)?.[1] || '0' : '0';
            const createdAt = progressCell ? progressCell.querySelector('small:last-child')?.textContent || 'N/A' : 'N/A';

            // Calculate progress
            const quantity = parseInt(quantityText.replace(/,/g, '')) || 0;
            const remainsNum = parseInt(remains) || 0;
            const delivered = quantity - remainsNum;
            const progressPercent = quantity > 0 ? Math.round((delivered / quantity) * 100) : 0;

            // Get status color for progress bar
            const getProgressBarColor = (percent) => {
                if (percent >= 100) return 'bg-success';
                if (percent >= 75) return 'bg-info';
                if (percent >= 50) return 'bg-warning';
                return 'bg-danger';
            };

            const progressBarColor = getProgressBarColor(progressPercent);

            return `
                <div class="container-fluid p-4">
                    <!-- Header Statistics -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <div class="card border-start border-primary border-4 shadow-sm">
                                <div class="card-body d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bx bx-package text-primary fs-2"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="fs-4 fw-bold text-primary">${quantityText}</div>
                                        <div class="text-muted text-uppercase fw-semibold small">Tổng số lượng</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-start border-success border-4 shadow-sm">
                                <div class="card-body d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bx bx-check-circle text-success fs-2"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="fs-4 fw-bold text-success">${delivered.toLocaleString()}</div>
                                        <div class="text-muted text-uppercase fw-semibold small">Đã hoàn thành</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-start border-warning border-4 shadow-sm">
                                <div class="card-body d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bx bx-time text-warning fs-2"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="fs-4 fw-bold text-warning">${parseInt(remains).toLocaleString()}</div>
                                        <div class="text-muted text-uppercase fw-semibold small">Còn lại</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-start border-info border-4 shadow-sm">
                                <div class="card-body d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bx bx-trending-up text-info fs-2"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="fs-4 fw-bold text-info">${progressPercent}%</div>
                                        <div class="text-muted text-uppercase fw-semibold small">Tiến độ</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Cards -->
                    <div class="row g-4">
                        <!-- Order Information -->
                        <div class="col-lg-6">
                            <div class="card shadow-sm">
                                <div class="card-header bg-light border-bottom">
                                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                        <i class="bx bx-receipt me-2 text-primary"></i>Thông tin đơn hàng
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-hash me-2 text-primary"></i>Mã đơn hàng
                                        </span>
                                        <span class="badge bg-primary fs-6 px-3 py-2">#${orderId}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-code me-2 text-primary"></i>Mã API
                                        </span>
                                        <code class="bg-light px-3 py-2 rounded border">${apiCode}</code>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-flag me-2 text-primary"></i>Trạng thái
                                        </span>
                                        <span class="badge ${statusClass} px-3 py-2">${status}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-calendar me-2 text-primary"></i>Ngày tạo
                                        </span>
                                        <span class="text-muted">${createdAt}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="col-lg-6">
                            <div class="card shadow-sm">
                                <div class="card-header bg-light border-bottom">
                                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                        <i class="bx bx-user me-2 text-primary"></i>Thông tin khách hàng
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-user-circle me-2 text-primary"></i>Tên khách hàng
                                        </span>
                                        <span class="fw-bold">${userName}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-at me-2 text-primary"></i>Tên đăng nhập
                                        </span>
                                        <span class="badge bg-info text-white">${userUsername}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-envelope me-2 text-primary"></i>Email
                                        </span>
                                        <a href="mailto:${userEmail}" class="text-decoration-none text-primary">
                                            <i class="bx bx-envelope me-1"></i>${userEmail}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service Information -->
                        <div class="col-lg-6">
                            <div class="card shadow-sm">
                                <div class="card-header bg-light border-bottom">
                                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                        <i class="bx bx-cog me-2 text-primary"></i>Thông tin dịch vụ
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-id-card me-2 text-primary"></i>ID dịch vụ
                                        </span>
                                        <span class="badge bg-secondary">${serviceId}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-service me-2 text-primary"></i>Tên dịch vụ
                                        </span>
                                        <span class="fw-bold text-dark text-end" style="max-width: 200px;">${serviceName}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-store me-2 text-primary"></i>Nhà cung cấp
                                        </span>
                                        <span class="badge bg-warning text-dark">${providerName}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Financial Information -->
                        <div class="col-lg-6">
                            <div class="card shadow-sm">
                                <div class="card-header bg-light border-bottom">
                                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                        <i class="bx bx-money me-2 text-primary"></i>Thông tin tài chính
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-package me-2 text-primary"></i>Số lượng đặt hàng
                                        </span>
                                        <span class="fs-5 fw-bold text-primary">${quantityText}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-dollar me-2 text-primary"></i>Giá đơn vị
                                        </span>
                                        <span class="text-success fw-bold">${priceText}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-2">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-calculator me-2 text-primary"></i>Tổng thanh toán
                                        </span>
                                        <span class="fs-5 fw-bold text-danger">${totalText}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Link Information -->
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-light border-bottom">
                                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                        <i class="bx bx-link me-2 text-primary"></i>Thông tin liên kết
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <span class="fw-semibold text-muted d-flex align-items-center">
                                            <i class="bx bx-world me-2 text-primary"></i>URL đích
                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="${link}" target="_blank" class="text-primary text-decoration-none text-truncate" style="max-width: 300px;" title="${link}">
                                                ${linkText}
                                            </a>
                                            <button class="btn btn-sm btn-outline-primary rounded-pill" onclick="copyToClipboard('${link}')" title="Sao chép link">
                                                <i class="bx bx-copy"></i>
                                            </button>
                                            <a href="${link}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill" title="Mở link">
                                                <i class="bx bx-external-link"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between align-items-center py-2">
                                                <span class="fw-semibold text-muted d-flex align-items-center">
                                                    <i class="bx bx-play me-2 text-primary"></i>Số lượng bắt đầu
                                                </span>
                                                <span class="badge bg-info fs-6">${parseInt(startCount).toLocaleString()}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between align-items-center py-2">
                                                <span class="fw-semibold text-muted d-flex align-items-center">
                                                    <i class="bx bx-time me-2 text-primary"></i>Còn lại
                                                </span>
                                                <span class="badge bg-warning text-dark fs-6">${parseInt(remains).toLocaleString()}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Tracking -->
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-light border-bottom">
                                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                        <i class="bx bx-trending-up me-2 text-primary"></i>Tiến độ thực hiện
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="bg-light rounded-3 p-4">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="mb-0 fw-bold">Tiến độ hoàn thành</h5>
                                            <span class="badge ${progressBarColor} fs-6 px-3 py-2">${progressPercent}%</span>
                                        </div>
                                        <div class="progress mb-4" style="height: 18px;">
                                            <div class="progress-bar ${progressBarColor}" style="width: ${progressPercent}%"></div>
                                        </div>
                                        <div class="row text-center g-3">
                                            <div class="col-md-4">
                                                <div class="bg-success bg-opacity-10 rounded-3 p-3 border border-success border-opacity-25">
                                                    <div class="fs-3 fw-bold text-success mb-1">${delivered.toLocaleString()}</div>
                                                    <div class="text-muted fw-medium">Đã hoàn thành</div>
                                                    <small class="text-success">${quantity > 0 ? Math.round((delivered / quantity) * 100) : 0}% tổng số</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="bg-warning bg-opacity-10 rounded-3 p-3 border border-warning border-opacity-25">
                                                    <div class="fs-3 fw-bold text-warning mb-1">${parseInt(remains).toLocaleString()}</div>
                                                    <div class="text-muted fw-medium">Còn lại</div>
                                                    <small class="text-warning">${quantity > 0 ? Math.round((remainsNum / quantity) * 100) : 0}% tổng số</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="bg-info bg-opacity-10 rounded-3 p-3 border border-info border-opacity-25">
                                                    <div class="fs-3 fw-bold text-info mb-1">${parseInt(startCount).toLocaleString()}</div>
                                                    <div class="text-muted fw-medium">Số lượng bắt đầu</div>
                                                    <small class="text-info">Điểm khởi đầu</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Helper functions for modal actions
        function editOrder(orderId) {
            // Find the order row to get current data
            const orderRow = document.querySelector(`tr[data-order-id="${orderId}"]`);
            if (!orderRow) {
                alert('Không tìm thấy thông tin đơn hàng');
                return;
            }

            // Extract current data
            const statusBadge = orderRow.querySelector('.badge');
            const currentStatus = getStatusValue(statusBadge?.textContent.trim() || '');
            
            const progressCell = orderRow.querySelector('td:nth-child(7)');
            const startCount = progressCell ? progressCell.textContent.match(/Bắt đầu: (\d+)/)?.[1] || '0' : '0';
            const remains = progressCell ? progressCell.textContent.match(/Còn: (\d+)/)?.[1] || '0' : '0';
            
            const financialCell = orderRow.querySelector('td:nth-child(6)');
            const rate = financialCell ? financialCell.querySelector('strong')?.textContent.replace(/,/g, '') || '0' : '0';

            // Populate edit modal
            document.getElementById('orderStatus').value = currentStatus;
            document.getElementById('startCount').value = startCount;
            document.getElementById('remainsCount').value = remains;
            document.getElementById('orderRate').value = rate;
            document.getElementById('orderNote').value = '';

            // Show edit modal
            const editModal = new bootstrap.Modal(document.getElementById('editOrderModal'));
            editModal.show();

            // Store order ID for form submission
            document.getElementById('editOrderForm').dataset.orderId = orderId;
        }

        function getStatusValue(statusText) {
            const statusMap = {
                'Chờ xử lý': 'pending',
                'Đang chạy': 'processing',
                'Hoàn thành': 'completed',
                'Thất bại': 'canceled',
                'Một phần': 'partial',
                'Hoàn tiền': 'refunded'
            };
            return statusMap[statusText] || 'pending';
        }

        function editOrderFromModal() {
            // Get the current order ID from the modal title
            const modalTitle = document.querySelector('#showOrderModalLabel');
            const orderId = modalTitle ? modalTitle.textContent.match(/#(\d+)/)?.[1] : null;
            
            if (orderId) {
                // Close the show modal first
                const showModal = bootstrap.Modal.getInstance(document.getElementById('showOrderModal'));
                if (showModal) {
                    showModal.hide();
                }
                
                // Wait for modal to close then open edit modal
                setTimeout(() => {
                    editOrder(orderId);
                }, 300);
            }
        }

        function copyToClipboard(text) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(() => {
                    console.log('Đã sao chép vào clipboard!');
                }).catch(() => {
                    fallbackCopyTextToClipboard(text);
                });
            } else {
                fallbackCopyTextToClipboard(text);
            }
        }

        function fallbackCopyTextToClipboard(text) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.position = "fixed";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            
            try {
                document.execCommand('copy');
                console.log('Đã sao chép vào clipboard!');
            } catch (err) {
                console.error('Không thể sao chép!');
            }
            
            document.body.removeChild(textArea);
        }

        function showToast(message, type = 'info') {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} alert-dismissible fade show position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="bx bx-${type === 'success' ? 'check-circle' : type === 'error' ? 'error-circle' : 'info-circle'} me-2"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(toast);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 3000);
        }

        function printOrderDetails() {
            const modalContent = document.getElementById('orderModalContent');
            if (!modalContent) return;

            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Chi tiết đơn hàng</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
                    <style>
                        @media print {
                            .btn { display: none !important; }
                            .card { break-inside: avoid; }
                        }
                    </style>
                </head>
                <body class="bg-white">
                    <div class="container-fluid p-4">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-primary">Chi tiết đơn hàng</h2>
                            <p class="text-muted">Ngày in: ${new Date().toLocaleDateString('vi-VN')}</p>
                        </div>
                        ${modalContent.innerHTML}
                    </div>
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        }

        function exportOrderDetails() {
            console.log('Tính năng xuất Excel đang được phát triển!');
        }

        function deleteOrder(orderId) {
            if (confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')) {
                console.log('Tính năng xóa đơn hàng đang được phát triển!');
            }
        }

        // Status change functions
        function changeOrderStatus(orderId, newStatus) {
            const statusText = {
                'pending': 'Chờ xử lý',
                'processing': 'Đang xử lý', 
                'in_progress': 'Đang chạy',
                'completed': 'Hoàn thành',
                'partial': 'Hoàn tiền một phần',
                'canceled': 'Hủy'
            };
            
            // Count total selected orders
            const selectedCount = $('.form-check-input[value]:checked').length;
            const message = selectedCount > 0 
                ? `Đang cập nhật trạng thái đơn hàng #${orderId} sang "${statusText[newStatus]}" (${selectedCount} đơn được chọn)...`
                : `Đang cập nhật trạng thái đơn hàng #${orderId} sang "${statusText[newStatus]}"...`;
            
            console.log(message);
            
            fetch(`/admin/orders/${orderId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    quick_status: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data.message);
                    // Reload page to see changes
                    setTimeout(() => location.reload(), 1000);
                } else {
                    console.error(data.message || 'Cập nhật thất bại');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                console.error('Lỗi khi cập nhật trạng thái');
            });
        }

        function addStartCount(orderId) {
            // Create modal for adding start count
            const selectedCount = $('.form-check-input[value]:checked').length;
            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.id = 'addStartCountModal';
            modal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cập nhật số lượng bắt đầu - Đơn hàng #${orderId}${selectedCount > 0 ? ` (${selectedCount} đơn được chọn)` : ''}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="startCountInput" class="form-label">Số lượng bắt đầu (thay thế):</label>
                                <input type="number" class="form-control" id="startCountInput" placeholder="Nhập số lượng mới" min="0" value="">
                                <small class="text-muted d-block mt-2">
                                    <i class="bx bx-info-circle me-1"></i>Giá trị hiện tại sẽ được thay thế bằng giá trị mới
                                </small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-primary" onclick="confirmAddStartCount(${orderId})">
                                <i class="bx bx-check me-1"></i>Cập nhật
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
            
            // Focus on input
            setTimeout(() => {
                document.getElementById('startCountInput').focus();
            }, 500);
            
            modal.addEventListener('hidden.bs.modal', () => {
                modal.remove();
            });
        }

        function confirmAddStartCount(orderId) {
            const startCount = document.getElementById('startCountInput').value;
            
            if (startCount === '' || isNaN(startCount) || parseInt(startCount) < 0) {
                console.warn('Vui lòng nhập số lượng hợp lệ');
                return;
            }

            const modal = bootstrap.Modal.getInstance(document.getElementById('addStartCountModal'));
            if (modal) modal.hide();

            // Count total selected orders
            const selectedCount = $('.form-check-input[value]:checked').length;
            const message = selectedCount > 0
                ? `Đang cập nhật start_count = ${startCount} cho đơn hàng #${orderId} (${selectedCount} đơn được chọn)...`
                : `Đang cập nhật start_count = ${startCount} cho đơn hàng #${orderId}...`;
            
            console.log(message);
            
            fetch(`/admin/orders/${orderId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    add_start_count: true,
                    start_count: parseInt(startCount)
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data.message);
                    setTimeout(() => location.reload(), 1000);
                } else {
                    console.error(data.message || 'Cập nhật thất bại');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                console.error('Lỗi khi thêm số lượng bắt đầu');
            });
        }

        // Update order status from provider API
        function updateOrderStatus(orderId, ordersApi, providerId) {
            console.log('=== CẬP NHẬT TRẠNG THÁI ĐỐN HÀNG ===');
            console.log('Order ID:', orderId);
            console.log('Orders API (mã đơn hàng NCC):', ordersApi || 'Không có');
            console.log('Provider ID:', providerId || 'Không có');
            console.log('=====================================');
            
            // Kiểm tra dữ liệu trước khi gọi API
            if (!ordersApi) {
                console.warn('Không thể cập nhật: thiếu orders_api');
                return;
            }
            
            if (!providerId) {
                console.warn('Không thể cập nhật: thiếu provider_id');
                return;
            }
            
            if (confirm(`Bạn có muốn cập nhật trạng thái đơn hàng #${orderId} từ nhà cung cấp API?\n\nOrders API: ${ordersApi}\nProvider ID: ${providerId}`)) {
                // Call API to update status from provider using orders_api
                fetch(`/admin/orders/${orderId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Log response for debugging
                        console.log('=== KẾT QUẢ CẬP NHẬT ===');
                        console.log('Order ID:', orderId);
                        console.log('Orders API:', ordersApi);
                        console.log('Provider ID:', providerId);
                        console.log('Trạng thái mới:', data.order?.status);
                        console.log('Start Count:', data.order?.start_count);
                        console.log('Remains:', data.order?.remains);
                        console.log('API Response:', data.api_response);
                        console.log('========================');
                        
                        // Reload page after 1.5 seconds to show updated data
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        console.error('=== LỖI CẬP NHẬT ===');
                        console.error('Order ID:', orderId);
                        console.error('Orders API:', ordersApi);
                        console.error('Provider ID:', providerId);
                        console.error('Message:', data.message);
                        console.error('====================');
                    }
                })
                .catch(error => {
                    console.error('=== LỖI NETWORK ===');
                    console.error('Order ID:', orderId);
                    console.error('Orders API:', ordersApi);
                    console.error('Provider ID:', providerId);
                    console.error('Error:', error);
                    console.error('===================');
                });
            }
        }

        // Hàm cập nhật UI của dòng đơn hàng - KHÔNG SỬ DỤNG (reload trang thay vì cập nhật UI)
        // function updateOrderRowUI(orderId, data) { ... }
        console.log('updateOrderStatus function defined:', typeof updateOrderStatus);

        // Resend failed order function
        function resendOrder(orderId, link, quantity, providerId) {
            console.log('=== GỬI LẠI ĐƠN HÀNG ===');
            console.log('Order ID:', orderId);
            console.log('Link:', link);
            console.log('Quantity:', quantity);
            console.log('Provider ID:', providerId);
            console.log('========================');
            
            if (!link || !quantity || !providerId) {
                console.warn('Không thể gửi lại: thiếu dữ liệu');
                return;
            }
            
            if (confirm(`Bạn có muốn gửi lại đơn hàng #${orderId}?\n\nLink: ${link}\nSố lượng: ${quantity}`)) {
                console.log(`Đang gửi lại đơn hàng #${orderId}...`);
                
                // Call API to resend order
                fetch(`/admin/orders/${orderId}/resend`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('=== KẾT QUẢ GỬI LẠI ===');
                        console.log('Order ID:', orderId);
                        console.log('Orders API mới:', data.order?.orders_api);
                        console.log('Trạng thái mới:', data.order?.status);
                        console.log('API Response:', data.api_response);
                        console.log('========================');
                        
                        // Reload page after 1.5 seconds
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        console.error('=== LỖI GỬI LẠI ===');
                        console.error('Order ID:', orderId);
                        console.error('Message:', data.message);
                        console.error('Order Data:', data.order?.order_data);
                        console.error('API Response:', data.api_response);
                        console.error('====================');
                    }
                })
                .catch(error => {
                    console.error('=== LỖI NETWORK ===');
                    console.error('Order ID:', orderId);
                    console.error('Error:', error);
                    console.error('===================');
                });
            }
        }
        console.log('resendOrder function defined:', typeof resendOrder);

        function updateOrderCode(orderId) {
            // Create modal for updating order code
            const selectedCount = $('.form-check-input[value]:checked').length;
            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.id = 'updateOrderCodeModal';
            modal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cập nhật orders_api - Đơn hàng #${orderId}${selectedCount > 0 ? ` (${selectedCount} đơn được chọn)` : ''}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="orderCodeInput" class="form-label">Mã đơn hàng NCC (orders_api) - Thay thế:</label>
                                <input type="text" class="form-control" id="orderCodeInput" placeholder="Nhập mã đơn hàng NCC mới" value="">
                                <small class="text-muted d-block mt-2">
                                    <i class="bx bx-info-circle me-1"></i>Giá trị hiện tại sẽ được thay thế bằng giá trị mới
                                </small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-primary" onclick="confirmUpdateOrderCode(${orderId})">
                                <i class="bx bx-check me-1"></i>Cập nhật
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
            
            // Focus on input
            setTimeout(() => {
                document.getElementById('orderCodeInput').focus();
            }, 500);
            
            modal.addEventListener('hidden.bs.modal', () => {
                modal.remove();
            });
        }

        function confirmUpdateOrderCode(orderId) {
            const nccCode = document.getElementById('orderCodeInput').value;
            
            if (!nccCode || !nccCode.trim()) {
                console.warn('Vui lòng nhập mã đơn hàng NCC');
                return;
            }

            const modal = bootstrap.Modal.getInstance(document.getElementById('updateOrderCodeModal'));
            if (modal) modal.hide();

            // Count total selected orders
            const selectedCount = $('.form-check-input[value]:checked').length;
            const message = selectedCount > 0
                ? `Đang cập nhật orders_api = ${nccCode.trim()} cho đơn hàng #${orderId} (${selectedCount} đơn được chọn)...`
                : `Đang cập nhật orders_api = ${nccCode.trim()} cho đơn hàng #${orderId}...`;
            
            console.log(message);
            
            fetch(`/admin/orders/${orderId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    update_orders_api: true,
                    orders_api: nccCode.trim()
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data.message);
                    setTimeout(() => location.reload(), 1000);
                } else {
                    console.error(data.message || 'Cập nhật thất bại');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                console.error('Lỗi khi cập nhật mã đơn hàng NCC');
            });
        }

        function addRequest(orderId, requestType) {
            const requestTypes = {
                'cancel': 'Hủy đơn',
                'warranty': 'Bảo hành',
                'speed_up': 'Tăng tốc'
            };
            
            const requestName = requestTypes[requestType] || 'yêu cầu';
            
            if (confirm(`Bạn có muốn thêm yêu cầu "${requestName}" cho đơn hàng #${orderId}?`)) {
                console.log(`Đang thêm yêu cầu "${requestName}" cho đơn hàng #${orderId}...`);
                // TODO: Implement AJAX call
                setTimeout(() => {
                    console.log(`Đã thêm yêu cầu "${requestName}" thành công`);
                }, 1000);
            }
        }

        function deleteRequest(orderId) {
            if (confirm(`Bạn có chắc chắn muốn xóa yêu cầu của đơn hàng #${orderId}?`)) {
                console.log(`Đang xóa yêu cầu...`);
                // TODO: Implement AJAX call
                setTimeout(() => {
                    console.log(`Đã xóa yêu cầu thành công`);
                }, 1000);
            }
        }

        // Handle edit form submission
        document.getElementById('editOrderForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const orderId = this.dataset.orderId;
            const formData = new FormData(this);
            
            // Here you would typically send an AJAX request to update the order
            console.log('Tính năng cập nhật đơn hàng đang được phát triển!');
            
            // Close the modal
            const editModal = bootstrap.Modal.getInstance(document.getElementById('editOrderModal'));
            if (editModal) {
                editModal.hide();
            }
        });

        // Bulk change status function
        function bulkChangeStatus(status) {
            const selectedIds = Array.from(document.querySelectorAll('.form-check-input[value]:checked'))
                .map(checkbox => checkbox.value);
            
            if (selectedIds.length === 0) {
                console.warn('Vui lòng chọn ít nhất một đơn hàng');
                return;
            }

            console.log(`Đang cập nhật trạng thái cho ${selectedIds.length} đơn hàng...`);

            let completed = 0;
            let failed = 0;

            const updateNext = (index) => {
                if (index >= selectedIds.length) {
                    console.log(`Hoàn thành! Cập nhật thành công: ${completed}, Thất bại: ${failed}`);
                    setTimeout(() => location.reload(), 2000);
                    return;
                }

                const orderId = selectedIds[index];
                
                fetch(`/admin/orders/${orderId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        quick_status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        completed++;
                        // Hide the row
                        const row = document.querySelector(`tr[data-order-id="${orderId}"]`);
                        if (row) {
                            row.style.display = 'none';
                        }
                    } else {
                        failed++;
                    }
                    updateNext(index + 1);
                })
                .catch(error => {
                    console.error('Error:', error);
                    failed++;
                    updateNext(index + 1);
                });
            };

            updateNext(0);
        }

        // Bulk add start count function
        function bulkAddStartCount() {
            const selectedIds = Array.from(document.querySelectorAll('.form-check-input[value]:checked'))
                .map(checkbox => checkbox.value);
            
            if (selectedIds.length === 0) {
                showToast('Vui lòng chọn ít nhất một đơn hàng', 'warning');
                return;
            }

            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.id = 'bulkAddStartCountModal';
            modal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="bx bx-plus-circle me-2 text-success"></i>Cập nhật start_count cho ${selectedIds.length} đơn hàng
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="bulkStartCountInput" class="form-label">Số lượng bắt đầu (thay thế):</label>
                                <input type="number" class="form-control" id="bulkStartCountInput" placeholder="Nhập số lượng mới" min="0" value="">
                                <small class="text-muted d-block mt-2">
                                    <i class="bx bx-info-circle me-1"></i>Giá trị hiện tại sẽ được thay thế bằng giá trị mới
                                </small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-primary" onclick="confirmBulkAddStartCount(${JSON.stringify(selectedIds)})">
                                <i class="bx bx-check me-1"></i>Cập nhật
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
            
            setTimeout(() => {
                document.getElementById('bulkStartCountInput').focus();
            }, 500);
            
            modal.addEventListener('hidden.bs.modal', () => {
                modal.remove();
            });
        }

        function confirmBulkAddStartCount(selectedIds) {
            const startCount = document.getElementById('bulkStartCountInput').value;
            
            if (startCount === '' || isNaN(startCount) || parseInt(startCount) < 0) {
                console.warn('Vui lòng nhập số lượng hợp lệ');
                return;
            }

            const modal = bootstrap.Modal.getInstance(document.getElementById('bulkAddStartCountModal'));
            if (modal) modal.hide();

            console.log(`Đang cập nhật start_count = ${startCount} cho ${selectedIds.length} đơn hàng...`);

            let completed = 0;
            let failed = 0;

            const updateNext = (index) => {
                if (index >= selectedIds.length) {
                    console.log(`Hoàn thành! Cập nhật thành công: ${completed}, Thất bại: ${failed}`);
                    setTimeout(() => location.reload(), 2000);
                    return;
                }

                const orderId = selectedIds[index];
                
                fetch(`/admin/orders/${orderId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        add_start_count: true,
                        start_count: parseInt(startCount)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        completed++;
                        // Hide the row
                        const row = document.querySelector(`tr[data-order-id="${orderId}"]`);
                        if (row) {
                            row.style.display = 'none';
                        }
                    } else {
                        failed++;
                    }
                    updateNext(index + 1);
                })
                .catch(error => {
                    console.error('Error:', error);
                    failed++;
                    updateNext(index + 1);
                });
            };

            updateNext(0);
        }

        // Bulk update order code function
        function bulkUpdateOrderCode() {
            const selectedIds = Array.from(document.querySelectorAll('.form-check-input[value]:checked'))
                .map(checkbox => checkbox.value);
            
            if (selectedIds.length === 0) {
                showToast('Vui lòng chọn ít nhất một đơn hàng', 'warning');
                return;
            }

            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.id = 'bulkUpdateOrderCodeModal';
            modal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cập nhật orders_api cho ${selectedIds.length} đơn hàng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="bulkOrdersApiInput" class="form-label">Mã đơn hàng NCC (orders_api):</label>
                                <input type="text" class="form-control" id="bulkOrdersApiInput" placeholder="Nhập mã đơn hàng NCC" value="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-primary" onclick="confirmBulkUpdateOrderCode(${JSON.stringify(selectedIds)})">Cập nhật</button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
            
            setTimeout(() => {
                document.getElementById('bulkOrdersApiInput').focus();
            }, 500);
            
            modal.addEventListener('hidden.bs.modal', () => {
                modal.remove();
            });
        }

        function confirmBulkUpdateOrderCode(selectedIds) {
            const ordersApi = document.getElementById('bulkOrdersApiInput').value;
            
            if (!ordersApi || !ordersApi.trim()) {
                console.warn('Vui lòng nhập mã đơn hàng NCC');
                return;
            }

            const modal = bootstrap.Modal.getInstance(document.getElementById('bulkUpdateOrderCodeModal'));
            if (modal) modal.hide();

            console.log(`Đang cập nhật orders_api cho ${selectedIds.length} đơn hàng...`);

            let completed = 0;
            let failed = 0;

            const updateNext = (index) => {
                if (index >= selectedIds.length) {
                    console.log(`Hoàn thành! Cập nhật thành công: ${completed}, Thất bại: ${failed}`);
                    setTimeout(() => location.reload(), 2000);
                    return;
                }

                const orderId = selectedIds[index];
                
                fetch(`/admin/orders/${orderId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        update_orders_api: true,
                        orders_api: ordersApi.trim()
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        completed++;
                        // Hide the row
                        const row = document.querySelector(`tr[data-order-id="${orderId}"]`);
                        if (row) {
                            row.style.display = 'none';
                        }
                    } else {
                        failed++;
                    }
                    updateNext(index + 1);
                })
                .catch(error => {
                    console.error('Error:', error);
                    failed++;
                    updateNext(index + 1);
                });
            };

            updateNext(0);
        }

        // Bulk cancel orders function
        function bulkCancelOrders() {
            const selectedIds = Array.from(document.querySelectorAll('.form-check-input[value]:checked'))
                .map(checkbox => checkbox.value);
            
            if (selectedIds.length === 0) {
                console.warn('Vui lòng chọn ít nhất một đơn hàng');
                return;
            }

            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.id = 'bulkCancelConfirmModal';
            modal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title">
                                <i class="bx bx-x-circle me-2"></i>Xác nhận hủy
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0">Bạn có chắc chắn muốn hủy <strong>${selectedIds.length} đơn hàng</strong>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-warning" onclick="confirmBulkCancel(${JSON.stringify(selectedIds)})">Hủy đơn hàng</button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
            
            modal.addEventListener('hidden.bs.modal', () => {
                modal.remove();
            });
        }

        function confirmBulkCancel(selectedIds) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('bulkCancelConfirmModal'));
            if (modal) modal.hide();

            console.log(`Đang hủy ${selectedIds.length} đơn hàng...`);

            fetch('/admin/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    bulk_action: 'cancel',
                    order_ids: selectedIds
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data.message);
                    setTimeout(() => location.reload(), 1500);
                } else {
                    console.error(data.message || 'Hủy thất bại');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                console.error('Lỗi khi hủy đơn hàng');
            });
        }

        // Bulk delete orders function
        function bulkDeleteOrders() {
            const selectedIds = Array.from(document.querySelectorAll('.form-check-input[value]:checked'))
                .map(checkbox => checkbox.value);
            
            if (selectedIds.length === 0) {
                console.warn('Vui lòng chọn ít nhất một đơn hàng');
                return;
            }

            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.id = 'bulkDeleteConfirmModal';
            modal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">
                                <i class="bx bx-trash me-2"></i>Xác nhận xóa
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0">Bạn có chắc chắn muốn xóa <strong>${selectedIds.length} đơn hàng</strong>?</p>
                            <p class="text-danger small mt-2"><i class="bx bx-info-circle me-1"></i>Hành động này không thể hoàn tác!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-danger" onclick="confirmBulkDelete(${JSON.stringify(selectedIds)})">Xóa</button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
            
            modal.addEventListener('hidden.bs.modal', () => {
                modal.remove();
            });
        }

        function confirmBulkDelete(selectedIds) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('bulkDeleteConfirmModal'));
            if (modal) modal.hide();

            console.log(`Đang xóa ${selectedIds.length} đơn hàng...`);

            fetch('/admin/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    bulk_action: 'delete',
                    order_ids: selectedIds
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data.message);
                    setTimeout(() => location.reload(), 1500);
                } else {
                    console.error(data.message || 'Xóa thất bại');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                console.error('Lỗi khi xóa đơn hàng');
            });
        }
    </script>
@endpush