@extends('admin.layouts.app')

@section('title', 'Quản lý nhà cung cấp')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Quản lý nhà cung cấp',
                    'breadcrumb' => 'nhà cung cấp',
                ])
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            @if ($providers && $providers->count() > 0)
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button type="button" class="btn btn-outline-info" id="syncAllBalances">
                                            <i class="bx bx-refresh me-1"></i>Đồng bộ số dư
                                        </button>
                                        <a href="{{ route('admin.provider.create') }}" class="btn btn-primary">
                                            <i class="bx bx-plus me-1"></i> Thêm nhà cung cấp
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Table Container -->
                                    <div class="table-responsive position-relative">
                                        <!-- Table Loader Overlay -->
                                        <div id="tableLoader" class="table-loader-overlay" style="display: none;">
                                            <div class="loader-content">
                                                <div class="loading-animation">
                                                    <div class="platform-icons">
                                                        <i class="bx bx-server platform-icon" style="--delay: 0s;"></i>
                                                        <i class="bx bx-cloud platform-icon" style="--delay: 0.2s;"></i>
                                                        <i class="bx bx-data platform-icon" style="--delay: 0.4s;"></i>
                                                        <i class="bx bx-network-chart platform-icon" style="--delay: 0.6s;"></i>
                                                    </div>
                                                    <div class="loading-progress">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                </div>
                                                <h6 class="text-primary mb-2 loading-title">Đang tải dữ liệu...</h6>
                                                <p class="text-muted small loading-subtitle">Vui lòng chờ trong giây lát</p>
                                            </div>
                                        </div>

                                        <!-- Main Table -->
                                        <table id="datatable"
                                            class="table align-middle datatable dt-responsive table-check nowrap"
                                            style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                            <thead>
                                                <tr class="bg-transparent">
                                                    <th style="width: 30px;">
                                                        <div class="form-check font-size-16">
                                                            <input type="checkbox" name="check"
                                                                class="form-check-input checkAll-providers"
                                                                id="checkAll-providers">
                                                            <label class="form-check-label"
                                                                for="checkAll-providers"></label>
                                                        </div>
                                                    </th>
                                                    <th style="width: 80px;">ID</th>
                                                    <th>Tên Provider</th>
                                                    <th>Loại</th>
                                                    <th>API URL</th>
                                                    <th>Số dư</th>
                                                    <th>Trạng thái</th>
                                                    <th style="width: 180px;">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sortableProviders">
                                                @forelse ($providers ?? [] as $provider)
                                                    <tr class="provider-row {{ ($provider->status ?? 0) == 0 ? 'provider-disabled' : '' }}" 
                                                        data-id="{{ $provider->id }}"
                                                        data-status="{{ ($provider->status ?? 0) }}">
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox"
                                                                    class="form-check-input provider-checkbox"
                                                                    value="{{ $provider->id }}">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>

                                                        <td>#{{ $provider->id }}</td>

                                                        <td>
                                                            <h6 class="mb-0">{{ $provider->name }}</h6>
                                                        </td>

                                                        <td>
                                                            <span class="badge badge-soft-info font-size-12">
                                                                {{ ucfirst($provider->type ?? 'smm') }}
                                                            </span>
                                                        </td>

                                                        <td>
                                                            @if($provider->link)
                                                                <a href="{{ $provider->link }}" target="_blank" 
                                                                   class="text-primary text-decoration-none">
                                                                    {{ Str::limit($provider->link, 35) }}
                                                                    <i class="bx bx-link-external font-size-12 ms-1"></i>
                                                                </a>
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <span class="fw-medium" id="balance-{{ $provider->id }}">
                                                                <b class="text-success">{{ $provider->currency ?? '$' }}</b> 
                                                                {{ number_format($provider->balance ?? 0, 4) }}
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <div class="form-check form-switch mb-0">
                                                                <input class="form-check-input status-toggle"
                                                                    type="checkbox" data-provider-id="{{ $provider->id }}"
                                                                    {{ ($provider->status ?? 0) == 1 ? 'checked' : '' }}>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <!-- Nút Kiểm tra số dư -->
                                                                <button type="button" class="btn btn-sm btn-outline-success"
                                                                    title="Kiểm tra số dư"
                                                                    onclick="checkBalance({{ $provider->id }})">
                                                                    <i class="bx bx-dollar"></i>
                                                                </button>

                                                                <!-- Nút Sửa -->
                                                                <button type="button" class="btn btn-sm btn-outline-info"
                                                                    title="Chỉnh sửa"
                                                                    onclick="editProviderModal({{ $provider->id }})">
                                                                    <i class="bx bx-edit"></i>
                                                                </button>

                                                                <!-- Nút Xóa -->
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-danger delete-provider-btn"
                                                                    title="Xóa nhà cung cấp"
                                                                    data-provider-id="{{ $provider->id }}"
                                                                    data-provider-name="{{ $provider->name }}">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>

                                                                <!-- Hidden delete form -->
                                                                <form id="delete-form-{{ $provider->id }}"
                                                                    action="{{ route('admin.provider.destroy', $provider) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center py-4">
                                                            <div class="text-muted">
                                                                <i class="bx bx-info-circle me-1"></i>
                                                                Không có dữ liệu nhà cung cấp nào
                                                            </div>
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
                                        <i class="bx bx-server display-4 text-muted mb-3"></i>
                                        <h5 class="text-muted">Chưa có nhà cung cấp nào</h5>
                                        <p class="text-muted mb-4">Nhấn nút "Thêm nhà cung cấp" để bắt đầu thêm nhà cung cấp vào hệ thống.</p>
                                        <a href="{{ route('admin.provider.create') }}" class="btn btn-primary">
                                            <i class="bx bx-plus me-1"></i>Thêm nhà cung cấp đầu tiên
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

    @include('admin.provider.edit')
    @include('admin.provider.delete')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Checkbox functionality
            $('#checkAll-providers').change(function() {
                $('.provider-checkbox').prop('checked', $(this).is(':checked'));
            });

            $('.provider-checkbox').change(function() {
                var total = $('.provider-checkbox').length;
                var checked = $('.provider-checkbox:checked').length;
                $('#checkAll-providers').prop('checked', total === checked);
                $('#checkAll-providers').prop('indeterminate', checked > 0 && checked < total);
            });
        });

        // Check balance function
        window.checkBalance = function(providerId) {
            const balanceEl = $('#balance-' + providerId);
            const originalHtml = balanceEl.html();
            
            // Show loading spinner
            balanceEl.html('<i class="bx bx-loader-alt bx-spin text-primary"></i>');
            
            $.ajax({
                url: '/admin/provider/' + providerId + '/balance',
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    if (response.success) {
                        balanceEl.html('<b class="text-success">' + response.currency + '</b> ' + parseFloat(response.balance).toFixed(4));
                    } else {
                        balanceEl.html('<span class="text-danger">Lỗi: ' + response.error + '</span>');
                    }
                },
                error: function() {
                    balanceEl.html(originalHtml);
                }
            });
        };

        // Sync all balances
        $('#syncAllBalances').on('click', function() {
            const btn = $(this);
            const originalHtml = btn.html();
            
            btn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i>Đang đồng bộ...');
            
            // Show loading on all balance cells
            $('.provider-row').each(function() {
                const id = $(this).data('id');
                $('#balance-' + id).html('<i class="bx bx-loader-alt bx-spin text-primary"></i>');
            });
            
            $.ajax({
                url: '{{ route("admin.provider.sync-all-balances") }}',
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    if (response.success && response.results) {
                        response.results.forEach(function(result) {
                            const balanceEl = $('#balance-' + result.id);
                            if (result.success) {
                                balanceEl.html('<b class="text-success">' + result.currency + '</b> ' + parseFloat(result.balance).toFixed(4));
                            } else {
                                balanceEl.html('<span class="text-danger">Lỗi</span>');
                            }
                        });
                    }
                },
                complete: function() {
                    btn.prop('disabled', false).html(originalHtml);
                }
            });
        });

        // Toggle status
        $(document).on('change', '.status-toggle', function() {
            const providerId = $(this).data('provider-id');
            const isChecked = $(this).is(':checked');
            const row = $(`.provider-row[data-id="${providerId}"]`);

            // Update UI immediately
            if (isChecked) {
                row.removeClass('provider-disabled');
                row.attr('data-status', '1');
            } else {
                row.addClass('provider-disabled');
                row.attr('data-status', '0');
            }

            // Send request to server
            $.ajax({
                url: '/admin/provider/' + providerId + '/toggle-status',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', response.message || 'Cập nhật trạng thái thành công');
                    } else {
                        showToast('error', response.message || 'Có lỗi xảy ra');
                        // Revert UI if server error
                        if (isChecked) {
                            row.addClass('provider-disabled');
                            row.attr('data-status', '0');
                        } else {
                            row.removeClass('provider-disabled');
                            row.attr('data-status', '1');
                        }
                        $(this).prop('checked', !isChecked);
                    }
                },
                error: function() {
                    showToast('error', 'Có lỗi xảy ra khi cập nhật trạng thái');
                    // Revert UI if network error
                    if (isChecked) {
                        row.addClass('provider-disabled');
                        row.attr('data-status', '0');
                    } else {
                        row.removeClass('provider-disabled');
                        row.attr('data-status', '1');
                    }
                    $(`.status-toggle[data-provider-id="${providerId}"]`).prop('checked', !isChecked);
                }
            });
        });

        function showToast(type, message) {
            // Remove existing toasts
            $('.toast-notification').remove();

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

            // Auto remove after different durations based on type
            const duration = type === 'error' ? 6000 : (type === 'info' ? 3000 : 4000);
            setTimeout(() => {
                if (toast.parentNode) {
                    $(toast).fadeOut(300, function() {
                        $(this).remove();
                    });
                }
            }, duration);
        }
    </script>
