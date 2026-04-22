@push('styles')
<style>
    /* Service Show Modal Styles */
    #showServiceModal .modal-dialog {
        max-width: 900px;
    }
    
    #showServiceModal .border {
        border-color: rgba(0,0,0,0.1) !important;
    }
    
    #showServiceModal .avatar-sm {
        width: 2.5rem;
        height: 2.5rem;
    }
    
    #showServiceModal .avatar-title {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }
    
    #showServiceModal .badge {
        font-size: 0.75rem;
    }
    
    #showServiceModal .bg-opacity-10 {
        background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
    }
    
    #showServiceModal .bg-success.bg-opacity-10 {
        background-color: rgba(var(--bs-success-rgb), 0.1) !important;
    }
    
    #showServiceModal .bg-info.bg-opacity-10 {
        background-color: rgba(var(--bs-info-rgb), 0.1) !important;
    }
    
    /* Image avatars */
    #showServiceModal .avatar-sm img {
        width: 2.5rem !important;
        height: 2.5rem !important;
        object-fit: cover;
        border-radius: 0.375rem;
    }
    
    #showServiceModal .avatar-sm {
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    #showServiceModal .text-truncate {
        max-width: 200px;
    }
    
    @media (max-width: 768px) {
        #showServiceModal .modal-dialog {
            margin: 0.5rem;
        }
        
        #showServiceModal .col-6 {
            margin-bottom: 0.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<!-- Modal xem thông tin service -->
