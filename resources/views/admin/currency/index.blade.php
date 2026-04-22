@extends('admin.layouts.app')

@section('title', 'Quản lý tiền tệ')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Quản lý tiền tệ',
                    'breadcrumb' => 'Tiền tệ',
                ])

                @include('admin.components.alert')

                <!-- Currency Management Card -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if ($currencies && $currencies->count() > 0)
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-sm btn-success" id="syncRatesBtn">
                                                Đồng bộ giá
                                            </button>
                                            <button type="button" class="btn btn-sm btn-info" id="fetchRatesBtn">
                                                Đồng bộ API
                                            </button>
                                            <a href="{{ route('admin.currency.create') }}" class="btn btn-sm btn-primary">
                                                Thêm tiền tệ
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{-- Filter Options --}}
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <select class="form-select" id="statusFilter">
                                                <option value="">Tất cả trạng thái</option>
                                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>
                                                    Hoạt động</option>
                                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Tắt
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-select" id="syncFilter">
                                                <option value="">Tất cả đồng bộ</option>
                                                <option value="1" {{ request('sync') === '1' ? 'selected' : '' }}>
                                                    Tự động</option>
                                                <option value="0" {{ request('sync') === '0' ? 'selected' : '' }}>Thủ
                                                    công
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            @if (request('status') !== null || request('sync') !== null)
                                                <a href="{{ route('admin.currency.index') }}"
                                                    class="btn btn-outline-secondary w-100">
                                                    <i class="bx bx-reset me-1"></i>Xóa bộ lọc
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Table Container -->
                                    <div class="table-responsive position-relative">
                                        <!-- Table Loader Overlay -->
                                        <div id="tableLoader" class="table-loader-overlay" style="display: none;">
                                            <div class="loader-content">
                                                <div class="loading-animation">
                                                    <div class="currency-icons">
                                                        <i class="bx bx-money currency-icon" style="--delay: 0s;"></i>
                                                        <i class="bx bx-dollar currency-icon" style="--delay: 0.2s;"></i>
                                                        <i class="bx bx-euro currency-icon" style="--delay: 0.4s;"></i>
                                                        <i class="bx bx-yen currency-icon" style="--delay: 0.6s;"></i>
                                                    </div>
                                                    <div class="loading-progress">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                </div>
                                                <h6 class="text-primary mb-2 loading-title">Đang tải dữ liệu...</h6>
                                                <p class="text-muted small loading-subtitle">Vui lòng chờ trong giây lát</p>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="datatable"
                                                    class="table align-middle datatable dt-responsive table-check nowrap"
                                                    style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                                    <thead>
                                                        <tr class="bg-transparent">
                                                            <th style="width: 30px;">
                                                                <div class="form-check font-size-16">
                                                                    <input type="checkbox" name="check"
                                                                        class="form-check-input checkAll-currencies"
                                                                        id="checkAll-currencies">
                                                                    <label class="form-check-label"
                                                                        for="checkAll-currencies"></label>
                                                                </div>
                                                            </th>
                                                            <th style="width: 120px;">ID</th>
                                                            <th>Tiền tệ</th>
                                                            <th>Tỷ giá</th>
                                                            <th>Trạng thái</th>
                                                            <th>Đồng bộ</th>
                                                            <th style="width: 100px;">Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($currency as $currencies)
                                                            <tr class="currency-row {{ $currencies->status == 0 ? 'opacity-50' : '' }}"
                                                                data-id="{{ $currencies->id }}">

                                                                {{-- Checkbox --}}
                                                                <td>
                                                                    <div class="form-check font-size-16">
                                                                        <input type="checkbox"
                                                                            class="form-check-input currency-checkbox"
                                                                            value="{{ $currencies->id }}">
                                                                        <label class="form-check-label"></label>
                                                                    </div>
                                                                </td>

                                                                {{-- ID --}}
                                                                <td>
                                                                    <span class="badge badge-soft-dark font-size-12">
                                                                        #{{ $currencies->id }}
                                                                    </span>
                                                                </td>

                                                                {{-- Currency info --}}
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-3">
                                                                            <div
                                                                                class="avatar-sm bg-light rounded-circle d-flex align-items-center justify-content-center">
                                                                                <span
                                                                                    class="fw-bold text-primary">{{ $currencies->symbol ?? '?' }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <h6 class="mb-1 fw-semibold">
                                                                                {{ $currencies->name }}</h6>
                                                                            <span
                                                                                class="badge badge-soft-primary font-size-11">{{ $currencies->code }}</span>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                                {{-- Exchange rate --}}
                                                                <td>
                                                                    <span class="fw-bold text-primary">
                                                                        {{ number_format($currencies->exchange_rate, 4) }}
                                                                    </span>
                                                                </td>

                                                                {{-- Status --}}
                                                                <td>
                                                                    <div class="form-check form-switch mb-0">
                                                                        <input class="form-check-input status-toggle"
                                                                            type="checkbox" data-id="{{ $currencies->id }}"
                                                                            {{ $currencies->status == 1 ? 'checked' : '' }}>
                                                                    </div>
                                                                </td>

                                                                {{-- Sync --}}
                                                                <td>
                                                                    <div class="form-check form-switch mb-0">
                                                                        <input class="form-check-input sync-toggle"
                                                                            type="checkbox" data-id="{{ $currencies->id }}"
                                                                            {{ $currencies->sync ? 'checked' : '' }}>
                                                                    </div>
                                                                </td>

                                                                {{-- Actions --}}
                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <button
                                                                            class="btn btn-sm btn-outline-info edit-currency-btn"
                                                                            data-id="{{ $currencies->id }}">
                                                                            <i class="bx bx-edit"></i>
                                                                        </button>

                                                                        <button
                                                                            class="btn btn-sm btn-outline-danger delete-currency-btn"
                                                                            data-id="{{ $currencies->id }}"
                                                                            data-name="{{ $currencies->name }}">
                                                                            <i class="bx bx-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7" class="text-center py-4 text-muted">
                                                                    Không có dữ liệu tiền tệ
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-body">
                                            <div class="text-center py-5">
                                                <i class="bx bx-money display-4 text-muted mb-3"></i>
                                                <h5 class="text-muted">Chưa có tiền tệ nào</h5>
                                                <p class="text-muted mb-4">Nhấn nút "Lấy dữ liệu API" để tự động thêm các
                                                    loại tiền tệ phổ biến từ API.</p>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        id="fetchRatesBtn2">
                                                        <i class="bx bx-download me-1"></i>Lấy dữ liệu API
                                                    </button>
                                                    <a href="{{ route('admin.currency.create') }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="bx bx-plus me-1"></i>Thêm thủ công
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include modal files -->
    @include('admin.currency.delete')

@endsection

@push('styles')
    <style>
        /* Currency table row styling */
        .currency-row {
            transition: opacity 0.3s ease;
        }

        .currency-row.opacity-50 {
            opacity: 0.5;
        }

        /* Checkbox styling */
        .form-check-input {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .form-check-input:checked[type="checkbox"] {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
        }

        /* Form switch styling */
        .form-switch .form-check-input {
            width: 3em;
            height: 1.5em;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable if there's data
            if ($('#datatable tbody tr').length > 0) {
                initializeDataTable();
            }

            // Filter functionality
            $('#statusFilter, #syncFilter').change(function() {
                applyFilters();
            });

            // Checkbox functionality
            $('#checkAll-currencies').change(function() {
                $('.currency-checkbox').prop('checked', $(this).is(':checked'));
            });

            $('.currency-checkbox').change(function() {
                var total = $('.currency-checkbox').length;
                var checked = $('.currency-checkbox:checked').length;
                $('#checkAll-currencies').prop('checked', total === checked);
                $('#checkAll-currencies').prop('indeterminate', checked > 0 && checked < total);
            });
        });

        // Function để di chuyển VND lên đầu tiên
        function moveVNDToTop() {
            setTimeout(function() {
                var $table = $('#datatable tbody');
                var $vndRow = $table.find('tr[data-currency-code="VND"]');

                if ($vndRow.length > 0 && !$vndRow.is(':first-child')) {
                    // Thêm highlight cho VND
                    $vndRow.addClass('vnd-priority');
                    $vndRow.prependTo($table);
                }
            }, 100);
        }

        function applyFilters() {
            // Show loader overlay
            showTableLoader();

            // Update loading message for filtering
            $('.loading-title').text('Đang lọc dữ liệu...');
            $('.loading-subtitle').text('Đang áp dụng bộ lọc');

            var params = new URLSearchParams();
            var status = $('#statusFilter').val();
            var sync = $('#syncFilter').val();

            if (status !== '') params.set('status', status);
            if (sync !== '') params.set('sync', sync);

            const url = window.location.pathname + (params.toString() ? '?' + params.toString() : '');

            // Navigate after short delay
            setTimeout(function() {
                window.location.href = url;
            }, 600);
        }

        // Simple loader functions for overlay
        function showTableLoader() {
            $('#tableLoader').fadeIn(200);
        }

        function hideTableLoader() {
            $('#tableLoader').fadeOut(300);
        }

        // Fetch currency rates from API (for initial setup)
        function fetchCurrencyRates() {
            const btn = $('#fetchRatesBtn, #fetchRatesBtn2');
            const originalText = btn.html();

            btn.prop('disabled', true).html('<span class="loading-spinner me-1"></span>Đang lấy dữ liệu...');

            $.ajax({
                url: '{{ route('admin.currency.fetch-rates') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', response.message);
                        setTimeout(() => window.location.reload(), 2000);
                    } else {
                        showToast('error', response.message);
                        btn.prop('disabled', false).html(originalText);
                    }
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON?.message || 'Có lỗi xảy ra khi lấy dữ liệu từ API';
                    showToast('error', errorMessage);
                    btn.prop('disabled', false).html(originalText);
                }
            });
        }

        // Sync currency rates
        function syncCurrencyRates() {
            const btn = $('#syncRatesBtn');
            const originalText = btn.html();

            btn.prop('disabled', true).html('<span class="loading-spinner me-1"></span>Đang đồng bộ...');

            $.ajax({
                url: '{{ route('admin.currency.fetch-rates') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', response.message);
                        setTimeout(() => window.location.reload(), 2000);
                    } else {
                        showToast('error', response.message);
                        btn.prop('disabled', false).html(originalText);
                    }
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON?.message || 'Có lỗi xảy ra khi đồng bộ tỷ giá';
                    showToast('error', errorMessage);
                    btn.prop('disabled', false).html(originalText);
                }
            });
        }

        // Bind buttons
        $(document).on('click', '#fetchRatesBtn, #fetchRatesBtn2', fetchCurrencyRates);
        $(document).on('click', '#syncRatesBtn', syncCurrencyRates);

        // Edit currency button
        $(document).on('click', '.edit-currency-btn', function() {
            const currencyId = $(this).data('currency-id');
            window.location.href = `/admin/currency/${currencyId}/edit`;
        });

        // Toggle status - giống platform
        $(document).on('change', '.status-toggle', function() {
            const $this = $(this);
            const currencyId = $this.data('id');
            const checked = $this.is(':checked');

            if (!currencyId) {
                showToast('error', 'Không lấy được ID tiền tệ');
                $this.prop('checked', !checked);
                return;
            }

            $.ajax({
                url: `/admin/currency/${currencyId}/toggle-status`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success(res) {
                    if (res.success) {
                        showToast('success', res.message);
                        $this.prop('checked', res.status == 1);
                        $this.closest('tr').toggleClass('opacity-50', res.status == 0);
                    } else {
                        showToast('error', res.message);
                        $this.prop('checked', !checked);
                    }
                },
                error() {
                    showToast('error', 'Lỗi cập nhật trạng thái');
                    $this.prop('checked', !checked);
                }
            });
        });


        // Toggle sync - tương tự status toggle
        $(document).on('change', '.sync-toggle', function() {
            const $this = $(this);
            const currencyId = $this.data('id');
            const checked = $this.is(':checked');

            if (!currencyId) {
                showToast('error', 'Không lấy được ID tiền tệ');
                $this.prop('checked', !checked);
                return;
            }

            $.ajax({
                url: `/admin/currency/${currencyId}/toggle-sync`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success(res) {
                    if (res.success) {
                        showToast('success', res.message);
                        $this.prop('checked', res.sync);
                    } else {
                        showToast('error', res.message);
                        $this.prop('checked', !checked);
                    }
                },
                error() {
                    showToast('error', 'Lỗi cập nhật đồng bộ');
                    $this.prop('checked', !checked);
                }
            });
        });


        // Toast notification function
        function showToast(type, message) {
            const toast = document.createElement('div');
            toast.className =
                `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            toast.innerHTML = `${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;

            document.body.appendChild(toast);
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 5000);
        }
    </script>
@endpush