@endpush


<style>
    /* Provider row styling based on status */
    .provider-row {
        transition: all 0.3s ease;
    }

    /* Disabled provider row - secondary/dark color */
    .provider-row.provider-disabled {
        background-color: #f8f9fa !important;
        opacity: 0.7;
    }

    .provider-row.provider-disabled td {
        color: #6c757d;
    }

    /* Keep status toggle td color unchanged */
    .provider-row.provider-disabled td:has(.status-toggle) {
        background-color: transparent !important;
        opacity: 1 !important;
        color: inherit;
    }

    .provider-row.provider-disabled h6 {
        color: #6c757d;
    }

    .provider-row.provider-disabled .badge {
        opacity: 0.8;
    }

    /* Hover effect for disabled rows */
    .provider-row.provider-disabled:hover {
        background-color: #e9ecef !important;
        opacity: 0.85;
    }

    .provider-row.provider-disabled:hover td:has(.status-toggle) {
        background-color: transparent !important;
        opacity: 1 !important;
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

<script>
    // Initialize styling on page load
    $(document).ready(function() {
        $('.status-toggle').each(function() {
            const providerId = $(this).data('provider-id');
            const isChecked = $(this).is(':checked');
            const row = $(`.provider-row[data-id="${providerId}"]`);

            if (!isChecked) {
                row.addClass('provider-disabled');
            }
        });
    });
</script>
