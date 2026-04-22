@extends('admin.layouts.app')

@section('title', 'Phương thức')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- Header Section -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="mb-1">Phương thức</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#" class="text-muted">Thanh toán</a></li>
                                <li class="breadcrumb-item active">Phương thức</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-muted small">2025/12/24 (+07:00)</span>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bx bx-user me-1"></i>
                            </button>
                        </div>
                    </div>
                </div>

                @include('admin.components.alert')

                <!-- Main Content -->
                <div class="row">
                    <div class="col-12">
                        <!-- Header with Add Button -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Danh sách</h5>
                            <button class="btn btn-primary btn-sm" onclick="window.location.href='{{ route('admin.payments.create') }}'">
                                Thêm phương thức
                            </button>
                        </div>

                        @if (($payments ?? collect())->count() > 0)
                            <!-- Payments Table -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-middle datatable dt-responsive table-check nowrap" id="paymentsTable"
                                            style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                            <thead>
                                                <tr class="bg-transparent">
                                                    <th style="width: 30px;">
                                                        <div class="form-check font-size-16">
                                                            <input type="checkbox" name="check" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th></th>
                                                    <th style="width: 80px;">ID</th>
                                                    <th>Phương thức</th>
                                                    <th>Tên & Chi tiết</th>
                                                    <th style="width: 200px;">Webhook URL</th>
                                                    <th style="width: 120px;">Tiền tệ</th>
                                                    <th style="width: 100px;">Trạng thái</th>
                                                    <th style="width: 140px;">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody id="sortablePayments">
                                                @foreach ($payments as $payment)
                                                    <tr class="payment-row" data-id="{{ $payment->id }}" data-position="{{ $payment->position ?? 0 }}">
                                                        <!-- Checkbox -->
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input" value="{{ $payment->id }}">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>

                                                        <!-- Drag Handle -->
                                                        <td class="text-center drag-handle align-middle" style="cursor: grab;">
                                                            <div class="drag-icon d-flex justify-content-center">
                                                                <i class="bx bx-menu text-muted" style="font-size: 18px;"></i>
                                                            </div>
                                                        </td>

                                                        <!-- ID -->
                                                        <td>
                                                            <a href="javascript:void(0);" class="text-body fw-medium">#{{ $payment->id }}</a>
                                                        </td>

                                                        <!-- Payment Method Icon & Name -->
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                @php
                                                                    $methodName = strtolower($payment->paymentMethod->name ?? '');
                                                                    $iconConfig = [
                                                                        'acb' => ['icon' => 'bx-building-house', 'color' => '#0066cc', 'bg' => '#e6f3ff'],
                                                                        'sieuthocode' => ['icon' => 'bx-building-house', 'color' => '#0066cc', 'bg' => '#e6f3ff'],
                                                                        'binance' => ['icon' => 'bx-bitcoin', 'color' => '#f0b90b', 'bg' => '#fff8e1'],
                                                                        'fpayv2' => ['icon' => 'bx-bitcoin', 'color' => '#f0b90b', 'bg' => '#fff8e1'],
                                                                        'payeer' => ['icon' => 'bx-credit-card', 'color' => '#00a651', 'bg' => '#e8f5e8'],
                                                                        'cryptomus' => ['icon' => 'bx-bitcoin', 'color' => '#8b5cf6', 'bg' => '#f3e8ff'],
                                                                        'vietcombank' => ['icon' => 'bx-building-house', 'color' => '#007ac2', 'bg' => '#e6f3ff'],
                                                                        'techcombank' => ['icon' => 'bx-building-house', 'color' => '#00b14f', 'bg' => '#e8f5e8'],
                                                                        'mbbank' => ['icon' => 'bx-building-house', 'color' => '#1e40af', 'bg' => '#dbeafe'],
                                                                        'manual' => ['icon' => 'bx-book', 'color' => '#6c757d', 'bg' => '#f8f9fa'],
                                                                        'perfect' => ['icon' => 'bx-credit-card', 'color' => '#dc3545', 'bg' => '#ffeaea'],
                                                                        'paypal' => ['icon' => 'bx-credit-card', 'color' => '#0070ba', 'bg' => '#e6f3ff'],
                                                                        'xendit' => ['icon' => 'bx-wallet', 'color' => '#6366f1', 'bg' => '#f0f0ff'],
                                                                    ];
                                                                    
                                                                    $config = null;
                                                                    foreach ($iconConfig as $key => $cfg) {
                                                                        if (str_contains($methodName, $key)) {
                                                                            $config = $cfg;
                                                                            break;
                                                                        }
                                                                    }
                                                                    
                                                                    if (!$config) {
                                                                        $config = ['icon' => 'bx-wallet', 'color' => '#6c757d', 'bg' => '#f8f9fa'];
                                                                    }
                                                                @endphp
                                                                
                                                                @if($payment->image_url)
                                                                    <img src="{{ $payment->image_url }}" alt="{{ $payment->paymentMethod->name ?? '' }}" 
                                                                         class="rounded me-3" style="width: 32px; height: 32px; object-fit: cover;">
                                                                @else
                                                                    <div class="rounded d-flex align-items-center justify-content-center me-3" 
                                                                         style="width: 32px; height: 32px; background: {{ $config['bg'] }}; border: 1px solid {{ $config['color'] }}20;">
                                                                        <i class="bx {{ $config['icon'] }}" style="font-size: 16px; color: {{ $config['color'] }};"></i>
                                                                    </div>
                                                                @endif
                                                                <div>
                                                                    <span class="fw-medium text-dark">{{ $payment->paymentMethod->name ?? 'N/A' }}</span>
                                                                    @if($payment->payment_type)
                                                                        <br><span class="badge badge-soft-info font-size-12">{{ ucfirst($payment->payment_type) }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <!-- Payment Name & Details -->
                                                        <td>
                                                            <div>
                                                                <div class="fw-medium text-dark mb-1">
                                                                    {{ $payment->name }}
                                                                    @if($payment->bonus && count($payment->bonus) > 0)
                                                                        <i class="bx bx-gift text-warning ms-1" title="Có bonus"></i>
                                                                    @endif
                                                                </div>
                                                                
                                                                @if($payment->payment_type === 'vietnamese_bank' && $payment->account_number)
                                                                    <small class="text-muted d-block">{{ $payment->account_number }}</small>
                                                                    @if($payment->account_name)
                                                                        <small class="text-muted">{{ $payment->account_name }}</small>
                                                                    @endif
                                                                @elseif($payment->payment_type === 'binance' && $payment->binance_id)
                                                                    <small class="text-muted d-block">ID: {{ $payment->binance_id }}</small>
                                                                @elseif($payment->payment_type === 'payeer' && $payment->merchant_id)
                                                                    <small class="text-muted d-block">{{ $payment->merchant_id }}</small>
                                                                @endif
                                                                
                                                                @if($payment->bonus && count($payment->bonus) > 0)
                                                                    <div class="mt-1">
                                                                        @foreach($payment->bonus as $index => $rule)
                                                                            @if($index < 2)
                                                                                <span class="badge bg-success text-white me-1" style="font-size: 10px;">
                                                                                    {{ number_format($rule['min_amount'] ?? 0, 0, ',', '.') }}+ → {{ $rule['bonus_percent'] ?? 0 }}%
                                                                                </span>
                                                                            @endif
                                                                        @endforeach
                                                                        @if(count($payment->bonus) > 2)
                                                                            <span class="badge bg-info text-white" style="font-size: 10px;">+{{ count($payment->bonus) - 2 }}</span>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td>

                                                        <!-- Webhook URL -->
                                                        <td>
                                                            <div class="webhook-info">
                                                                @if($payment->webhook_url)
                                                                    <div class="d-flex align-items-center mb-1">
                                                                        <i class="bx bx-link-external text-primary me-1"></i>
                                                                        <small class="text-muted">Webhook URL</small>
                                                                    </div>
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="text" class="form-control form-control-sm" 
                                                                               value="{{ $payment->webhook_url }}" 
                                                                               readonly 
                                                                               id="webhook-{{ $payment->id }}"
                                                                               style="font-size: 11px;">
                                                                        <button class="btn btn-outline-secondary btn-sm" 
                                                                                type="button" 
                                                                                onclick="copyWebhookUrl('webhook-{{ $payment->id }}')"
                                                                                title="Copy URL">
                                                                            <i class="bx bx-copy" style="font-size: 12px;"></i>
                                                                        </button>
                                                                    </div>
                                                                    @if($payment->signature)
                                                                        <div class="mt-1">
                                                                            <small class="text-muted">Signature:</small>
                                                                            <div class="input-group input-group-sm mt-1">
                                                                                <input type="text" class="form-control form-control-sm" 
                                                                                       value="{{ $payment->signature }}" 
                                                                                       readonly 
                                                                                       id="signature-{{ $payment->id }}"
                                                                                       style="font-size: 10px;">
                                                                                <button class="btn btn-outline-secondary btn-sm" 
                                                                                        type="button" 
                                                                                        onclick="copyWebhookUrl('signature-{{ $payment->id }}')"
                                                                                        title="Copy Signature">
                                                                                    <i class="bx bx-copy" style="font-size: 12px;"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <div class="text-center text-muted">
                                                                        <i class="bx bx-link-external" style="font-size: 24px; opacity: 0.3;"></i>
                                                                        <br><small>Chưa có webhook</small>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td>

                                                        <!-- Currency & Amount Range -->
                                                        <td>
                                                            <div class="d-flex align-items-center mb-1">
                                                                @if($payment->payment_type === 'binance' || str_contains(strtolower($payment->paymentMethod->name ?? ''), 'usd'))
                                                                    <span class="fw-medium">USD</span>
                                                                    <span class="badge bg-warning text-dark ms-2" style="font-size: 10px;">
                                                                        <i class="bx bx-dollar"></i>
                                                                    </span>
                                                                @elseif(str_contains(strtolower($payment->paymentMethod->name ?? ''), 'idr'))
                                                                    <span class="fw-medium">IDR</span>
                                                                    <span class="badge bg-info text-white ms-2" style="font-size: 10px;">
                                                                        <i class="bx bx-money"></i>
                                                                    </span>
                                                                @else
                                                                    <span class="fw-medium">VND</span>
                                                                    <span class="badge bg-primary text-white ms-2" style="font-size: 10px;">
                                                                        <i class="bx bx-money"></i>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <small class="text-muted">
                                                                {{ number_format($payment->min, 0, ',', '.') }} - {{ number_format($payment->max, 0, ',', '.') }}
                                                            </small>
                                                        </td>

                                                        <!-- Status Toggle -->
                                                        <td>
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <div class="form-check form-switch mb-0">
                                                                    <input class="form-check-input status-toggle" type="checkbox" 
                                                                           data-payment-id="{{ $payment->id }}"
                                                                           data-platform="payment"
                                                                           {{ ($payment->status ?? 0) == 1 ? 'checked' : '' }}>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <!-- Actions -->
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-outline-info" 
                                                                   title="Xem thông tin" onclick="showPaymentModal({{ $payment->id }})">
                                                                    <i class="bx bx-show"></i>
                                                                </a>
                                                                <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-sm btn-outline-primary" 
                                                                   title="Chỉnh sửa">
                                                                    <i class="bx bx-edit"></i>
                                                                </a>
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger delete-payment-btn"
                                                                   title="Xóa phương thức" data-payment-id="{{ $payment->id }}" data-payment-name="{{ $payment->name }}">
                                                                    <i class="bx bx-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="card">
                                <div class="card-body text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bx bx-credit-card" style="font-size: 48px; color: #dee2e6;"></i>
                                        <h5 class="text-muted mt-3">Không có phương thức thanh toán</h5>
                                        <p class="text-muted mb-3">Chưa có phương thức thanh toán nào được tạo.</p>
                                        <button class="btn btn-primary" onclick="window.location.href='{{ route('admin.payments.create') }}'">
                                            <i class="bx bx-plus me-1"></i>Thêm phương thức
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('admin.payments.show')
    @include('admin.payments.delete')
@endsection


@push('scripts')
 
    <script>
        $(document).on('change', '.status-toggle', function() {
            const paymentId = $(this).data('payment-id');
            const platform = $(this).data('platform') || 'payment';
            const isChecked = $(this).is(':checked');
            const toggleElement = $(this);
            
            $.ajax({
                url: `/admin/${platform}/${paymentId}/toggle-status`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', response.message);
                        // No need to update status indicators as they are removed
                    } else {
                        showToast('error', response.message);
                        toggleElement.prop('checked', !isChecked);
                    }
                },
                error: function() {
                    showToast('error', 'Có lỗi xảy ra khi cập nhật trạng thái');
                    toggleElement.prop('checked', !isChecked);
                }
            });
        });
        $(document).ready(function() {
            // Initialize DataTable với kiểm tra để tránh reinitialisation
            if ($('#paymentsTable').length && !$.fn.DataTable.isDataTable('#paymentsTable')) {
                $('#paymentsTable').DataTable({
                    "pageLength": 25,
                    "responsive": true,
                    "order": [[ 2, "desc" ]], // Sort by ID desc
                    "columnDefs": [
                        { "orderable": false, "targets": [0, 1, 8] }, // Disable sorting for checkbox, drag handle, actions
                        { "searchable": false, "targets": [0, 1, 8] }
                    ],
                    "language": {
                        "search": "Tìm kiếm:",
                        "lengthMenu": "Hiển thị _MENU_ mục",
                        "info": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                        "infoEmpty": "Hiển thị 0 đến 0 của 0 mục",
                        "infoFiltered": "(lọc từ _MAX_ tổng số mục)",
                        "paginate": {
                            "first": "Đầu",
                            "last": "Cuối",
                            "next": "Tiếp",
                            "previous": "Trước"
                        },
                        "emptyTable": "Không có dữ liệu trong bảng"
                    }
                });
            }

            // Initialize drag & drop
            initializeSortable();
            
            // Checkbox functionality - separate from status toggles
            $('#checkAll').change(function() {
                $('.form-check-input[value]').not('.status-toggle').prop('checked', $(this).is(':checked'));
            });
            
            $('.form-check-input[value]').not('.status-toggle').change(function() {
                var total = $('.form-check-input[value]').not('.status-toggle').length;
                var checked = $('.form-check-input[value]:checked').not('.status-toggle').length;
                $('#checkAll').prop('checked', total === checked);
                $('#checkAll').prop('indeterminate', checked > 0 && checked < total);
            });
            
            // Delete payment functionality
            $(document).on('click', '.delete-payment-btn', function() {
                var paymentId = $(this).data('payment-id');
                var paymentName = $(this).data('payment-name');
                
                if (confirm('Bạn có chắc chắn muốn xóa phương thức "' + paymentName + '" không?')) {
                    $.ajax({
                        url: `/admin/payments/${paymentId}`,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                showToast('success', 'Xóa phương thức thành công!');
                                setTimeout(() => location.reload(), 1000);
                            } else {
                                showToast('error', response.message || 'Có lỗi xảy ra!');
                            }
                        },
                        error: function() {
                            showToast('error', 'Có lỗi xảy ra khi xóa phương thức!');
                        }
                    });
                }
            });
        });
        
        // Copy webhook URL function
        function copyWebhookUrl(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                element.select();
                element.setSelectionRange(0, 99999); // For mobile devices
                
                try {
                    document.execCommand('copy');
                    showToast('success', 'Đã copy vào clipboard!');
                } catch (err) {
                    // Fallback for modern browsers
                    navigator.clipboard.writeText(element.value).then(function() {
                        showToast('success', 'Đã copy vào clipboard!');
                    }, function(err) {
                        showToast('error', 'Không thể copy. Vui lòng copy thủ công.');
                    });
                }
            }
        }

        function initializeSortable() {
            const tbody = document.getElementById('sortablePayments');
            if (!tbody) return;

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
                    
                    const paymentId = evt.item.dataset.id;
                    const newIndex = evt.newIndex;
                    const oldIndex = evt.oldIndex;
                    
                    if (newIndex !== oldIndex) {
                        updatePaymentPosition();
                    }
                }
            });
        }

        function updatePaymentPosition() {
            showToast('info', 'Đang cập nhật thứ tự...');
            
            const paymentIds = [];
            $('#sortablePayments tr').each(function(index) {
                paymentIds.push({
                    id: $(this).data('id'),
                    position: index + 1
                });
            });

            $.ajax({
                url: '{{ route("admin.payments.index") }}',
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    action: 'reorder',
                    payments: paymentIds
                },
                beforeSend: function() {
                    $('.drag-handle').css('pointer-events', 'none').addClass('updating');
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', 'Thứ tự đã được cập nhật thành công!');
                        $('#sortablePayments tr').each(function(index) {
                            $(this).data('position', index + 1);
                        });
                    } else {
                        showToast('error', response.message || 'Có lỗi xảy ra khi cập nhật thứ tự!');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    console.error('Error updating position:', xhr);
                    showToast('error', 'Có lỗi xảy ra khi cập nhật thứ tự!');
                    location.reload();
                },
                complete: function() {
                    $('.drag-handle').css('pointer-events', '').removeClass('updating');
                }
            });
        }

        function showPaymentModal(id) {
            // Implement show payment modal functionality
            showToast('info', 'Chức năng xem chi tiết đang được phát triển...');
        }

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

        // Prevent text selection during drag
        document.addEventListener('selectstart', function(e) {
            if (e.target.closest('.drag-handle')) {
                e.preventDefault();
            }
        });

        // Add keyboard support for accessibility
        $(document).on('keydown', '.drag-handle', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                showToast('info', 'Sử dụng chuột để kéo thả sắp xếp thứ tự');
            }
        });
    </script>
@endpush