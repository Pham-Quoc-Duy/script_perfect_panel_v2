@extends('admin.layouts.app')

@section('title', 'Chi tiết Child Panel - ' . $childPanel->domain_panel)

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Chi tiết Child Panel',
                    'breadcrumb' => $childPanel->domain_panel,
                ])

                @include('admin.components.alert')

                <div class="row">
                    <!-- Main Info -->
                    <div class="col-lg-8">
                        <!-- Panel Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="bx bx-info-circle me-2"></i>Thông tin Panel
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">Domain Panel</label>
                                        <p class="h6 mb-0">{{ $childPanel->domain_panel }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">Domain Chính</label>
                                        <p class="h6 mb-0">{{ $childPanel->domain }}</p>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">Người dùng</label>
                                        <p class="h6 mb-0">
                                            <a href="{{ route('admin.users.show', $childPanel->user) }}" class="text-decoration-none">
                                                {{ $childPanel->user->name }}
                                            </a>
                                        </p>
                                        <small class="text-muted">{{ $childPanel->user->email }}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">Giá</label>
                                        <p class="h6 mb-0">${{ number_format($childPanel->price, 2) }}</p>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">Trạng thái</label>
                                        <p class="mb-0">
                                            <span class="badge bg-{{ $childPanel->status === 'pending' ? 'warning' : ($childPanel->status === 'completed' ? 'success' : 'danger') }}">
                                                {{ ucfirst($childPanel->status) }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">Cấp độ truy cập</label>
                                        <p class="h6 mb-0">{{ ucfirst($childPanel->access) }}</p>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">Lần đồng bộ cuối</label>
                                        <p class="h6 mb-0">
                                            @if($childPanel->last_sync_at)
                                                {{ $childPanel->last_sync_at->format('d/m/Y H:i') }}
                                            @else
                                                <span class="text-muted">Chưa đồng bộ</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">Ngày hết hạn</label>
                                        <p class="h6 mb-0">
                                            @if($childPanel->expires_at)
                                                <span class="badge bg-{{ $childPanel->expires_at->isFuture() ? 'info' : 'danger' }}">
                                                    {{ $childPanel->expires_at->format('d/m/Y') }}
                                                </span>
                                            @else
                                                <span class="text-muted">Không có hạn</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">Ngày tạo</label>
                                        <p class="h6 mb-0">{{ $childPanel->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small">Cập nhật lần cuối</label>
                                        <p class="h6 mb-0">{{ $childPanel->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistics -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="bx bx-bar-chart me-2"></i>Thống kê
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="text-center p-3 bg-light rounded">
                                            <h3 class="mb-1 text-primary">{{ $childPanel->total_orders }}</h3>
                                            <small class="text-muted">Tổng đơn hàng</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center p-3 bg-light rounded">
                                            <h3 class="mb-1 text-success">{{ $childPanel->total_services }}</h3>
                                            <small class="text-muted">Tổng dịch vụ</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center p-3 bg-light rounded">
                                            <h3 class="mb-1 text-info">{{ $childPanel->total_users }}</h3>
                                            <small class="text-muted">Tổng người dùng</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Actions -->
                    <div class="col-lg-4">
                        <!-- Actions Card -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="bx bx-cog me-2"></i>Thao tác
                                </h5>
                            </div>
                            <div class="card-body">
                                @if($childPanel->status === 'pending')
                                    <button type="button" class="btn btn-success w-100 mb-2" id="approve-btn">
                                        <i class="bx bx-check me-1"></i> Phê duyệt
                                    </button>
                                @endif

                                @if($childPanel->status !== 'suspended')
                                    <button type="button" class="btn btn-warning w-100 mb-2" id="suspend-btn">
                                        <i class="bx bx-pause me-1"></i> Tạm dừng
                                    </button>
                                @else
                                    <button type="button" class="btn btn-info w-100 mb-2" id="activate-btn">
                                        <i class="bx bx-play me-1"></i> Kích hoạt
                                    </button>
                                @endif

                                <button type="button" class="btn btn-danger w-100" id="delete-btn">
                                    <i class="bx bx-trash me-1"></i> Xóa
                                </button>
                            </div>
                        </div>

                        <!-- Settings Card -->
                        @if(!empty($settings))
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="bx bx-sliders me-2"></i>Cài đặt
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless">
                                            <tbody>
                                                @foreach($settings as $key => $value)
                                                    <tr>
                                                        <td class="text-muted small">{{ str_replace('_', ' ', ucfirst($key)) }}</td>
                                                        <td class="text-end">
                                                            @if(is_array($value))
                                                                <small class="text-muted">Array</small>
                                                            @elseif(strlen($value) > 20)
                                                                <small class="text-muted">{{ substr($value, 0, 20) }}...</small>
                                                            @else
                                                                <small class="text-muted">{{ $value }}</small>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const panelId = {{ $childPanel->id }};

    function showToast(type, message) {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
        toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        toast.innerHTML = `
            <i class="bx bx-${type === 'success' ? 'check-circle' : 'x-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 4000);
    }

    document.getElementById('approve-btn')?.addEventListener('click', function() {
        if (confirm('Bạn có chắc chắn muốn phê duyệt child panel này?')) {
            fetch(`/admin/child-panels/${panelId}/approve`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('success', data.message);
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast('error', data.message);
                }
            });
        }
    });

    document.getElementById('suspend-btn')?.addEventListener('click', function() {
        if (confirm('Bạn có chắc chắn muốn tạm dừng child panel này?')) {
            fetch(`/admin/child-panels/${panelId}/suspend`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('success', data.message);
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast('error', data.message);
                }
            });
        }
    });

    document.getElementById('activate-btn')?.addEventListener('click', function() {
        if (confirm('Bạn có chắc chắn muốn kích hoạt child panel này?')) {
            fetch(`/admin/child-panels/${panelId}/approve`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('success', data.message);
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast('error', data.message);
                }
            });
        }
    });

    document.getElementById('delete-btn')?.addEventListener('click', function() {
        if (confirm('Bạn có chắc chắn muốn xóa child panel này? Hành động này không thể hoàn tác.')) {
            fetch(`/admin/child-panels/${panelId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('success', data.message);
                    setTimeout(() => window.location.href = '/admin/child-panels', 1500);
                } else {
                    showToast('error', data.message);
                }
            });
        }
    });
});
</script>
@endpush
@endsection
