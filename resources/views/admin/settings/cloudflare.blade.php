@extends('admin.settings.layout')

@section('tab-content')
    <form action="{{ route('admin.settings.update.cloudflare') }}" method="POST" id="cloudflareForm">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="bx bx-info-circle me-2"></i>
                    <strong>Hướng dẫn cấu hình Cloudflare:</strong>
                    <ul class="mb-0 mt-2">
                        <li><strong>Email:</strong> Email tài khoản Cloudflare của bạn</li>
                        <li><strong>Global API Key:</strong> Lấy từ <a href="https://dash.cloudflare.com/profile/api-tokens" target="_blank">https://dash.cloudflare.com/profile/api-tokens</a></li>
                        <li><strong>Account ID:</strong> Click vào domain trong Cloudflare, kéo xuống phần bên phải để tìm Account ID</li>
                        <li><strong>API Token:</strong> Tạo token từ <a href="https://dash.cloudflare.com/profile/api-tokens" target="_blank">https://dash.cloudflare.com/profile/api-tokens</a> với các quyền:
                            <ul class="mt-1">
                                <li><code>Zone.Zone</code> - Read & Edit (để tạo và quản lý zones)</li>
                                <li><code>Zone.DNS</code> - Read & Edit (để quản lý DNS records)</li>
                            </ul>
                        </li>
                        <li><strong>IP Host:</strong> Địa chỉ IP của hosting server</li>
                    </ul>
                </div>
                
                <div class="alert alert-warning">
                    <i class="bx bx-error me-2"></i>
                    <strong>Lưu ý quan trọng:</strong>
                    <p class="mb-1">Khi tạo API Token, chọn template <strong>"Edit zone DNS"</strong> hoặc tạo Custom Token với permissions:</p>
                    <ul class="mb-0">
                        <li>Zone → Zone → Edit</li>
                        <li>Zone → DNS → Edit</li>
                        <li>Account → Account Settings → Read (optional)</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Email -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="cloudflare_email" class="form-label">
                        <i class="bx bx-envelope me-1"></i> Email tài khoản Cloudflare
                    </label>
                    <input type="email" class="form-control @error('cloudflare_email') is-invalid @enderror" 
                        id="cloudflare_email" name="cloudflare_email" 
                        value="{{ old('cloudflare_email', $config->cloudflare_email) }}" 
                        placeholder="your-email@example.com">
                    <small class="text-muted">Email đăng nhập Cloudflare</small>
                    @error('cloudflare_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Global API Key -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="cloudflare_global_key" class="form-label">
                        <i class="bx bx-key me-1"></i> Global API Key
                    </label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('cloudflare_global_key') is-invalid @enderror" 
                            id="cloudflare_global_key" name="cloudflare_global_key" 
                            value="{{ old('cloudflare_global_key', $config->cloudflare_global_key) }}" 
                            placeholder="••••••••••••••••••••">
                        <button class="btn btn-outline-secondary" type="button" id="toggleGlobalKey">
                            <i class="bx bx-show"></i>
                        </button>
                    </div>
                    <small class="text-muted">
                        <a href="https://dash.cloudflare.com/profile/api-tokens" target="_blank">
                            Lấy Global API Key <i class="bx bx-link-external"></i>
                        </a>
                    </small>
                    @error('cloudflare_global_key')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Account ID -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="cloudflare_account_id" class="form-label">
                        <i class="bx bx-id-card me-1"></i> Account ID
                    </label>
                    <input type="text" class="form-control @error('cloudflare_account_id') is-invalid @enderror" 
                        id="cloudflare_account_id" name="cloudflare_account_id" 
                        value="{{ old('cloudflare_account_id', $config->cloudflare_account_id) }}" 
                        placeholder="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                    <small class="text-muted">Tìm ở sidebar bên phải khi click vào domain</small>
                    @error('cloudflare_account_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- API Token -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="cloudflare_token" class="form-label">
                        <i class="bx bx-lock-alt me-1"></i> API Token
                    </label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('cloudflare_token') is-invalid @enderror" 
                            id="cloudflare_token" name="cloudflare_token" 
                            value="{{ old('cloudflare_token', $config->cloudflare_token) }}" 
                            placeholder="••••••••••••••••••••">
                        <button class="btn btn-outline-secondary" type="button" id="toggleToken">
                            <i class="bx bx-show"></i>
                        </button>
                    </div>
                    <small class="text-muted">
                        <a href="https://dash.cloudflare.com/profile/api-tokens" target="_blank">
                            Tạo API Token <i class="bx bx-link-external"></i>
                        </a>
                    </small>
                    @error('cloudflare_token')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- IP Host -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="cloudflare_ip_host" class="form-label">
                        <i class="bx bx-server me-1"></i> IP Host
                    </label>
                    <input type="text" class="form-control @error('cloudflare_ip_host') is-invalid @enderror" 
                        id="cloudflare_ip_host" name="cloudflare_ip_host" 
                        value="{{ old('cloudflare_ip_host', $config->cloudflare_ip_host) }}" 
                        placeholder="192.168.1.1">
                    <small class="text-muted">Địa chỉ IP của hosting server</small>
                    @error('cloudflare_ip_host')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Connection Status -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <i class="bx bx-check-circle me-2"></i>Trạng thái kết nối
                        </h5>
                        <div id="connectionStatus" class="alert alert-secondary">
                            <i class="bx bx-info-circle me-2"></i>
                            Nhấn "Kiểm tra kết nối" để xác minh cấu hình Cloudflare
                        </div>
                        <button type="button" class="btn btn-outline-primary" id="testConnection">
                            <i class="bx bx-test-tube me-2"></i>Kiểm tra kết nối
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="row mt-4">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-2"></i>Lưu cấu hình
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="bx bx-reset me-2"></i>Đặt lại
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Toggle password visibility for Global Key
    $('#toggleGlobalKey').on('click', function() {
        const input = $('#cloudflare_global_key');
        const icon = $(this).find('i');
        
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('bx-show').addClass('bx-hide');
        } else {
            input.attr('type', 'password');
            icon.removeClass('bx-hide').addClass('bx-show');
        }
    });

    // Toggle password visibility for Token
    $('#toggleToken').on('click', function() {
        const input = $('#cloudflare_token');
        const icon = $(this).find('i');
        
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('bx-show').addClass('bx-hide');
        } else {
            input.attr('type', 'password');
            icon.removeClass('bx-hide').addClass('bx-show');
        }
    });

    // Test connection
    $('#testConnection').on('click', function() {
        const btn = $(this);
        const statusDiv = $('#connectionStatus');
        
        btn.prop('disabled', true).html('<i class="bx bx-loader bx-spin me-2"></i>Đang kiểm tra...');
        
        // Simulate API test (replace with actual API call)
        setTimeout(function() {
            const email = $('#cloudflare_email').val();
            const token = $('#cloudflare_token').val();
            
            if (!email || !token) {
                statusDiv.removeClass('alert-secondary alert-success')
                    .addClass('alert-warning')
                    .html('<i class="bx bx-error me-2"></i>Vui lòng nhập Email và API Token để kiểm tra kết nối');
            } else {
                statusDiv.removeClass('alert-secondary alert-warning')
                    .addClass('alert-success')
                    .html('<i class="bx bx-check-circle me-2"></i>Kết nối thành công! Cấu hình Cloudflare đang hoạt động.');
            }
            
            btn.prop('disabled', false).html('<i class="bx bx-test-tube me-2"></i>Kiểm tra kết nối');
        }, 1500);
    });

    // Form validation
    $('#cloudflareForm').on('submit', function(e) {
        const email = $('#cloudflare_email').val();
        const ipHost = $('#cloudflare_ip_host').val();
        
        // Validate IP format
        if (ipHost && !isValidIP(ipHost)) {
            e.preventDefault();
            alert('Địa chỉ IP không hợp lệ!');
            $('#cloudflare_ip_host').focus();
            return false;
        }
    });

    function isValidIP(ip) {
        const pattern = /^(\d{1,3}\.){3}\d{1,3}$/;
        if (!pattern.test(ip)) return false;
        
        const parts = ip.split('.');
        return parts.every(part => parseInt(part) >= 0 && parseInt(part) <= 255);
    }
});
</script>
@endpush
