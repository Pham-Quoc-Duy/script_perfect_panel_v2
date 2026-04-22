<!-- Modal xem thông tin payment -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Thông tin tài khoản thanh toán</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center mb-3">
                            <img id="modalImage" src="" alt="Payment Image" 
                                 class="img-fluid rounded" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-medium" style="width: 40%;">ID:</td>
                                <td id="modalId"></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">
                                    <i class="bx bx-credit-card me-1"></i>Phương thức thanh toán:
                                </td>
                                <td>
                                    <div id="modalPaymentMethod" class="d-flex align-items-center">
                                        <span class="badge badge-soft-primary me-2"></span>
                                        <small class="text-muted">Phương thức thanh toán</small>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Ngân hàng:</td>
                                <td id="modalBankName"></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Số tài khoản:</td>
                                <td id="modalAccountNumber"></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Số tiền tối thiểu:</td>
                                <td id="modalMinAmount"></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Số tiền tối đa:</td>
                                <td id="modalMaxAmount"></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Ghi chú:</td>
                                <td id="modalNote"></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Trạng thái:</td>
                                <td><span id="modalStatus" class="badge"></span></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Vị trí:</td>
                                <td id="modalPosition"></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Ngày tạo:</td>
                                <td id="modalCreatedAt"></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Cập nhật:</td>
                                <td id="modalUpdatedAt"></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">
                                    <i class="bx bx-link-external me-1"></i>Webhook URL:
                                </td>
                                <td>
                                    <div id="modalWebhookUrl">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm" 
                                                   id="modalWebhookInput" readonly>
                                            <button class="btn btn-outline-secondary btn-sm" 
                                                    type="button" 
                                                    onclick="copyWebhookUrl('modalWebhookInput')"
                                                    title="Copy URL">
                                                <i class="bx bx-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-medium">
                                    <i class="bx bx-key me-1"></i>Signature:
                                </td>
                                <td>
                                    <div id="modalSignature">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm" 
                                                   id="modalSignatureInput" readonly>
                                            <button class="btn btn-outline-secondary btn-sm" 
                                                    type="button" 
                                                    onclick="copyWebhookUrl('modalSignatureInput')"
                                                    title="Copy Signature">
                                                <i class="bx bx-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="editPaymentFromModal()">
                    <i class="bx bx-edit me-1"></i>Chỉnh sửa
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showPaymentModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
    modal.show();
    
    fetch(`/admin/payments/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalId').textContent = data.id;
            document.getElementById('modalPaymentMethod').textContent = data.payment_method?.name || 'N/A';
            document.getElementById('modalBankName').textContent = data.bank_name;
            document.getElementById('modalAccountNumber').textContent = data.account_number;
            document.getElementById('modalMinAmount').textContent = data.formatted_min_amount;
            document.getElementById('modalMaxAmount').textContent = data.formatted_max_amount;
            document.getElementById('modalNote').textContent = data.note || 'Không có';
            document.getElementById('modalPosition').textContent = data.position || 0;
            
            const statusBadge = document.getElementById('modalStatus');
            if (data.status) {
                statusBadge.className = 'badge badge-soft-success';
                statusBadge.innerHTML = '<i class="bx bx-check-circle me-1"></i>Hoạt động';
            } else {
                statusBadge.className = 'badge badge-soft-danger';
                statusBadge.innerHTML = '<i class="bx bx-x-circle me-1"></i>Tạm dừng';
            }
            
            const modalImage = document.getElementById('modalImage');
            if (data.image_url) {
                modalImage.src = data.image_url;
                modalImage.style.display = 'block';
            } else {
                modalImage.style.display = 'none';
            }
            
            document.getElementById('modalCreatedAt').textContent = new Date(data.created_at).toLocaleString('vi-VN');
            document.getElementById('modalUpdatedAt').textContent = new Date(data.updated_at).toLocaleString('vi-VN');
            
            // Populate webhook information
            const webhookInput = document.getElementById('modalWebhookInput');
            const signatureInput = document.getElementById('modalSignatureInput');
            
            if (data.webhook_url) {
                webhookInput.value = data.webhook_url;
            } else {
                webhookInput.value = 'Chưa có webhook URL';
            }
            
            if (data.signature) {
                signatureInput.value = data.signature;
            } else {
                signatureInput.value = 'Chưa có signature';
            }
            
            window.currentPaymentId = data.id;
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'Có lỗi xảy ra khi tải thông tin');
        });
}

function editPaymentFromModal() {
    if (window.currentPaymentId) {
        window.location.href = `/admin/payments/${window.currentPaymentId}/edit`;
    }
}
</script>