<div class="modal fade" id="showServiceModal" tabindex="-1" aria-labelledby="showServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="showServiceModalLabel">
                    <i class="bx bx-package me-2"></i>Thông tin dịch vụ
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Loading state -->
                <div id="serviceLoadingState" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Đang tải...</span>
                    </div>
                    <p class="text-muted mt-2 mb-0">Đang tải thông tin dịch vụ...</p>
                </div>

                <!-- Service info content -->
                <div id="serviceInfoContent" style="display: none;">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <div class="avatar-lg mx-auto mb-3" style="width:64px;height:64px;">
                            <div class="avatar-title bg-primary bg-gradient text-white rounded-circle" style="width:64px;height:64px;font-size:24px;">
                                <i class="bx bx-package"></i>
                            </div>
                        </div>
                        <h5 class="mb-1" id="show-service-name"></h5>
                        <p class="text-muted mb-2" id="show-service-title"></p>
                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <span id="show-service-status" class="badge"></span>
                            <span id="show-service-type-badge" class="badge"></span>
                        </div>
                    </div>

                    <!-- Info Grid -->
                    <div class="row g-3 mb-3">
                        <div class="col-6 col-lg-2">
                            <div class="border rounded p-2 text-center h-100">
                                <small class="text-muted d-block">ID</small>
                                <span class="fw-bold text-primary" id="show-service-id">#0</span>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2">
                            <div class="border rounded p-2 text-center h-100">
                                <small class="text-muted d-block">Loại</small>
                                <span class="fw-medium" id="show-service-type">-</span>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2">
                            <div class="border rounded p-2 text-center h-100">
                                <small class="text-muted d-block">Min/Max</small>
                                <span class="fw-medium" id="show-service-min-max">-</span>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2">
                            <div class="border rounded p-2 text-center h-100">
                                <small class="text-muted d-block">Thời gian</small>
                                <span class="fw-medium" id="show-service-time">-</span>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2">
                            <div class="border rounded p-2 text-center h-100">
                                <small class="text-muted d-block">Vị trí</small>
                                <span class="fw-medium" id="show-service-position">0</span>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2">
                            <div class="border rounded p-2 text-center h-100">
                                <small class="text-muted d-block">Kiểu</small>
                                <span class="fw-medium" id="show-service-type-service">-</span>
                            </div>
                        </div>
                    </div>

                    <!-- Platform & Category & Provider -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <div class="border rounded p-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-sm bg-primary bg-opacity-10 rounded" id="show-platform-avatar">
                                            <span class="avatar-title text-primary"><i class="bx bx-globe"></i></span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <small class="text-muted d-block">Nền tảng</small>
                                        <span class="fw-medium" id="show-service-platform">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-sm bg-success bg-opacity-10 rounded" id="show-category-avatar">
                                            <span class="avatar-title text-success"><i class="bx bx-category"></i></span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <small class="text-muted d-block">Danh mục</small>
                                        <span class="fw-medium" id="show-service-category">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="show-provider-section" style="display: none;">
                            <div class="border rounded p-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-sm bg-info bg-opacity-10 rounded">
                                            <span class="avatar-title text-info"><i class="bx bx-server"></i></span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <small class="text-muted d-block">Provider</small>
                                        <span class="fw-medium" id="show-service-provider">-</span>
                                        <small class="text-muted d-block" id="show-service-api-id">-</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Names -->
                    <div class="border rounded p-3 mb-3">
                        <h6 class="mb-3"><i class="bx bx-text me-1"></i>Tên dịch vụ</h6>
                        <div class="row">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <img src="https://flagcdn.com/w20/us.png" alt="EN" class="me-2" style="width:20px;">
                                    <span id="show-service-name-en">-</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <img src="https://flagcdn.com/w20/vn.png" alt="VI" class="me-2" style="width:20px;">
                                    <span id="show-service-name-vi">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rates -->
                    <div class="border rounded p-3 mb-3">
                        <h6 class="mb-3"><i class="bx bx-dollar-circle me-1"></i>Bảng giá</h6>
                        <div class="row g-2">
                            <div class="col-6 col-lg-3">
                                <div class="rounded p-2 text-center">
                                    <small class="text-muted d-block">Giá gốc</small>
                                    <span class="fw-bold" id="show-rate-original">-</span>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3">
                                <div class="bg-opacity-10 rounded p-2 text-center">
                                    <small class="text-muted d-block">Khách lẻ</small>
                                    <span class="fw-bold text-primary" id="show-rate-retail">-</span>
                                    <small class="text-muted d-block" id="show-rate-retail-up">-</small>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3">
                                <div class="bg-opacity-10 rounded p-2 text-center">
                                    <small class="text-muted d-block">Đại lý</small>
                                    <span class="fw-bold text-success" id="show-rate-agent">-</span>
                                    <small class="text-muted d-block" id="show-rate-agent-up">-</small>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3">
                                <div class="bg-opacity-10 rounded p-2 text-center">
                                    <small class="text-muted d-block">NPP</small>
                                    <span class="fw-bold text-info" id="show-rate-distributor">-</span>
                                    <small class="text-muted d-block" id="show-rate-distributor-up">-</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Features, Attributes & Sync Options -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <h6 class="mb-2"><i class="bx bx-check-circle me-1"></i>Tính năng</h6>
                                <div id="show-service-features">-</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <h6 class="mb-2"><i class="bx bx-tag me-1"></i>Thuộc tính</h6>
                                <div id="show-service-attributes">-</div>
                            </div>
                        </div>
                        <div class="col-md-4" id="show-sync-section" style="display: none;">
                            <div class="border rounded p-3 h-100">
                                <h6 class="mb-2"><i class="bx bx-sync me-1"></i>Đồng bộ</h6>
                                <div id="show-service-sync-options">-</div>
                            </div>
                        </div>
                    </div>

                    <!-- Description & Image -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <div class="border rounded p-3 h-100">
                                <h6 class="mb-2"><i class="bx bx-detail me-1"></i>Mô tả</h6>
                                <div class="text-muted" id="show-service-description">Chưa có mô tả</div>
                            </div>
                        </div>
                        <div class="col-md-4" id="show-image-section" style="display: none;">
                            <div class="border rounded p-3 h-100 text-center">
                                <h6 class="mb-2"><i class="bx bx-image me-1"></i>Hình ảnh</h6>
                                <img id="show-service-image" src="" alt="Service Image" class="img-fluid rounded" style="max-height: 100px;">
                            </div>
                        </div>
                    </div>

                    <!-- Timestamps -->
                    <div class="row g-2">
                        <div class="col-6">
                            <small class="text-muted"><i class="bx bx-calendar me-1"></i>Tạo: <span id="show-service-created">-</span></small>
                        </div>
                        <div class="col-6 text-end">
                            <small class="text-muted"><i class="bx bx-edit me-1"></i>Cập nhật: <span id="show-service-updated">-</span></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i>Đóng
                </button>
                <button type="button" class="btn btn-primary" onclick="editServiceFromView()">
                    <i class="bx bx-edit me-1"></i>Chỉnh sửa
                </button>
            </div>
        </div>
    </div>
