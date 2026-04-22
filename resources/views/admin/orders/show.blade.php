<!-- Order Details Modal -->
<div class="modal fade" id="showOrderModal" tabindex="-1" aria-labelledby="showOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white border-0 position-relative overflow-hidden rounded-top-4">
                <div class="position-absolute top-0 end-0 opacity-25">
                    <i class="bx bx-receipt" style="font-size: 8rem;"></i>
                </div>
                <div class="position-relative">
                    <h4 class="modal-title fw-bold mb-1" id="showOrderModalLabel">
                        <i class="bx bx-receipt me-2"></i>Chi tiết đơn hàng
                    </h4>
                    <p class="mb-0 opacity-75">Thông tin chi tiết và trạng thái đơn hàng</p>
                </div>
                <button type="button" class="btn-close btn-close-white position-relative" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-0 bg-light">
                <div id="orderModalContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
            
            <div class="modal-footer bg-white border-0 shadow-sm rounded-bottom-4">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                            <i class="bx bx-x me-1"></i>Đóng
                        </button>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-primary rounded-pill" onclick="printOrderDetails()">
                            <i class="bx bx-printer me-1"></i>In đơn hàng
                        </button>
                        <button type="button" class="btn btn-outline-success rounded-pill" onclick="exportOrderDetails()">
                            <i class="bx bx-download me-1"></i>Xuất Excel
                        </button>
                        <button type="button" class="btn btn-primary rounded-pill" onclick="editOrderFromModal()">
                            <i class="bx bx-edit me-1"></i>Chỉnh sửa
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-warning text-dark border-0 position-relative overflow-hidden rounded-top-4">
                <div class="position-absolute top-0 end-0 opacity-25">
                    <i class="bx bx-edit" style="font-size: 6rem;"></i>
                </div>
                <div class="position-relative">
                    <h4 class="modal-title fw-bold mb-1" id="editOrderModalLabel">
                        <i class="bx bx-edit me-2"></i>Chỉnh sửa đơn hàng
                    </h4>
                    <p class="mb-0 opacity-75">Cập nhật thông tin và trạng thái đơn hàng</p>
                </div>
                <button type="button" class="btn-close position-relative" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="editOrderForm">
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="status" class="form-select rounded-3" id="orderStatus" required>
                                    <option value="pending">Chờ xử lý</option>
                                    <option value="processing">Đang xử lý</option>
                                    <option value="in_progress">Đang chạy</option>
                                    <option value="completed">Hoàn thành</option>
                                    <option value="partial">Hoàn tiền một phần</option>
                                    <option value="canceled">Đã hủy</option>
                                    <option value="refunded">Hoàn tiền</option>
                                </select>
                                <label for="orderStatus">
                                    <i class="bx bx-flag me-1"></i>Trạng thái đơn hàng
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="start_count" class="form-control rounded-3" id="startCount" min="0" placeholder="0">
                                <label for="startCount">
                                    <i class="bx bx-play me-1"></i>Số lượng ban đầu
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="remains" class="form-control rounded-3" id="remainsCount" min="0" placeholder="0">
                                <label for="remainsCount">
                                    <i class="bx bx-time me-1"></i>Số lượng còn lại
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="rate" class="form-control rounded-3" id="orderRate" step="0.0001" min="0" placeholder="0.0000">
                                <label for="orderRate">
                                    <i class="bx bx-money me-1"></i>Giá đơn vị
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="note" class="form-control rounded-3" id="orderNote" style="height: 120px" placeholder="Nhập ghi chú..."></textarea>
                                <label for="orderNote">
                                    <i class="bx bx-note me-1"></i>Ghi chú đơn hàng
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info border-0 mt-4 rounded-3">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-info-circle fs-4 me-3 text-info"></i>
                            <div>
                                <h6 class="alert-heading mb-1">Lưu ý quan trọng</h6>
                                <p class="mb-0 small">Việc thay đổi thông tin đơn hàng có thể ảnh hưởng đến quá trình xử lý. Vui lòng kiểm tra kỹ trước khi lưu thay đổi.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer bg-light border-0 rounded-bottom-4">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i>Hủy bỏ
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill">
                        <i class="bx bx-save me-1"></i>Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Minimal Custom CSS - Most styling uses Bootstrap classes */

/* Modal rounded corners */
.rounded-4 {
    border-radius: 1rem !important;
}

.rounded-top-4 {
    border-top-left-radius: 1rem !important;
    border-top-right-radius: 1rem !important;
}

.rounded-bottom-4 {
    border-bottom-left-radius: 1rem !important;
    border-bottom-right-radius: 1rem !important;
}

/* Order detail cards - using Bootstrap shadow and border utilities */
.order-detail-card {
    transition: all 0.3s ease;
}

.order-detail-card:hover {
    transform: translateY(-3px);
}

/* Info items - minimal custom styling */
.info-item {
    padding: 1rem 0;
    border-bottom: 1px solid var(--bs-gray-200);
    transition: all 0.2s ease;
}

.info-item:hover {
    background: rgba(var(--bs-primary-rgb), 0.03);
    margin: 0 -1rem;
    padding: 1rem;
    border-radius: 0.5rem;
    border-bottom-color: transparent;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    min-width: 140px;
}

.info-label i {
    width: 20px;
}

/* Progress bar animations */
.progress-bar {
    transition: width 1.5s ease-in-out;
    position: relative;
}

.progress-bar::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.3) 50%, transparent 100%);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* Timeline using Bootstrap utilities */
.timeline-item {
    position: relative;
    padding-left: 3rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: 1rem;
    top: 0.5rem;
    width: 12px;
    height: 12px;
    background: var(--bs-primary);
    border-radius: 50%;
    box-shadow: 0 0 0 4px rgba(var(--bs-primary-rgb), 0.2);
}

.timeline-item::after {
    content: '';
    position: absolute;
    left: 1.35rem;
    top: 1.25rem;
    width: 2px;
    height: calc(100% - 0.5rem);
    background: linear-gradient(180deg, var(--bs-primary) 0%, transparent 100%);
}

.timeline-item:last-child::after {
    display: none;
}

/* Form focus states */
.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label {
    color: var(--bs-primary);
}

/* Loading content */
.loading-content {
    min-height: 300px;
}

/* Section headers */
.section-header {
    margin: -2rem -2rem 1.5rem -2rem;
    border-radius: 0.75rem 0.75rem 0 0;
}

/* Stat cards */
.stat-card {
    transition: all 0.3s ease;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 2.2rem;
    line-height: 1.2;
}

.stat-label {
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .info-item {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 0.5rem;
    }
    
    .info-label {
        min-width: auto;
    }
    
    .info-value {
        text-align: left !important;
    }
    
    .timeline-item {
        padding-left: 2rem;
    }
    
    .timeline-item::before {
        left: 0.5rem;
    }
    
    .timeline-item::after {
        left: 0.85rem;
    }
    
    .stat-number {
        font-size: 1.8rem;
    }
}

/* Animation classes */
.fade-in {
    animation: fadeIn 0.6s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.slide-up {
    animation: slideUp 0.4s ease-out;
}

@keyframes slideUp {
    from { transform: translateY(40px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* Custom scrollbar */
.modal-body::-webkit-scrollbar {
    width: 8px;
}

.modal-body::-webkit-scrollbar-track {
    background: var(--bs-gray-200);
    border-radius: 4px;
}

.modal-body::-webkit-scrollbar-thumb {
    background: var(--bs-primary);
    border-radius: 4px;
}

.modal-body::-webkit-scrollbar-thumb:hover {
    background: var(--bs-primary-dark, #0056b3);
}
</style>