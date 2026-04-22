<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cài đặt hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .install-container {
            width: 100%;
            max-width: 400px;
        }

        .install-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .install-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .install-header .icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .install-header .icon i {
            font-size: 1.8rem;
        }

        .install-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .install-header p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin: 0;
        }

        .install-body {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #f9fafb;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .btn-install {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 0.875rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: white;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-install:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-install:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .alert {
            border-radius: 8px;
            border: none;
            padding: 0.75rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #dc2626;
            border-left: 3px solid #dc2626;
        }

        .alert-info {
            background-color: #eff6ff;
            color: #0284c7;
            border-left: 3px solid #0284c7;
        }

        .password-strength {
            margin-top: 0.25rem;
            font-size: 0.75rem;
        }

        .strength-weak { color: #dc2626; }
        .strength-medium { color: #d97706; }
        .strength-strong { color: #059669; }

        .footer-note {
            text-align: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 0.8rem;
        }

        /* Responsive */
        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
            }
            
            .install-container {
                max-width: 100%;
            }
            
            .install-header {
                padding: 1.5rem 1rem;
            }
            
            .install-header h1 {
                font-size: 1.25rem;
            }
            
            .install-header .icon {
                width: 50px;
                height: 50px;
            }
            
            .install-header .icon i {
                font-size: 1.5rem;
            }
            
            .install-body {
                padding: 1rem;
            }
            
            .form-group {
                margin-bottom: 0.875rem;
            }
            
            .form-control {
                padding: 0.625rem;
                font-size: 0.875rem;
            }
            
            .btn-install {
                padding: 0.75rem;
                font-size: 0.875rem;
            }
        }

        @media (max-width: 360px) {
            body {
                padding: 0.25rem;
            }
            
            .install-card {
                border-radius: 12px;
            }
            
            .install-header {
                padding: 1rem 0.75rem;
            }
            
            .install-header h1 {
                font-size: 1.125rem;
            }
            
            .install-body {
                padding: 0.75rem;
            }
            
            .form-group {
                margin-bottom: 0.75rem;
            }
            
            .form-control {
                padding: 0.5rem;
                font-size: 0.8rem;
            }
            
            .form-label {
                font-size: 0.8rem;
                margin-bottom: 0.25rem;
            }
            
            .btn-install {
                padding: 0.625rem;
                font-size: 0.8rem;
            }
            
            .footer-note {
                font-size: 0.75rem;
                margin-top: 0.75rem;
                padding-top: 0.75rem;
            }
        }

        /* Landscape mobile */
        @media (max-height: 600px) and (orientation: landscape) {
            .install-header {
                padding: 1rem 1.5rem;
            }
            
            .install-header .icon {
                width: 40px;
                height: 40px;
                margin-bottom: 0.5rem;
            }
            
            .install-header .icon i {
                font-size: 1.25rem;
            }
            
            .install-header h1 {
                font-size: 1.125rem;
                margin-bottom: 0.25rem;
            }
            
            .install-body {
                padding: 1rem 1.5rem;
            }
            
            .form-group {
                margin-bottom: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="install-container">
        <div class="install-card">
            <div class="install-header">
                <div class="icon">
                    <i class="fas fa-{{ ($isSubdomain ?? false) ? 'link' : 'rocket' }}"></i>
                </div>
                <h1>{{ ($isSubdomain ?? false) ? 'Cài đặt Subdomain' : 'Cài đặt hệ thống' }}</h1>
                <p>{{ ($isSubdomain ?? false) ? 'Kết nối với trang chính' : 'Tạo tài khoản quản trị' }}</p>
            </div>
            
            <div class="install-body">
                @if (session('info'))
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-1"></i>
                        {{ session('info') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        <strong>Có lỗi:</strong>
                        <ul class="mb-0 mt-1" style="padding-left: 1rem; margin: 0;">
                            @foreach ($errors->all() as $error)
                                <li style="margin: 0;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('install.store') }}" id="installForm">
                    @csrf
                    
                    @if($isSubdomain ?? false)
                    <div class="form-group">
                        <label for="api_key" class="form-label">
                            <i class="fas fa-key me-1"></i>API Key (từ trang chính)
                        </label>
                        <input type="text" class="form-control" id="api_key" name="api_key" 
                               value="{{ old('api_key') }}" required 
                               placeholder="Nhập API Key từ tài khoản trang chính">
                        <small class="text-muted">Lấy API Key từ tài khoản của bạn trên trang chính</small>
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="name" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name') }}" required 
                               placeholder="Nhập họ và tên">
                    </div>

                    <div class="form-group">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username" name="username" 
                               value="{{ old('username') }}" required 
                               placeholder="Tên đăng nhập">
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ old('email') }}" required 
                               placeholder="admin@example.com">
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" 
                               required placeholder="Tối thiểu 8 ký tự">
                        <div id="passwordStrength" class="password-strength"></div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" id="password_confirmation" 
                               name="password_confirmation" required 
                               placeholder="Nhập lại mật khẩu">
                        <div id="passwordMatch" class="password-strength"></div>
                    </div>

                    <button type="submit" class="btn-install" id="submitBtn">
                        <i class="fas fa-rocket me-1"></i>
                        Cài đặt hệ thống
                    </button>
                </form>

                <div class="footer-note">
                    <i class="fas fa-shield-alt me-1"></i>
                    Hệ thống sẽ tự động tạo cấu hình mặc định
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form elements
        const form = document.getElementById('installForm');
        const submitBtn = document.getElementById('submitBtn');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');
        const passwordStrength = document.getElementById('passwordStrength');
        const passwordMatch = document.getElementById('passwordMatch');
        const username = document.getElementById('username');

        // Password strength checker
        function checkPasswordStrength(pwd) {
            let strength = 0;
            if (pwd.length >= 8) strength++;
            if (/[a-z]/.test(pwd)) strength++;
            if (/[A-Z]/.test(pwd)) strength++;
            if (/[0-9]/.test(pwd)) strength++;
            if (/[^A-Za-z0-9]/.test(pwd)) strength++;
            return strength;
        }

        password.addEventListener('input', function() {
            const strength = checkPasswordStrength(this.value);
            
            if (this.value.length === 0) {
                passwordStrength.innerHTML = '';
                return;
            }

            let className = 'strength-weak';
            let text = 'Yếu';
            
            if (strength >= 3) {
                className = 'strength-medium';
                text = 'Trung bình';
            }
            if (strength >= 4) {
                className = 'strength-strong';
                text = 'Mạnh';
            }

            passwordStrength.innerHTML = `<span class="${className}">Độ mạnh: ${text}</span>`;
        });

        // Password confirmation
        function validatePasswordMatch() {
            if (confirmPassword.value.length === 0) {
                passwordMatch.innerHTML = '';
                return true;
            }

            if (password.value === confirmPassword.value) {
                passwordMatch.innerHTML = '<span class="strength-strong"><i class="fas fa-check"></i> Khớp</span>';
                confirmPassword.setCustomValidity('');
                return true;
            } else {
                passwordMatch.innerHTML = '<span class="strength-weak"><i class="fas fa-times"></i> Không khớp</span>';
                confirmPassword.setCustomValidity('Mật khẩu không khớp');
                return false;
            }
        }

        password.addEventListener('input', validatePasswordMatch);
        confirmPassword.addEventListener('input', validatePasswordMatch);

        // Username formatting
        username.addEventListener('input', function() {
            this.value = this.value.toLowerCase().replace(/[^a-z0-9_]/g, '');
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            if (!validatePasswordMatch()) {
                e.preventDefault();
                return;
            }

            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang cài đặt...';
            submitBtn.disabled = true;
        });

        // Auto-focus
        document.getElementById('name').focus();
    </script>
</body>
</html>