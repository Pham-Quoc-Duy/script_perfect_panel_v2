@extends('adminpanel.layouts.app')
@section('content')

<div class="content flex-row-fluid" id="kt_content">
    <div class="card mb-6">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold">Phương Thức Thanh Toán</h3>
            </div>
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary" onclick="openPaymentModal()">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Thêm Mới
                </button>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th>Tên</th>
                            <th>Phương Thức</th>
                            <th>Tiền Tệ</th>
                            <th>Min - Max</th>
                            <th>Trạng Thái</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-800">
                        @forelse($payments ?? [] as $payment)
                            <tr>
                                <td>{{ $payment->name }}</td>
                                <td>{{ $payment->paymentMethod->name ?? 'N/A' }}</td>
                                <td>{{ $payment->currency ?? 'USD' }}</td>
                                <td>${{ number_format($payment->min, 2) }} - ${{ number_format($payment->max, 2) }}</td>
                                <td>
                                    <span class="badge {{ $payment->status ? 'badge-success' : 'badge-danger' }}">
                                        {{ $payment->status ? 'Kích Hoạt' : 'Vô Hiệu' }}
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-light btn-active-light-primary" onclick="editPaymentModal({{ $payment->id }})">
                                        Sửa
                                    </button>
                                    <button type="button" class="btn btn-sm btn-light btn-active-light-danger" onclick="deletePayment({{ $payment->id }})">
                                        Xóa
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <span class="text-muted">Không có dữ liệu</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add/Edit Payment -->
<div class="modal fade" id="kt_modal_payment" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fw-bold" id="modal_title">Thêm Phương Thức Thanh Toán</h4>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                        </svg>
                    </span>
                </div>
            </div>
            <form id="payment_form" method="POST">
                @csrf
                <div class="modal-body scroll-y me-n7 pe-7">
                    <div class="mb-5">
                        <label class="required form-label">Phương Thức Thanh Toán</label>
                        <select class="form-select form-select-solid" name="payment_method_id" id="payment_method_id" required>
                            <option value="">Chọn phương thức</option>
                            @foreach($paymentMethods ?? [] as $method)
                                <option value="{{ $method->id }}">{{ $method->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="required form-label">Tên</label>
                        <input type="text" class="form-control form-control-solid" name="name" id="payment_name" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Số Tiền Tối Thiểu</label>
                                <input type="number" class="form-control form-control-solid" name="min" id="payment_min" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Số Tiền Tối Đa</label>
                                <input type="number" class="form-control form-control-solid" name="max" id="payment_max" step="0.01" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Tiền Tệ</label>
                                <input type="text" class="form-control form-control-solid" name="currency" id="payment_currency" placeholder="USD" maxlength="10">
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Ghi Chú</label>
                        <textarea class="form-control form-control-solid" name="note" id="payment_note" rows="3"></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Hình Ảnh URL</label>
                        <input type="url" class="form-control form-control-solid" name="image_input" id="payment_image" placeholder="https://example.com/image.png">
                    </div>

                    <div class="mb-5">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="status" id="payment_status" value="1">
                            <label class="form-check-label" for="payment_status">
                                Kích Hoạt
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 flex-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Open modal for adding new payment
    function openPaymentModal() {
        document.getElementById('modal_title').textContent = 'Thêm Phương Thức Thanh Toán';
        document.getElementById('payment_form').reset();
        document.getElementById('payment_form').action = '{{ route("admin.payments.store") }}';
        document.getElementById('payment_form').method = 'POST';
        
        // Remove PUT method if exists
        const methodInput = document.getElementById('payment_form').querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();
        
        const modal = new bootstrap.Modal(document.getElementById('kt_modal_payment'));
        modal.show();
    }

    // Open modal for editing payment
    function editPaymentModal(paymentId) {
        fetch(`/admin/payments/${paymentId}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const payment = data.payment;
                document.getElementById('modal_title').textContent = 'Sửa Phương Thức Thanh Toán';
                document.getElementById('payment_method_id').value = payment.payment_method_id;
                document.getElementById('payment_name').value = payment.name;
                document.getElementById('payment_min').value = payment.min;
                document.getElementById('payment_max').value = payment.max;
                document.getElementById('payment_currency').value = payment.currency || 'USD';
                document.getElementById('payment_note').value = payment.note || '';
                document.getElementById('payment_image').value = payment.image || '';
                document.getElementById('payment_status').checked = payment.status;

                const form = document.getElementById('payment_form');
                form.action = `/admin/payments/${paymentId}`;
                
                // Add PUT method
                let methodInput = form.querySelector('input[name="_method"]');
                if (!methodInput) {
                    methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    form.appendChild(methodInput);
                }
                methodInput.value = 'PUT';

                const modal = new bootstrap.Modal(document.getElementById('kt_modal_payment'));
                modal.show();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Handle form submission
    document.getElementById('payment_form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const action = this.action;
        const method = this.querySelector('input[name="_method"]')?.value || 'POST';

        fetch(action, {
            method: method === 'PUT' ? 'POST' : 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (typeof showToast === 'function') {
                    showToast(data.message || 'Lưu thành công!', 'success');
                }
                setTimeout(() => location.reload(), 1000);
            } else {
                if (typeof showToast === 'function') {
                    showToast(data.message || 'Có lỗi xảy ra!', 'error');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (typeof showToast === 'function') {
                showToast('Có lỗi xảy ra!', 'error');
            }
        });
    });

    function deletePayment(paymentId) {
        if (confirm('Bạn có chắc chắn muốn xóa?')) {
            fetch(`/admin/payments/${paymentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (typeof showToast === 'function') {
                        showToast('Xóa thành công!', 'success');
                    }
                    setTimeout(() => location.reload(), 1000);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }
</script>

@endsection