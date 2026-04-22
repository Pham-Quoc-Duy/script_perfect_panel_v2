@extends('admin.layouts.app')

@section('title', 'Thêm API Provider')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Thêm API Provider',
                    'breadcrumb' => 'API Provider',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Thông tin Provider</h4>
                                <p class="text-muted mb-0 mt-1">Nhập thông tin chi tiết của nhà cung cấp API</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.provider.store') }}" method="POST" id="createProviderForm">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Tên Provider <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" name="name" required placeholder="VD: SMM Panel ABC">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="type" class="form-label">Loại</label>
                                                <select class="form-select" id="type" name="type">
                                                    <option value="smm">SMM Panel</option>
                                                    <option value="other">Khác</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="link" class="form-label">API URL <span class="text-danger">*</span></label>
                                                <input type="url" class="form-control" id="link" name="link" required placeholder="https://example.com/api/v2">
                                                <small class="text-muted">Nhập đường dẫn API của nhà cung cấp</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="api_key" class="form-label">API Key <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="api_key" name="api_key" required placeholder="Nhập API Key">
                                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                        <i class="bx bx-show" id="togglePasswordIcon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="balance" class="form-label">Số dư</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" class="form-control" id="balance" name="balance" step="0.0001" min="0" value="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="currency" class="form-label">Tiền tệ</label>
                                                <select class="form-select" id="currency" name="currency">
                                                    <option value="USD">USD ($)</option>
                                                    <option value="VND">VND (₫)</option>
                                                    <option value="EUR">EUR (€)</option>
                                                    <option value="GBP">GBP (£)</option>
                                                    <option value="JPY">JPY (¥)</option>
                                                    <option value="CNY">CNY (¥)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="note" class="form-label">Ghi chú</label>
                                        <textarea class="form-control" id="note" name="note" rows="3" placeholder="Ghi chú về provider này..."></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Trạng thái</label>
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" id="provider_status" name="status" checked>
                                            <label class="form-check-label" for="provider_status">
                                                Kích hoạt provider
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <a href="{{ route('admin.provider.index') }}" class="btn btn-secondary">
                                            <i class="bx bx-x me-1"></i>Hủy
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-save me-1"></i>Tạo Provider
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Hướng dẫn</h4>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info mb-0">
                                    <h6 class="alert-heading mb-2">Lưu ý khi tạo:</h6>
                                    <ul class="mb-0 small">
                                        <li>API URL và API Key phải chính xác</li>
                                        <li>Kiểm tra kết nối trước khi kích hoạt</li>
                                        <li>Số dư sẽ được cập nhật tự động</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Các bước thực hiện</h4>
                            </div>
                            <div class="card-body">
                                <ol class="ps-3 mb-0 small">
                                    <li class="mb-2">Đăng nhập vào panel của nhà cung cấp</li>
                                    <li class="mb-2">Tìm mục API hoặc API Documentation</li>
                                    <li class="mb-2">Copy API URL và API Key</li>
                                    <li class="mb-2">Dán vào form bên trái</li>
                                    <li class="mb-2">Nhấn "Tạo Provider" để lưu</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Toggle password
    $('#togglePassword').on('click', function() {
        const input = $('#api_key');
        const icon = $('#togglePasswordIcon');
        const isPassword = input.attr('type') === 'password';
        input.attr('type', isPassword ? 'text' : 'password');
        icon.toggleClass('bx-show bx-hide');
    });

    // Form validation and submission
    $('#createProviderForm').on('submit', function(e) {
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        
        // Show loading state
        submitBtn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i>Đang tạo...');
    });

    // Remove validation errors on input
    $('.form-control, .form-select').on('input change', function() {
        $(this).removeClass('is-invalid');
    });
});
</script>
@endpush
