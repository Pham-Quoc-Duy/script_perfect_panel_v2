@extends('admin.layouts.app')

@section('title', 'Quản lý phương thức thanh toán')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Quản lý phương thức thanh toán',
                    'breadcrumb' => 'Phương thức thanh toán',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            @if (($paymentMethods ?? collect())->count() > 0)
                                <div class="card-header">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin.payments.method.create') }}" class="btn btn-primary">
                                            <i class="bx bx-plus me-1"></i> Thêm phương thức
                                        </a>
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
                                    </div>

                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                            <thead>
                                                <tr class="bg-transparent">
                                                    <th style="width: 30px;">
                                                        <div class="form-check font-size-16">
                                                            <input type="checkbox" name="check" class="form-check-input"
                                                                id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th style="width: 50px;"></th>
                                                    <th style="width: 120px;">ID</th>
                                                    <th style="width: 80px;">Hình ảnh</th>
                                                    <th>Tên phương thức</th>
                                                    <th>Loại</th>
                                                    <th>Số thanh toán</th>
                                                    <th>Trạng thái</th>
                                                    <th style="width: 140px;">Thao tác</th>
                                                </tr>
                                            </thead>

                                            <tbody id="paymentMethodTableBody">
                                                @foreach ($paymentMethods ?? [] as $paymentMethod)
                                                    <tr class="payment-method-row" draggable="false"
                                                        data-payment-method-id="{{ $paymentMethod->id }}"
                                                        data-position="{{ $paymentMethod->position ?? 0 }}">
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input"
                                                                    value="{{ $paymentMethod->id }}">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>

                                                        <td class="drag-handle" style="cursor: grab;" data-draggable="true">
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <i class="bx bx-menu font-size-20 text-muted drag-icon"
                                                                    title="Giữ và kéo để thay đổi vị trí"
                                                                    style="cursor: grab;"></i>
                                                                <span
                                                                    class="badge bg-secondary ms-2 position-badge">{{ $paymentMethod->position ?? 0 }}</span>
                                                            </div>
                                                        </td>

                                                        <td><a href="{{ route('admin.payments.method.show', $paymentMethod) }}"
                                                                class="text-body fw-medium">#{{ $paymentMethod->id }}</a>
                                                        </td>

                                                        <td>
                                                            @if ($paymentMethod->image_url)
                                                                <img src="{{ $paymentMethod->image_url }}"
                                                                    alt="{{ $paymentMethod->localized_name }}"
                                                                    class="avatar-sm rounded"
                                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                                            @else
                                                                <div
                                                                    class="avatar-sm bg-light rounded d-inline-flex align-items-center justify-content-center">
                                                                    <i class="bx bx-credit-card font-size-14 text-muted"></i>
                                                                </div>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <h6 class="mb-0">{{ $paymentMethod->localized_name }}</h6>
                                                            <small class="text-muted">
                                                                {{ $paymentMethod->getName('en') }} /
                                                                {{ $paymentMethod->getName('vi') }}
                                                            </small>
                                                        </td>

                                                        <td>
                                                            <span class="badge badge-soft-primary">
                                                                {{ $paymentMethod->type_label }}
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <span class="badge badge-soft-info">
                                                                {{ $paymentMethod->payments_count ?? 0 }}
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div class="form-check form-switch mb-0">
                                                                    <input class="form-check-input status-toggle" type="checkbox" 
                                                                           data-payment-method-id="{{ $paymentMethod->id }}"
                                                                           {{ ($paymentMethod->status ?? 0) == 1 ? 'checked' : '' }}>
                                                                </div>
                                                                <div class="status-indicator">
                                                                    @if(($paymentMethod->status ?? 0) == 1)
                                                                        <span class="badge badge-soft-success font-size-12">
                                                                            <i class="bx bx-check-circle me-1"></i>Hoạt động
                                                                        </span>
                                                                    @else
                                                                        <span class="badge badge-soft-danger font-size-12">
                                                                            <i class="bx bx-x-circle me-1"></i>Tạm dừng
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <!-- Nút Xem -->
                                                                <button type="button" class="btn btn-sm btn-outline-info"
                                                                    title="Xem thông tin"
                                                                    onclick="showPaymentMethodModal({{ $paymentMethod->id }})">
                                                                    <i class="bx bx-show"></i>
                                                                </button>

                                                                <!-- Nút Sửa -->
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-primary" title="Chỉnh sửa"
                                                                    onclick="editPaymentMethodModal({{ $paymentMethod->id }})">
                                                                    <i class="bx bx-edit"></i>
                                                                </button>

                                                                <!-- Nút Xóa -->
                                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                                    title="Xóa phương thức"
                                                                    onclick="deletePaymentMethod({{ $paymentMethod->id }})">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>
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
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bx bx-credit-card font-size-48 text-muted mb-3"></i>
                                            <h5 class="text-muted">Không tìm thấy phương thức thanh toán</h5>
                                            <p class="text-muted mb-3">Chưa có phương thức thanh toán nào trong hệ thống.</p>
                                            <a href="{{ route('admin.payments.method.create') }}" class="btn btn-primary">
                                                <i class="bx bx-plus me-1"></i> Thêm phương thức
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
    @include('admin.payment-methods.show')
    @include('admin.payment-methods.edit')
    @include('admin.payment-methods.delete')