</div>

<script>
window.currentServiceId = null;

const getShowEl = id => document.getElementById(id);
const toggleShow = (loading, content, show) => {
    const loadEl = getShowEl(loading);
    const contEl = getShowEl(content);
    if (loadEl) loadEl.style.display = show ? 'block' : 'none';
    if (contEl) contEl.style.display = show ? 'none' : 'block';
};

window.showServiceModal = function(serviceId) {
    window.currentServiceId = serviceId;
    new bootstrap.Modal(getShowEl('showServiceModal')).show();
    toggleShow('serviceLoadingState', 'serviceInfoContent', true);
    
    fetch(`/admin/services/${serviceId}`, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(r => r.json())
    .then(d => {
        if (d.success && d.service) {
            const s = d.service;
            
            // Text fields
            getShowEl('show-service-name').textContent = s.name?.vi || s.name?.en || 'Chưa có';
            getShowEl('show-service-title').textContent = s.title || '';
            getShowEl('show-service-id').textContent = '#' + s.id;
            getShowEl('show-service-type').textContent = s.type === 'api' ? 'API' : 'Bình thường';
            // Platform with image
            getShowEl('show-service-platform').textContent = s.category?.platform?.name || 'N/A';
            const platformAvatar = getShowEl('show-platform-avatar');
            if (s.category?.platform?.image) {
                platformAvatar.innerHTML = `<img src="${s.category.platform.image}" alt="${s.category.platform.name}" class="avatar-sm rounded" style="width: 2.5rem; height: 2.5rem; object-fit: cover;">`;
            } else {
                platformAvatar.innerHTML = '<span class="avatar-title text-primary"><i class="bx bx-globe"></i></span>';
            }

            // Category with image
            getShowEl('show-service-category').textContent = s.category?.name?.vi || s.category?.name?.en || 'N/A';
            const categoryAvatar = getShowEl('show-category-avatar');
            if (s.category?.image) {
                categoryAvatar.innerHTML = `<img src="${s.category.image}" alt="${s.category.name?.vi || s.category.name?.en}" class="avatar-sm rounded" style="width: 2.5rem; height: 2.5rem; object-fit: cover;">`;
            } else {
                categoryAvatar.innerHTML = '<span class="avatar-title text-success"><i class="bx bx-category"></i></span>';
            }
            getShowEl('show-service-name-en').textContent = s.name?.en || 'Chưa có';
            getShowEl('show-service-name-vi').textContent = s.name?.vi || 'Chưa có';
            getShowEl('show-service-min-max').textContent = (s.min || 1) + ' - ' + (s.max || 'N/A');
            getShowEl('show-service-time').textContent = s.average_time || 'N/A';
            getShowEl('show-service-position').textContent = s.position || 0;
            getShowEl('show-service-type-service').textContent = s.type_service || 'Default';
            // Description (support HTML)
            const descEl = getShowEl('show-service-description');
            if (s.description) {
                descEl.innerHTML = s.description;
            } else {
                descEl.textContent = 'Chưa có mô tả';
            }

            // Provider info (for API services)
            const providerSection = getShowEl('show-provider-section');
            if (s.type === 'api' && (s.provider_name || s.provider_id)) {
                getShowEl('show-service-provider').textContent = s.provider_name || 'Provider #' + s.provider_id;
                getShowEl('show-service-api-id').textContent = s.service_api ? 'API ID: ' + s.service_api : '';
                providerSection.style.display = 'block';
            } else {
                providerSection.style.display = 'none';
            }

            // Sync options (for API services)
            const syncSection = getShowEl('show-sync-section');
            if (s.type === 'api') {
                let syncOptions = [];
                if (s.sync_rate) syncOptions.push('<span class="badge badge-soft-success me-1 mb-1">Rate</span>');
                if (s.sync_min_max) syncOptions.push('<span class="badge badge-soft-info me-1 mb-1">Min/Max</span>');
                if (s.sync_action) syncOptions.push('<span class="badge badge-soft-warning me-1 mb-1">Actions</span>');
                getShowEl('show-service-sync-options').innerHTML = syncOptions.length ? syncOptions.join('') : '<span class="text-muted">Không có</span>';
                syncSection.style.display = 'block';
            } else {
                syncSection.style.display = 'none';
            }

            // Image
            const imageSection = getShowEl('show-image-section');
            const imageEl = getShowEl('show-service-image');
            if (s.image) {
                imageEl.src = s.image;
                imageEl.onerror = () => imageSection.style.display = 'none';
                imageSection.style.display = 'block';
            } else {
                imageSection.style.display = 'none';
            }
            getShowEl('show-service-created').textContent = new Date(s.created_at).toLocaleString('vi-VN');
            getShowEl('show-service-updated').textContent = new Date(s.updated_at).toLocaleString('vi-VN');

            // Rates
            getShowEl('show-rate-original').textContent = s.rate_original ? '$' + parseFloat(s.rate_original).toFixed(4) : '-';
            getShowEl('show-rate-retail').textContent = s.rate_retail ? '$' + parseFloat(s.rate_retail).toFixed(4) : '-';
            getShowEl('show-rate-agent').textContent = s.rate_agent ? '$' + parseFloat(s.rate_agent).toFixed(4) : '-';
            getShowEl('show-rate-distributor').textContent = s.rate_distributor ? '$' + parseFloat(s.rate_distributor).toFixed(4) : '-';
            
            // Rate UP percentages
            getShowEl('show-rate-retail-up').textContent = s.rate_retail_up ? s.rate_retail_up + '%' : '';
            getShowEl('show-rate-agent-up').textContent = s.rate_agent_up ? s.rate_agent_up + '%' : '';
            getShowEl('show-rate-distributor-up').textContent = s.rate_distributor_up ? s.rate_distributor_up + '%' : '';
            
            // Status badge
            const statusEl = getShowEl('show-service-status');
            statusEl.className = s.status ? 'badge badge-soft-success' : 'badge badge-soft-danger';
            statusEl.innerHTML = s.status ? '<i class="bx bx-check-circle me-1"></i>Hoạt động' : '<i class="bx bx-x-circle me-1"></i>Không hoạt động';

            // Type badge
            const typeEl = getShowEl('show-service-type-badge');
            typeEl.className = s.type === 'api' ? 'badge badge-soft-info' : 'badge badge-soft-secondary';
            typeEl.textContent = s.type === 'api' ? 'API' : 'Normal';

            // Features
            let features = [];
            if (s.refill) features.push('<span class="badge badge-soft-success me-1 mb-1">Refill</span>');
            if (s.cancel) features.push('<span class="badge badge-soft-warning me-1 mb-1">Cancel</span>');
            if (s.dripfeed) features.push('<span class="badge badge-soft-info me-1 mb-1">Dripfeed</span>');
            getShowEl('show-service-features').innerHTML = features.length ? features.join('') : '<span class="text-muted">Không có</span>';

            // Attributes
            const attrMap = {
                'direct': 'Direct', 'new': 'New', 'best_seller': 'Best Seller', 'promotion': 'Promotion',
                'recommend': 'Recommend', 'instant': 'Instant', 'super_fast': 'Super Fast', 'real': 'Real',
                'lifetime': 'Lifetime', 'refill_30_days': '30 days Refill', 'no_refill': 'No refill',
                'auto_refill': 'Auto Refill', 'no_refund': 'No refund'
            };
            let attrs = [];
            if (s.attributes && Array.isArray(s.attributes)) {
                s.attributes.forEach(a => {
                    if (attrMap[a]) attrs.push('<span class="badge badge-soft-primary me-1 mb-1">' + attrMap[a] + '</span>');
                });
            }
            getShowEl('show-service-attributes').innerHTML = attrs.length ? attrs.join('') : '<span class="text-muted">Không có</span>';
            
            toggleShow('serviceLoadingState', 'serviceInfoContent', false);
        } else {
            alertify.error(d.message || 'Không thể tải thông tin');
        }
    })
    .catch(e => {
        console.error('Error:', e);
        alertify.error('Có lỗi xảy ra');
    });
};

window.editServiceFromView = function() {
    const modal = bootstrap.Modal.getInstance(getShowEl('showServiceModal'));
    if (modal) modal.hide();
    setTimeout(() => window.editServiceModal(window.currentServiceId), 300);
};
</script>

@endpush
