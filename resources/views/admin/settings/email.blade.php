@extends('admin.settings.layout')

@section('tab-content')
    <form action="{{ route('admin.settings.update.email') }}" method="POST" id="emailForm">
        @csrf
        @method('PUT')
        
        <h5 class="mb-3">Cài đặt SMTP</h5>
        <p class="text-muted mb-4">Cấu hình máy chủ email để gửi thông báo, xác thực và các email tự động</p>
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="smtp_host" class="form-label">SMTP Host</label>
                    <input type="text" class="form-control @error('smtp_host') is-invalid @enderror" 
                        id="smtp_host" name="smtp_host" value="{{ old('smtp_host', $config->smtp_host) }}" 
                        placeholder="smtp.gmail.com">
                    <small class="text-muted">Địa chỉ máy chủ SMTP</small>
                    @error('smtp_host')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="smtp_port" class="form-label">SMTP Port</label>
                    <select class="form-select @error('smtp_port') is-invalid @enderror" id="smtp_port" name="smtp_port">
                        <option value="">Chọn port</option>
                        <option value="25" {{ old('smtp_port', $config->smtp_port) == '25' ? 'selected' : '' }}>25 (SMTP)</option>
                        <option value="465" {{ old('smtp_port', $config->smtp_port) == '465' ? 'selected' : '' }}>465 (SMTPS)</option>
                        <option value="587" {{ old('smtp_port', $config->smtp_port) == '587' ? 'selected' : '' }}>587 (SMTP + STARTTLS)</option>
                        <option value="2525" {{ old('smtp_port', $config->smtp_port) == '2525' ? 'selected' : '' }}>2525 (Alternative)</option>
                    </select>
                    <small class="text-muted">Port kết nối SMTP</small>
                    @error('smtp_port')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="smtp_username" class="form-label">SMTP Username</label>
                    <input type="text" class="form-control @error('smtp_username') is-invalid @enderror" 
                        id="smtp_username" name="smtp_username" value="{{ old('smtp_username', $config->smtp_username) }}" 
                        placeholder="your-email@gmail.com">
                    <small class="text-muted">Tên đăng nhập SMTP (thường là email)</small>
                    @error('smtp_username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="smtp_password" class="form-label">SMTP Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('smtp_password') is-invalid @enderror" 
                            id="smtp_password" name="smtp_password" value="{{ old('smtp_password', $config->smtp_password) }}" 
                            placeholder="your-app-password">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="bx bx-show"></i>
                        </button>
                    </div>
                    <small class="text-muted">Mật khẩu SMTP (khuyến nghị dùng App Password)</small>
                    @error('smtp_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="smtp_from_name" class="form-label">From Name</label>
            <input type="text" class="form-control @error('smtp_from_name') is-invalid @enderror" 
                id="smtp_from_name" name="smtp_from_name" value="{{ old('smtp_from_name', $config->smtp_from_name) }}" 
                placeholder="Perfect Panel Vietnam">
            <small class="text-muted">Tên hiển thị khi gửi email</small>
            @error('smtp_from_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button type="button" class="btn btn-outline-primary" id="testEmailBtn">
                <i class="bx bx-envelope me-1"></i>Gửi email test
            </button>
            <small class="text-muted d-block mt-1">Gửi email test để kiểm tra cấu hình SMTP</small>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <h6 class="alert-heading">Cài đặt phổ biến:</h6>
                    
                    <div class="mb-3">
                        <strong>Gmail:</strong>
                        <ul class="small mb-2">
                            <li>Host: smtp.gmail.com</li>
                            <li>Port: 587 (STARTTLS) hoặc 465 (SSL)</li>
                            <li>Username: your-email@gmail.com</li>
                            <li>Password: App Password (không phải mật khẩu Gmail)</li>
                        </ul>
                    </div>

                    <div class="mb-3">
                        <strong>Outlook/Hotmail:</strong>
                        <ul class="small mb-2">
                            <li>Host: smtp-mail.outlook.com</li>
                            <li>Port: 587</li>
                            <li>Username: your-email@outlook.com</li>
                            <li>Password: Mật khẩu tài khoản</li>
                        </ul>
                    </div>

                    <div class="mb-0">
                        <strong>Yahoo:</strong>
                        <ul class="small mb-0">
                            <li>Host: smtp.mail.yahoo.com</li>
                            <li>Port: 587 hoặc 465</li>
                            <li>Username: your-email@yahoo.com</li>
                            <li>Password: App Password</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="alert alert-warning">
                    <h6 class="alert-heading">Lưu ý bảo mật:</h6>
                    <ul class="mb-0 small">
                        <li><strong>Gmail:</strong> Bật 2FA và tạo App Password thay vì dùng mật khẩu chính</li>
                        <li><strong>Outlook:</strong> Có thể cần bật "Less secure app access"</li>
                        <li><strong>Yahoo:</strong> Bắt buộc phải dùng App Password</li>
                        <li>Không chia sẻ thông tin SMTP với người khác</li>
                        <li>Thường xuyên thay đổi mật khẩu</li>
                        <li>Sử dụng SSL/TLS để mã hóa kết nối</li>
                    </ul>
                </div>

                <div class="alert alert-success">
                    <h6 class="alert-heading">Các email sẽ được gửi:</h6>
                    <ul class="mb-0 small">
                        <li>Email xác thực đăng ký</li>
                        <li>Email reset mật khẩu</li>
                        <li>Thông báo đơn hàng</li>
                        <li>Thông báo thanh toán</li>
                        <li>Email marketing (nếu có)</li>
                        <li>Báo cáo định kỳ</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Nút lưu -->
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="reset" class="btn btn-secondary">
                <i class="bx bx-reset me-1"></i>Đặt lại
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-save me-1"></i>Lưu cài đặt
            </button>
        </div>
    </form>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Toggle password visibility
    $('#togglePassword').on('click', function() {
        const passwordField = $('#smtp_password');
        const icon = $(this).find('i');
        
        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            icon.removeClass('bx-show').addClass('bx-hide');
        } else {
            passwordField.attr('type', 'password');
            icon.removeClass('bx-hide').addClass('bx-show');
        }
    });

    // Auto-fill common SMTP settings
    $('#smtp_host').on('change', function() {
        const host = $(this).val().toLowerCase();
        
        if (host.includes('gmail')) {
            $('#smtp_port').val('587');
        } else if (host.includes('outlook') || host.includes('hotmail')) {
            $('#smtp_port').val('587');
        } else if (host.includes('yahoo')) {
            $('#smtp_port').val('587');
        }
    });

    // Test email functionality
    $('#testEmailBtn').on('click', function() {
        const host = $('#smtp_host').val();
        const port = $('#smtp_port').val();
        const username = $('#smtp_username').val();
        const password = $('#smtp_password').val();
        
        if (!host || !port || !username || !password) {
            alert('Vui lòng điền đầy đủ thông tin SMTP trước khi test');
            return;
        }
        
        const btn = $(this);
        const originalText = btn.html();
        btn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i>Đang gửi...');
        
        // Simulate email test (replace with actual endpoint)
        setTimeout(() => {
            // This should be replaced with actual AJAX call to test endpoint
            const alertHtml = `
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <strong>✅ Email test đã được gửi!</strong> Kiểm tra hộp thư của bạn.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            
            $('#testEmailBtn').parent().append(alertHtml);
            
            btn.prop('disabled', false).html(originalText);
        }, 3000);
    });
    
    // Form submission
    $('#emailForm').on('submit', function(e) {
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i>Đang lưu...');
    });
});
</script>
@endpush