@endsection

@push('styles')
    <style>
        .avatar-sm {
            width: 2rem;
            height: 2rem;
        }

        .table td {
            vertical-align: middle;
        }

        .badge {
            font-weight: 500;
        }

        .payment-method-row {
            transition: all 0.3s ease;
        }

        .payment-method-row:hover .drag-handle {
            cursor: grab;
            color: #007bff;
        }

        .payment-method-row:active .drag-handle {
            cursor: grabbing;
        }

        .drag-handle {
            transition: all 0.2s ease;
        }

        .payment-method-row[draggable="true"] {
            user-select: none;
        }

        @keyframes swapPulse {
            0% {
                background-color: #ffebee;
                transform: scale(1);
            }
            50% {
                background-color: #ef5350;
                transform: scale(1.02);
            }
            100% {
                background-color: transparent;
                transform: scale(1);
            }
        }

        .swap-animation {
            animation: swapPulse 0.6s ease-in-out;
        }

        .payment-method-row.swap-animation {
            box-shadow: 0 4px 8px rgba(239, 83, 80, 0.3);
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            if ($.fn.DataTable.isDataTable('#datatable')) {
                $('#datatable').DataTable().destroy();
            }
            
            $('#datatable').DataTable({
                responsive: true,
                language: {
                    "decimal": "",
                    "emptyTable": "Không có dữ liệu trong bảng",
                    "info": "Hiển thị _START_ đến _END_ của _TOTAL_ kết quả",
                    "infoEmpty": "Hiển thị 0 đến 0 của 0 kết quả",
                    "infoFiltered": "(lọc từ _MAX_ kết quả)",
                    "thousands": ",",
                    "lengthMenu": "Hiển thị _MENU_ kết quả",
                    "loadingRecords": "Đang tải...",
                    "processing": "Đang xử lý...",
                    "search": "Tìm kiếm:",
                    "zeroRecords": "Không tìm thấy kết quả nào",
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Tiếp",
                        "previous": "Trước"
                    }
                },
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, -1]
                }],
                pageLength: 25,
                order: [[2, 'desc']]
            });

            // Check all functionality
            $('#checkAll').change(function() {
                $('.form-check-input[value]').prop('checked', this.checked);
            });

            setupDragAndDrop();
        });

        // Toggle status
        $(document).on('change', '.status-toggle', function() {
            const paymentMethodId = $(this).data('payment-method-id');
            const isChecked = $(this).is(':checked');
            const statusIndicator = $(this).closest('td').find('.status-indicator');
            
            $.ajax({
                url: `/admin/payment-methods/${paymentMethodId}/toggle-status`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', response.message);
                        if (response.status === 1) {
                            statusIndicator.html('<span class="badge badge-soft-success font-size-12"><i class="bx bx-check-circle me-1"></i>Hoạt động</span>');
                        } else {
                            statusIndicator.html('<span class="badge badge-soft-danger font-size-12"><i class="bx bx-x-circle me-1"></i>Tạm dừng</span>');
                        }
                    } else {
                        showToast('error', response.message);
                        $(this).prop('checked', !isChecked);
                    }
                },
                error: function() {
                    showToast('error', 'Có lỗi xảy ra khi cập nhật trạng thái');
                    $(`.status-toggle[data-payment-method-id="${paymentMethodId}"]`).prop('checked', !isChecked);
                }
            });
        });

        // Delete payment method
        function deletePaymentMethod(id) {
            if (confirm('Bạn có chắc chắn muốn xóa phương thức thanh toán này không?')) {
                $.ajax({
                    url: `/admin/payment-methods/${id}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        showToast('success', 'Phương thức thanh toán đã được xóa thành công!');
                        setTimeout(() => window.location.reload(), 1500);
                    },
                    error: function() {
                        showToast('error', 'Có lỗi xảy ra khi xóa phương thức thanh toán');
                    }
                });
            }
        }

        // Toast notification function
        function showToast(type, message) {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            toast.innerHTML = `${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
            
            document.body.appendChild(toast);
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 5000);
        }

        // Drag and drop functionality (similar to category)
        let draggedRow = null;
        let canDrag = false;

        function setupDragAndDrop() {
            const rows = document.querySelectorAll('.payment-method-row');
            const dragHandles = document.querySelectorAll('.drag-handle');

            dragHandles.forEach(handle => {
                handle.addEventListener('mousedown', function(e) {
                    const row = this.closest('.payment-method-row');
                    row.draggable = true;
                    canDrag = true;
                });

                handle.addEventListener('mouseup', function(e) {
                    const row = this.closest('.payment-method-row');
                    setTimeout(() => {
                        row.draggable = false;
                        canDrag = false;
                    }, 100);
                });
            });

            rows.forEach(row => {
                row.addEventListener('dragstart', handleDragStart);
                row.addEventListener('dragover', handleDragOver);
                row.addEventListener('drop', handleDrop);
                row.addEventListener('dragend', handleDragEnd);
                row.addEventListener('dragenter', handleDragEnter);
                row.addEventListener('dragleave', handleDragLeave);
            });
        }

        function handleDragStart(e) {
            if (!canDrag) {
                e.preventDefault();
                return;
            }
            draggedRow = this;
            this.style.opacity = '0.5';
        }

        function handleDragOver(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }
            return false;
        }

        function handleDragEnter(e) {
            if (this !== draggedRow) {
                this.style.borderTop = '3px solid #007bff';
            }
        }

        function handleDragLeave(e) {
            this.style.borderTop = 'none';
        }

        function handleDrop(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            }

            if (draggedRow !== this) {
                const draggedId = draggedRow.dataset.paymentMethodId;
                const targetId = this.dataset.paymentMethodId;

                // Update positions and send to server
                updatePositions(draggedId, targetId);
            }

            this.style.borderTop = 'none';
            return false;
        }

        function handleDragEnd(e) {
            this.style.opacity = '1';
            document.querySelectorAll('.payment-method-row').forEach(row => {
                row.style.borderTop = 'none';
            });
        }

        function updatePositions(paymentMethodId1, paymentMethodId2) {
            fetch('{{ route('admin.payments.method.index') }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    action: 'reorder',
                    payment_methods: [
                        { id: paymentMethodId1 },
                        { id: paymentMethodId2 }
                    ]
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('success', data.message);
                } else {
                    showToast('error', data.message || 'Có lỗi xảy ra');
                    setTimeout(() => location.reload(), 1500);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('error', 'Có lỗi xảy ra');
                setTimeout(() => location.reload(), 1500);
            });
        }
    </script>
@endpush