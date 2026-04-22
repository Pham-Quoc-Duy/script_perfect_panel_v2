@extends('admin.layouts.app')

@section('title', 'Quản lý thành viên')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Quản lý thành viên',
                    'breadcrumb' => 'Thành viên',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            @if ($users && $users->count() > 0)
                                <div class="card-header">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                            <i class="bx bx-plus me-1"></i> Thêm thành viên
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{-- Filter Options --}}
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <select class="form-select" id="levelFilter">
                                                <option value="">Tất cả cấp bậc</option>
                                                <option value="retail" {{ request('level') === 'retail' ? 'selected' : '' }}>Retail</option>
                                                <option value="agent" {{ request('level') === 'agent' ? 'selected' : '' }}>Agent</option>
                                                <option value="distributor" {{ request('level') === 'distributor' ? 'selected' : '' }}>Distributor</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-select" id="statusFilter">
                                                <option value="">Tất cả trạng thái</option>
                                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Hoạt động</option>
                                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Tắt</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            @if (request('level') !== null || request('status') !== null)
                                                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary w-100"></a>                                                  <i class="bx bx-reset me-1"></i>Xóa bộ lọc
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Table Container -->
                                    <div class="table-responsive position-relative">
                                        <!-- Main Table -->
                                        <table id="datatable" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                            <thead>
                                                <tr class="bg-transparent">
                                                    <th style="width: 30px;">
                                                        <div class="form-check font-size-16">
                                                            <input type="checkbox" name="checkAll" class="form-check-input checkbox-select-all" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th style="width: 120px;">ID</th>
                                                    <th>Họ và tên</th>
                                                    <th>Email</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Tiền</th>
                                                    <th>Cấp bậc</th>
                                                    <th style="width: 100px;">Trạng thái</th>
                                                    <th style="width: 140px;">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody id="userTableBody">
                                                @forelse ($users ?? [] as $user)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input checkbox-item" value="{{ $user->id }}">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>

                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone ?? '' }}</td>
                                                        <td>${{ number_format($user->balance ?? 0, 2) }}</td>
                                                        <td>
                                                            @if ($user->level)
                                                                <span class="badge 
                                                                    @if ($user->level === 'retail') badge-soft-info
                                                                    @elseif($user->level === 'agent') badge-soft-warning
                                                                    @elseif($user->level === 'distributor') badge-soft-success
                                                                    @else badge-soft-secondary @endif
                                                                    font-size-12">
                                                                    {{ ucfirst($user->level) }}
                                                                </span>
                                                            @else
                                                                <span class="badge badge-soft-secondary font-size-12">-</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch mb-0">
                                                                <input class="form-check-input status-toggle" type="checkbox" 
                                                                       data-user-id="{{ $user->id }}"
                                                                       {{ ($user->is_active ?? 0) == 1 ? 'checked' : '' }}>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <!-- Nút Cập nhật balance -->
                                                                <button type="button" class="btn btn-sm btn-outline-success" title="Cập nhật balance" onclick="openBalanceModal({{ $user->id }}, '{{ $user->name }}', {{ $user->balance ?? 0 }})">
                                                                    <i class="bx bx-dollar"></i>
                                                                </button>


                                                                <!-- Nút Sửa -->
                                                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-info" title="Chỉnh sửa">
                                                                    <i class="bx bx-edit"></i>
                                                                </a>

                                                                <!-- Nút Xóa -->
                                                                <button type="button" class="btn btn-sm btn-outline-danger delete-user-btn" title="Xóa thành viên" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>

                                                                <!-- Hidden delete form -->
                                                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="9" class="text-center py-4">
                                                            <div class="text-muted">
                                                                <i class="bx bx-info-circle me-1"></i>
                                                                Không có dữ liệu thành viên nào
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
                                        <i class="bx bx-user-x display-4 text-muted mb-3"></i>
                                        <h5 class="text-muted">Chưa có thành viên nào</h5>
                                        <p class="text-muted mb-4">Nhấn nút "Thêm thành viên" để bắt đầu thêm thành viên vào hệ thống.</p>
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                            <i class="bx bx-plus me-1"></i>Thêm thành viên đầu tiên
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

    <!-- Balance Update Modal -->
    <div class="modal fade" id="balanceModal" tabindex="-1" role="dialog" aria-labelledby="balanceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="balanceModalLabel">Cập nhật Balance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Thành viên</label>
                        <input type="text" class="form-control" id="balanceUserName" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số dư hiện tại</label>
                        <input type="text" class="form-control" id="balanceCurrentBalance" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loại thao tác</label>
                        <select class="form-select" id="balanceType">
                            <option value="add">Cộng (+)</option>
                            <option value="subtract">Trừ (-)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số tiền (USD)</label>
                        <input type="number" class="form-control" id="balanceAmount" placeholder="Nhập số tiền" step="0.01" min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ghi chú</label>
                        <textarea class="form-control" id="balanceNote" rows="2" placeholder="Ghi chú (tùy chọn)"></textarea>
                    </div>
                    <div class="alert alert-info" id="balancePreview" style="display: none;">
                        <small id="balancePreviewText"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="balanceSubmitBtn">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable if there's data
            if ($('#datatable tbody tr').length > 0) {
                initializeDataTable();
            }

            // Checkbox Select All - chỉ cho checkbox items, không ảnh hưởng status-toggle
            $('#checkAll').change(function() {
                $('.checkbox-item').prop('checked', this.checked);
            });

            // Individual checkbox change
            $(document).on('change', '.checkbox-item', function() {
                const total = $('.checkbox-item').length;
                const checked = $('.checkbox-item:checked').length;
                $('#checkAll').prop('indeterminate', checked > 0 && checked < total);
                $('#checkAll').prop('checked', checked === total);
            });

            // Filter functionality
            $('#levelFilter, #statusFilter').change(function() {
                applyFilters();
            });
        });

        function initializeDataTable() {
            if (!$.fn.DataTable.isDataTable('#datatable')) {
                $('#datatable').DataTable({
                    responsive: true,
                    language: {
                        "decimal": "",
                        "emptyTable": "Không có dữ liệu trong bảng",
                        "info": "Hiển thị _START_ đến _END_ của _TOTAL_ kết quả",
                        "infoEmpty": "Hiển thị 0 đến 0 của 0 kết quả",
                        "infoFiltered": "(lọc từ _MAX_ kết quả)",
                        "infoPostFix": "",
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
                        targets: [0, -1]
                    }],
                    pageLength: 25,
                    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                    order: [[1, 'desc']]
                });
            }
        }

        function applyFilters() {
            var params = new URLSearchParams();
            var level = $('#levelFilter').val();
            var status = $('#statusFilter').val();
            
            if (level !== '') params.set('level', level);
            if (status !== '') params.set('status', status);
            
            const url = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
            window.location.href = url;
        }

        // Toggle status - riêng biệt với checkbox
        $(document).on('change', '.status-toggle', function() {
            const userId = $(this).data('user-id');
            const isChecked = $(this).is(':checked');
            
            $.ajax({
                url: `/admin/users/${userId}/toggle-status`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showToast('success', response.message);
                    } else {
                        showToast('error', response.message);
                        $(`.status-toggle[data-user-id="${userId}"]`).prop('checked', !isChecked);
                    }
                },
                error: function() {
                    showToast('error', 'Có lỗi xảy ra khi cập nhật trạng thái');
                    $(`.status-toggle[data-user-id="${userId}"]`).prop('checked', !isChecked);
                }
            });
        });

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

        // Balance Modal Functions
        let currentUserId = null;

        function openBalanceModal(userId, userName, currentBalance) {
            currentUserId = userId;
            document.getElementById('balanceUserName').value = userName;
            document.getElementById('balanceCurrentBalance').value = '$' + parseFloat(currentBalance).toFixed(2);
            document.getElementById('balanceAmount').value = '';
            document.getElementById('balanceType').value = 'add';
            document.getElementById('balanceNote').value = '';
            document.getElementById('balancePreview').style.display = 'none';
            
            const balanceModal = new bootstrap.Modal(document.getElementById('balanceModal'));
            balanceModal.show();
        }

        document.getElementById('balanceAmount').addEventListener('input', function() {
            updateBalancePreview();
        });

        document.getElementById('balanceType').addEventListener('change', function() {
            updateBalancePreview();
        });

        function updateBalancePreview() {
            const amount = parseFloat(document.getElementById('balanceAmount').value) || 0;
            const type = document.getElementById('balanceType').value;
            const currentBalance = parseFloat(document.getElementById('balanceCurrentBalance').value.replace('$', ''));
            
            if (amount > 0) {
                let newBalance;
                if (type === 'add') {
                    newBalance = currentBalance + amount;
                    document.getElementById('balancePreviewText').textContent = 
                        `Cộng $${amount.toFixed(2)} → Số dư mới: $${newBalance.toFixed(2)}`;
                } else {
                    if (amount > currentBalance) {
                        document.getElementById('balancePreviewText').textContent = 
                            `⚠️ Cảnh báo: Số dư không đủ! (Hiện tại: $${currentBalance.toFixed(2)})`;
                        document.getElementById('balancePreview').className = 'alert alert-warning';
                    } else {
                        newBalance = currentBalance - amount;
                        document.getElementById('balancePreviewText').textContent = 
                            `Trừ $${amount.toFixed(2)} → Số dư mới: $${newBalance.toFixed(2)}`;
                        document.getElementById('balancePreview').className = 'alert alert-info';
                    }
                }
                document.getElementById('balancePreview').style.display = 'block';
            } else {
                document.getElementById('balancePreview').style.display = 'none';
            }
        }

        document.getElementById('balanceSubmitBtn').addEventListener('click', function() {
            const amount = parseFloat(document.getElementById('balanceAmount').value);
            const type = document.getElementById('balanceType').value;
            const note = document.getElementById('balanceNote').value;

            if (!amount || amount <= 0) {
                showToast('error', 'Vui lòng nhập số tiền hợp lệ!');
                return;
            }

            const submitBtn = this;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Đang cập nhật...';

            fetch(`/admin/users/${currentUserId}/update-balance`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    amount: amount,
                    type: type,
                    note: note
                })
            })
            .then(r => r.json())
            .then(response => {
                if (response.success) {
                    showToast('success', response.message);
                    bootstrap.Modal.getInstance(document.getElementById('balanceModal')).hide();
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showToast('error', response.message);
                }
            })
            .catch(err => {
                showToast('error', 'Có lỗi xảy ra!');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Cập nhật';
            });
        });
    </script>
@endpush
