<!-- Modal xem thông tin payment method -->
<div class="modal fade" id="paymentMethodModal" tabindex="-1" aria-labelledby="paymentMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentMethodModalLabel">Thông tin phương thức thanh toán</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center mb-3">
                            <img id="modalImage" src="" alt="Payment Method Image" 
                                 class="img-fluid rounded" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-medium" style="width: 30%;">ID:</td>
                                <td id="modalId"></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Tên tiếng Anh:</td>
                                <td id="modalNameEn"></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Tên tiếng Việt:</td>
                                <td id="modalNameVi"></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Số thanh toán:</td>
                                <td><span id="modalPaymentsCount" class="badge badge-soft-info"></span></td>
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
                        </table>
                    </div>
                </div>

                <!-- Payments List -->
                <div class="mt-4">
                    <h6 class="mb-3">Danh sách thanh toán</h6>
                    <div id="paymentsContainer">
                        <div class="text-center text-muted">
                            <i class="bx bx-loader bx-spin font-size-24"></i>
                            <p>Đang tải...</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="editPaymentMethodFromModal()">
                    <i class="bx bx-edit me-1"></i>Chỉnh sửa
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showPaymentMethodModal(id) {
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('paymentMethodModal'));
    modal.show();
    
    // Fetch payment method data
    fetch(`/admin/payment-methods/${id}`)
        .then(response => response.json())
        .then(data => {
            // Update modal content
            document.getElementById('modalId').textContent = data.id;
            document.getElementById('modalNameEn').textContent = data.name?.en || 'N/A';
            document.getElementById('modalNameVi').textContent = data.name?.vi || 'N/A';
            document.getElementById('modalPaymentsCount').textContent = data.payments_count || 0;
            document.getElementById('modalPosition').textContent = data.position || 0;
            
            // Status badge
            const statusBadge = document.getElementById('modalStatus');
            if (data.status) {
                statusBadge.className = 'badge badge-soft-success';
                statusBadge.innerHTML = '<i class="bx bx-check-circle me-1"></i>Hoạt động';
            } else {
                statusBadge.className = 'badge badge-soft-danger';
                statusBadge.innerHTML = '<i class="bx bx-x-circle me-1"></i>Tạm dừng';
            }
            
            // Image
            const modalImage = document.getElementById('modalImage');
            if (data.image_url) {
                modalImage.src = data.image_url;
                modalImage.style.display = 'block';
            } else {
                modalImage.style.display = 'none';
            }
            
            // Dates
            document.getElementById('modalCreatedAt').textContent = new Date(data.created_at).toLocaleString('vi-VN');
            document.getElementById('modalUpdatedAt').textContent = new Date(data.updated_at).toLocaleString('vi-VN');
            
            // Payments list
            const paymentsContainer = document.getElementById('paymentsContainer');
            if (data.payments && data.payments.length > 0) {
                let paymentsHtml = '<div class="table-responsive"><table class="table table-sm table-bordered">';
                paymentsHtml += '<thead><tr><th>ID</th><th>Ngân hàng</th><th>Số tài khoản</th><th>Trạng thái</th></tr></thead><tbody>';
                
                data.payments.forEach(payment => {
                    const statusClass = payment.status ? 'badge-soft-success' : 'badge-soft-danger';
                    const statusText = payment.status ? 'Hoạt động' : 'Tạm dừng';
                    
                    paymentsHtml += `
                        <tr>
                            <td>#${payment.id}</td>
                            <td>${payment.bank_name}</td>
                            <td>${payment.account_number}</td>
                            <td><span class="badge ${statusClass} font-size-11">${statusText}</span></td>
                        </tr>
                    `;
                });
                
                paymentsHtml += '</tbody></table></div>';
                paymentsContainer.innerHTML = paymentsHtml;
            } else {
                paymentsContainer.innerHTML = '<div class="text-center text-muted"><i class="bx bx-info-circle me-1"></i>Chưa có thanh toán nào</div>';
            }
            
            // Store ID for edit function
            window.currentPaymentMethodId = data.id;
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'Có lỗi xảy ra khi tải thông tin');
        });
}

function editPaymentMethodFromModal() {
    if (window.currentPaymentMethodId) {
        window.location.href = `/admin/payment-methods/${window.currentPaymentMethodId}/edit`;
    }
}
</script>