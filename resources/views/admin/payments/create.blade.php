@extends('admin.layouts.app')

@section('title', 'Thêm tài khoản thanh toán')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Thêm tài khoản thanh toán',
                    'breadcrumb' => 'Tài khoản thanh toán',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Thông tin tài khoản thanh toán</h4>
                                <p class="text-muted mb-0 mt-1">Chọn loại phương thức và nhập thông tin chi tiết</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.payments.store') }}" method="POST" enctype="multipart/form-data" id="createPaymentForm">
                                    @csrf
                                    
                                    <!-- Payment Method Selection -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="payment_method_id" class="form-label">
                                                    <i class="bx bx-credit-card me-1"></i>Phương thức thanh toán 
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-select @error('payment_method_id') is-invalid @enderror" 
                                                        id="payment_method_id" name="payment_method_id" required>
                                                    <option value="">-- Chọn phương thức thanh toán --</option>
                                                    @foreach ($paymentMethods ?? [] as $method)
                                                        <option value="{{ $method->id }}" 
                                                                data-type="{{ $method->type ?? 'other' }}"
                                                                {{ old('payment_method_id') == $method->id ? 'selected' : '' }}>
                                                            {{ $method->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('payment_method_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Chọn loại phương thức thanh toán phù hợp</small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Tên hiển thị <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                       id="name" name="name" value="{{ old('name') }}" required
                                                       placeholder="VD: ACB, MBBANK, VCB (không khoảng cách)">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">
                                                    <strong>Gợi ý mã ngân hàng:</strong> ACB, MBBANK, VCB, BIDV, VIETINBANK, SACOMBANK, AGRIBANK, TPBANK
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Dynamic Form Fields Container -->
                                    <div id="dynamicFields">
                                        <!-- Fields will be loaded here based on payment method selection -->
                                    </div>

                                    <!-- Common Fields -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="min" class="form-label">Số tiền tối thiểu <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('min') is-invalid @enderror" 
                                                       id="min" name="min" value="{{ old('min') }}" required
                                                       min="0" step="0.0001" placeholder="0.0000">
                                                @error('min')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="max" class="form-label">Số tiền tối đa <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('max') is-invalid @enderror" 
                                                       id="max" name="max" value="{{ old('max') }}" required
                                                       min="0" step="0.0001" placeholder="0.0000">
                                                @error('max')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Hình ảnh</label>
                                                
                                                <!-- Image Upload Method Selection -->
                                                <div class="mb-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="image_method" id="upload_method" value="upload" checked>
                                                        <label class="form-check-label" for="upload_method">
                                                            <i class="bx bx-upload me-1"></i>Upload file
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="image_method" id="link_method" value="link">
                                                        <label class="form-check-label" for="link_method">
                                                            <i class="bx bx-link me-1"></i>Dùng link
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Upload File Input -->
                                                <div id="upload_section">
                                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                                           id="image" name="image" accept="image/*">
                                                    <small class="text-muted">Chấp nhận: JPG, PNG, GIF. Tối đa 2MB.</small>
                                                </div>

                                                <!-- Link Input -->
                                                <div id="link_section" style="display: none;">
                                                    <input type="url" class="form-control @error('image_input') is-invalid @enderror" 
                                                           id="image_input" name="image_input" value="{{ old('image_input') }}"
                                                           placeholder="https://example.com/image.jpg">
                                                    <small class="text-muted">Nhập URL hình ảnh từ internet</small>
                                                </div>

                                                @error('image')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                                @error('image_input')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    <i class="bx bx-gift me-1"></i>Cấu hình Bonus
                                                    <button type="button" class="btn btn-sm btn-outline-primary ms-2" onclick="addBonusRule()">
                                                        <i class="bx bx-plus me-1"></i>Thêm quy tắc
                                                    </button>
                                                </label>
                                                <div id="bonusRules" class="border rounded p-3">
                                                    <div class="bonus-rule-item mb-2" data-index="0">
                                                        <div class="row align-items-center">
                                                            <div class="col-5">
                                                                <input type="number" class="form-control form-control-sm" 
                                                                       name="bonus_amounts[]" placeholder="Số tiền tối thiểu" 
                                                                       min="0" step="0.01" value="">
                                                                <small class="text-muted">USD</small>
                                                            </div>
                                                            <div class="col-5">
                                                                <input type="number" class="form-control form-control-sm" 
                                                                       name="bonus_percents[]" placeholder="% Bonus" 
                                                                       min="0" max="100" step="0.01" value="">
                                                                <small class="text-muted">%</small>
                                                            </div>
                                                            <div class="col-2">
                                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                        onclick="removeBonusRule(0)" style="display: none;">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="bonus" name="bonus" value="">
                                                @error('bonus')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">
                                                    Ví dụ: Số tiền 10.00 - Bonus 5% có nghĩa là giao dịch từ $10.00 USD trở lên sẽ được bonus 5%
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="note" class="form-label">Ghi chú</label>
                                        <textarea class="form-control @error('note') is-invalid @enderror" 
                                                  id="note" name="note" rows="3" 
                                                  placeholder="Nhập ghi chú (tùy chọn)">{{ old('note') }}</textarea>
                                        @error('note')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Trạng thái</label>
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input @error('status') is-invalid @enderror" 
                                                   type="checkbox" id="payment_status" name="status" value="1" 
                                                   {{ old('status', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="payment_status">
                                                Kích hoạt tài khoản thanh toán
                                            </label>
                                        </div>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                                            <i class="bx bx-x me-1"></i>Hủy
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-save me-1"></i>Tạo tài khoản
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Payment Method Preview -->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Xem trước</h4>
                            </div>
                            <div class="card-body">
                                <!-- Payment Method Preview -->
                                <div id="paymentMethodPreview" class="mb-3" style="display: none;">
                                    <div class="alert alert-info">
                                        <div class="d-flex align-items-center">
                                            <i class="bx bx-credit-card me-2"></i>
                                            <div>
                                                <strong>Phương thức thanh toán:</strong>
                                                <div id="selectedMethodName" class="text-primary"></div>
                                                <div id="selectedMethodType" class="text-muted small"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Preview -->
                                <div class="text-center">
                                    <div id="imagePreview" style="display: none;">
                                        <img id="previewImg" src="" alt="Preview" class="img-fluid rounded"
                                             style="max-height: 200px; max-width: 200px; object-fit: cover;">
                                    </div>
                                    <div id="noImagePreview" class="text-muted">
                                        <i class="bx bx-credit-card display-4"></i>
                                        <p>Chọn hình ảnh để xem trước</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Instructions Card -->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Hướng dẫn</h4>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info mb-3">
                                    <h6 class="alert-heading mb-2">Mã ngân hàng phổ biến:</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="mb-0 small">
                                                <li><strong>ACB</strong> - Á Châu</li>
                                                <li><strong>MBBANK</strong> - Quân Đội</li>
                                                <li><strong>VCB</strong> - Vietcombank</li>
                                                <li><strong>BIDV</strong> - Đầu tư & Phát triển</li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="mb-0 small">
                                                <li><strong>VIETINBANK</strong> - Công Thương</li>
                                                <li><strong>SACOMBANK</strong> - Sài Gòn TM</li>
                                                <li><strong>AGRIBANK</strong> - Nông nghiệp</li>
                                                <li><strong>TPBANK</strong> - Tiên Phong</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="alert alert-warning mb-0">
                                    <h6 class="alert-heading mb-2">Lưu ý khi tạo:</h6>
                                    <ul class="mb-0 small">
                                        <li>Tên hiển thị nên bắt đầu bằng mã ngân hàng</li>
                                        <li>Không sử dụng khoảng cách trong mã ngân hàng</li>
                                        <li>Thông tin tài khoản phải chính xác</li>
                                        <li>Số tiền tối đa phải lớn hơn tối thiểu</li>
                                        <li>Kích hoạt khi đã kiểm tra thông tin</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Type Examples -->
                        <div class="card" id="paymentTypeExamples" style="display: none;">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Ví dụ cấu hình</h4>
                            </div>
                            <div class="card-body">
                                <div id="exampleContent">
                                    <!-- Dynamic examples will be loaded here -->
                                </div>
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
            // Bank code suggestions
            const bankCodes = ['ACB', 'MBBANK', 'VCB', 'BIDV', 'VIETINBANK', 'SACOMBANK', 'AGRIBANK', 'TPBANK', 'TECHCOMBANK', 'VPBANK'];
            
            // Add datalist for bank code suggestions
            const nameInput = $('#name');
            const datalistId = 'bankCodeSuggestions';
            
            // Create datalist element
            const datalist = $(`<datalist id="${datalistId}"></datalist>`);
            bankCodes.forEach(code => {
                datalist.append(`<option value="${code}">`);
            });
            nameInput.attr('list', datalistId);
            nameInput.after(datalist);
            
            // Auto-suggest when typing
            nameInput.on('input', function() {
                const value = $(this).val().toUpperCase();
                const suggestions = bankCodes.filter(code => code.includes(value));
                
                // Update datalist
                datalist.empty();
                suggestions.forEach(code => {
                    datalist.append(`<option value="${code}">`);
                });
            });

            // Payment method change handler
            $('#payment_method_id').change(function() {
                const selectedOption = $(this).find('option:selected');
                const methodName = selectedOption.text();
                
                if ($(this).val()) {
                    $('#selectedMethodName').text(methodName);
                    $('#paymentMethodPreview').show();
                } else {
                    $('#paymentMethodPreview').hide();
                }
            });

            // Image method toggle functionality
            $('input[name="image_method"]').change(function() {
                const method = $(this).val();
                if (method === 'upload') {
                    $('#upload_section').show();
                    $('#link_section').hide();
                    $('#image_input').val('').removeClass('is-invalid');
                } else {
                    $('#upload_section').hide();
                    $('#link_section').show();
                    $('#image').val('').removeClass('is-invalid');
                    hideImagePreview();
                }
            });

            // Image preview functionality for file upload
            $('#image').change(function() {
                const file = this.files[0];
                if (file) {
                    // Validate file type
                    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                    if (!validTypes.includes(file.type)) {
                        showToast('error', 'Vui lòng chọn file hình ảnh hợp lệ (JPG, PNG, GIF)');
                        this.value = '';
                        hideImagePreview();
                        return;
                    }

                    // Validate file size (2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        showToast('error', 'Kích thước file không được vượt quá 2MB');
                        this.value = '';
                        hideImagePreview();
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImg').attr('src', e.target.result);
                        $('#imagePreview').show();
                        $('#noImagePreview').hide();
                    };
                    reader.readAsDataURL(file);
                } else {
                    hideImagePreview();
                }
            });

            // Image preview functionality for URL input
            $('#image_input').on('input blur', function() {
                const url = $(this).val().trim();
                if (url) {
                    // Basic URL validation
                    if (!isValidImageUrl(url)) {
                        $(this).addClass('is-invalid');
                        hideImagePreview();
                        return;
                    }
                    
                    $(this).removeClass('is-invalid');
                    
                    // Test if image loads
                    const img = new Image();
                    img.onload = function() {
                        $('#previewImg').attr('src', url);
                        $('#imagePreview').show();
                        $('#noImagePreview').hide();
                    };
                    img.onerror = function() {
                        $('#image_input').addClass('is-invalid');
                        showToast('error', 'Không thể tải hình ảnh từ URL này');
                        hideImagePreview();
                    };
                    img.src = url;
                } else {
                    $(this).removeClass('is-invalid');
                    hideImagePreview();
                }
            });

            function isValidImageUrl(url) {
                try {
                    const urlObj = new URL(url);
                    const validExtensions = ['.jpg', '.jpeg', '.png', '.gif', '.webp'];
                    const pathname = urlObj.pathname.toLowerCase();
                    return validExtensions.some(ext => pathname.endsWith(ext)) || 
                           url.includes('imgur.com') || 
                           url.includes('cloudinary.com') ||
                           url.includes('amazonaws.com');
                } catch {
                    return false;
                }
            }

            const hideImagePreview = () => {
                $('#imagePreview').hide();
                $('#noImagePreview').show();
            };

            // Form validation and submission
            $('#createPaymentForm').on('submit', function(e) {
                let isValid = true;
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                
                // Check required fields
                const paymentMethodId = $('#payment_method_id').val();
                const bankName = $('#bank_name').val().trim();
                const accountNumber = $('#account_number').val().trim();
                const min = parseFloat($('#min').val());
                const max = parseFloat($('#max').val());
                
                if (!paymentMethodId) {
                    $('#payment_method_id').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#payment_method_id').removeClass('is-invalid');
                }
                
                if (!bankName) {
                    $('#bank_name').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#bank_name').removeClass('is-invalid');
                }
                
                if (!accountNumber) {
                    $('#account_number').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#account_number').removeClass('is-invalid');
                }
                
                if (isNaN(min) || min < 0) {
                    $('#min').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#min').removeClass('is-invalid');
                }
                
                if (isNaN(max) || max < 0) {
                    $('#max').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#max').removeClass('is-invalid');
                }
                
                if (!isNaN(min) && !isNaN(max) && max <= min) {
                    $('#max').addClass('is-invalid');
                    showToast('error', 'Số tiền tối đa phải lớn hơn số tiền tối thiểu!');
                    isValid = false;
                }
                
                if (!isValid) {
                    e.preventDefault();
                    showToast('error', 'Vui lòng điền đầy đủ thông tin bắt buộc!');
                    return;
                }

                // Show loading state
                submitBtn.prop('disabled', true).html(
                    '<i class="bx bx-loader-alt bx-spin me-1"></i>Đang tạo...'
                );
            });

            // Remove validation errors on input
            $('.form-control, .form-select').on('input change', function() {
                $(this).removeClass('is-invalid');
            });
        });

        function showToast(type, message) {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            toast.innerHTML = `${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
            
            document.body.appendChild(toast);
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 5000);
        }
    </script>
@endpush

@push('scripts')
    <script>
        // Payment method configurations
        const paymentConfigs = {
            'bank_vn': {
                type: 'bank_vn',
                label: 'Ngân hàng Việt Nam',
                icon: 'bx-building-house',
                color: 'success',
                fields: [
                    {
                        name: 'account_name',
                        label: 'Tên chủ tài khoản',
                        type: 'text',
                        required: true,
                        placeholder: 'VD: NGUYEN VAN A',
                        help: 'Tên chủ tài khoản ngân hàng (viết hoa, không dấu)'
                    },
                    {
                        name: 'account_number',
                        label: 'Số tài khoản',
                        type: 'text',
                        required: true,
                        placeholder: 'VD: 1234567890',
                        help: 'Số tài khoản ngân hàng chính xác'
                    },
                    {
                        name: 'signature',
                        label: 'Chữ ký webhook',
                        type: 'text',
                        required: false,
                        placeholder: 'Tự động tạo nếu để trống',
                        help: 'Chữ ký bảo mật cho webhook (tùy chọn)'
                    }
                ],
                example: {
                    account_name: 'NGUYEN VAN A',
                    account_number: '1234567890',
                    signature: 'ACB_SIGNATURE_KEY'
                }
            },
            'binance': {
                type: 'binance',
                label: 'Binance',
                icon: 'bx-bitcoin',
                color: 'warning',
                fields: [
                    {
                        name: 'account_name',
                        label: 'Tên tài khoản Binance',
                        type: 'text',
                        required: true,
                        placeholder: 'VD: binance_user_123',
                        help: 'Tên tài khoản hoặc username Binance'
                    },
                    {
                        name: 'account_number',
                        label: 'Binance User ID',
                        type: 'text',
                        required: true,
                        placeholder: 'VD: 123456789',
                        help: 'ID người dùng Binance (số)'
                    },
                    {
                        name: 'api_key',
                        label: 'API Key',
                        type: 'text',
                        required: true,
                        placeholder: 'Binance API Key',
                        help: 'API Key từ Binance API Management'
                    },
                    {
                        name: 'secret_key',
                        label: 'Secret Key',
                        type: 'password',
                        required: true,
                        placeholder: 'Binance Secret Key',
                        help: 'Secret Key từ Binance API (bảo mật)'
                    }
                ],
                example: {
                    account_name: 'binance_user_123',
                    account_number: '123456789',
                    api_key: 'BINANCE_API_KEY_EXAMPLE',
                    secret_key: 'BINANCE_SECRET_KEY_EXAMPLE'
                }
            },
            'payeer': {
                type: 'payeer',
                label: 'Payeer',
                icon: 'bx-credit-card',
                color: 'info',
                fields: [
                    {
                        name: 'api_key',
                        label: 'API Key',
                        type: 'text',
                        required: true,
                        placeholder: 'Payeer API Key',
                        help: 'API Key từ Payeer API Settings'
                    },
                    {
                        name: 'secret_key',
                        label: 'Secret Key',
                        type: 'password',
                        required: true,
                        placeholder: 'Payeer Secret Key',
                        help: 'Secret Key từ Payeer (bảo mật)'
                    },
                    {
                        name: 'merchant_id',
                        label: 'Merchant ID',
                        type: 'text',
                        required: true,
                        placeholder: 'VD: P123456789',
                        help: 'ID merchant từ Payeer Merchant'
                    }
                ],
                example: {
                    api_key: 'PAYEER_API_KEY_EXAMPLE',
                    secret_key: 'PAYEER_SECRET_KEY_EXAMPLE',
                    merchant_id: 'P123456789'
                }
            }
        };

        /**
         * Determine payment type from method name or type field
         */
        function getPaymentTypeFromMethodName(methodName) {
            const name = methodName.toLowerCase().trim();
            
            // Check for bank_vn type
            if (name.includes('bank_vn') || 
                name.includes('acb') || 
                name.includes('vietcombank') || 
                name.includes('techcombank') ||
                name.includes('bidv') ||
                name.includes('vietinbank') ||
                name.includes('sacombank') ||
                name.includes('agribank') ||
                name.includes('mbbank') ||
                name.includes('tpbank') ||
                name.includes('bank') ||
                name.includes('vietnamese')) {
                return 'bank_vn';
            }
            
            // Check for Binance
            if (name.includes('binance')) {
                return 'binance';
            }
            
            // Check for Payeer
            if (name.includes('payeer')) {
                return 'payeer';
            }
            
            return 'other';
        }

        $(document).ready(function() {
            // Initialize bonus rules
            initializeBonusRules();

            // Payment method change handler
            $('#payment_method_id').change(function() {
                const selectedOption = $(this).find('option:selected');
                const methodName = selectedOption.text();
                const methodType = selectedOption.data('type') || 'other';
                
                if ($(this).val()) {
                    $('#selectedMethodName').text(methodName);
                    $('#selectedMethodType').text(`Loại: ${getPaymentTypeLabel(methodType)}`);
                    $('#paymentMethodPreview').show();
                    
                    // Load dynamic fields based on payment method type
                    loadDynamicFields(methodType);
                } else {
                    $('#paymentMethodPreview').hide();
                    $('#dynamicFields').empty();
                    $('#paymentTypeExamples').hide();
                }
            });

            // Image preview functionality
            $('#image').change(function() {
                const file = this.files[0];
                if (file) {
                    // Validate file type
                    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                    if (!validTypes.includes(file.type)) {
                        showToast('error', 'Vui lòng chọn file hình ảnh hợp lệ (JPG, PNG, GIF)');
                        this.value = '';
                        hideImagePreview();
                        return;
                    }

                    // Validate file size (2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        showToast('error', 'Kích thước file không được vượt quá 2MB');
                        this.value = '';
                        hideImagePreview();
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImg').attr('src', e.target.result);
                        $('#imagePreview').show();
                        $('#noImagePreview').hide();
                    };
                    reader.readAsDataURL(file);
                } else {
                    hideImagePreview();
                }
            });

            // Form validation and submission
            $('#createPaymentForm').on('submit', function(e) {
                let isValid = true;
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                
                // Validate required fields
                $(this).find('input[required], select[required]').each(function() {
                    if (!$(this).val()) {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                
                // Validate min/max amounts
                const min = parseFloat($('#min').val());
                const max = parseFloat($('#max').val());
                
                if (!isNaN(min) && !isNaN(max) && max <= min) {
                    $('#max').addClass('is-invalid');
                    showToast('error', 'Số tiền tối đa phải lớn hơn số tiền tối thiểu!');
                    isValid = false;
                }

                // Validate bonus rules
                updateBonusJSON();
                
                if (!isValid) {
                    e.preventDefault();
                    showToast('error', 'Vui lòng điền đầy đủ thông tin bắt buộc!');
                    return;
                }

                // Show loading state
                submitBtn.prop('disabled', true).html(
                    '<i class="bx bx-loader-alt bx-spin me-1"></i>Đang tạo...'
                );
            });

            // Remove validation errors on input
            $('.form-control, .form-select').on('input change', function() {
                $(this).removeClass('is-invalid');
            });
        });

        function loadDynamicFields(methodType) {
            const config = paymentConfigs[methodType];
            if (!config) {
                $('#dynamicFields').empty();
                $('#paymentTypeExamples').hide();
                return;
            }

            let fieldsHtml = `
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-${config.color} alert-dismissible border-0 mb-0">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="bx ${config.icon} font-size-20"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="alert-heading mb-1">${config.label} - Thông tin cấu hình</h6>
                                    <p class="mb-0 small">Vui lòng điền đầy đủ thông tin bắt buộc để kích hoạt phương thức thanh toán</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
            `;
            
            config.fields.forEach((field, index) => {
                const requiredMark = field.required ? '<span class="text-danger">*</span>' : '';
                const helpText = field.help ? `<div class="form-text text-muted">${field.help}</div>` : '';
                const iconClass = getFieldIcon(field.name);
                
                fieldsHtml += `
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="${field.name}" class="form-label">
                                <i class="bx ${iconClass} me-1 text-${config.color}"></i>${field.label} ${requiredMark}
                            </label>
                            <input type="${field.type}" class="form-control" id="${field.name}" name="${field.name}" 
                                   placeholder="${field.placeholder}" ${field.required ? 'required' : ''}>
                            ${helpText}
                        </div>
                    </div>
                `;
            });

            fieldsHtml += '</div>';
            $('#dynamicFields').html(fieldsHtml);

            // Show examples
            showPaymentExamples(config);
        }

        function getFieldIcon(fieldName) {
            const iconMap = {
                'account_name': 'bx-user',
                'account_number': 'bx-credit-card-alt',
                'signature': 'bx-key',
                'api_key': 'bx-code-alt',
                'secret_key': 'bx-lock-alt',
                'merchant_id': 'bx-id-card'
            };
            return iconMap[fieldName] || 'bx-cog';
        }

        function showPaymentExamples(config) {
            let exampleHtml = `
                <div class="alert alert-light border border-${config.color} mb-0">
                    <div class="d-flex align-items-start">
                        <div class="flex-shrink-0">
                            <i class="bx ${config.icon} font-size-20 text-${config.color}"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="alert-heading text-${config.color} mb-2">
                                <i class="bx bx-bulb me-1"></i>Ví dụ cấu hình ${config.label}
                            </h6>
                            <div class="small text-muted mb-3">
            `;

            Object.entries(config.example).forEach(([key, value]) => {
                const field = config.fields.find(f => f.name === key);
                if (field) {
                    const iconClass = getFieldIcon(key);
                    exampleHtml += `
                        <div class="d-flex align-items-center mb-1">
                            <i class="bx ${iconClass} me-2 text-${config.color}"></i>
                            <strong>${field.label}:</strong>
                            <code class="ms-2 text-dark">${value}</code>
                        </div>
                    `;
                }
            });

            exampleHtml += `
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-${config.color}" onclick="fillExampleData('${config.type}')">
                                <i class="bx bx-copy me-1"></i>Sử dụng ví dụ này
                            </button>
                        </div>
                    </div>
                </div>
            `;

            $('#exampleContent').html(exampleHtml);
            $('#paymentTypeExamples').show();
        }

        function fillExampleData(configType) {
            const config = Object.values(paymentConfigs).find(c => c.type === configType);
            if (!config) return;

            Object.entries(config.example).forEach(([key, value]) => {
                $(`#${key}`).val(value);
            });

            showToast('success', 'Đã điền dữ liệu ví dụ!');
        }

        function getPaymentTypeLabel(type) {
            const typeLabels = {
                'bank_vn': 'Ngân hàng Việt Nam',
                'binance': 'Binance',
                'payeer': 'Payeer',
                'other': 'Khác'
            };
            return typeLabels[type] || 'Khác';
        }

        const hideImagePreview = () => {
            $('#imagePreview').hide();
            $('#noImagePreview').show();
        };

        function showToast(type, message) {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            toast.innerHTML = `${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
            
            document.body.appendChild(toast);
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 5000);
        }
    </script>
@endpush

@push('scripts')
    <script>
        // Bonus Rules Management
        let bonusRuleIndex = 0;

        function initializeBonusRules() {
            // Initialize with one empty rule
            if ($('#bonusRules .bonus-rule-item').length === 0) {
                addBonusRule();
            }
            updateBonusJSON();
        }

        function addBonusRule() {
            bonusRuleIndex++;
            const ruleHtml = `
                <div class="bonus-rule-item mb-2" data-index="${bonusRuleIndex}">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <input type="number" class="form-control form-control-sm bonus-amount" 
                                   placeholder="Số tiền tối thiểu" min="0" step="0.01" 
                                   onchange="updateBonusJSON()">
                            <small class="text-muted">USD</small>
                        </div>
                        <div class="col-5">
                            <input type="number" class="form-control form-control-sm bonus-percent" 
                                   placeholder="% Bonus" min="0" max="100" step="0.01" 
                                   onchange="updateBonusJSON()">
                            <small class="text-muted">%</small>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                    onclick="removeBonusRule(${bonusRuleIndex})">
                                <i class="bx bx-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            $('#bonusRules').append(ruleHtml);
            updateRemoveButtons();
        }

        function removeBonusRule(index) {
            $(`.bonus-rule-item[data-index="${index}"]`).remove();
            updateRemoveButtons();
            updateBonusJSON();
        }

        function updateRemoveButtons() {
            const rules = $('#bonusRules .bonus-rule-item');
            if (rules.length <= 1) {
                rules.find('.btn-outline-danger').hide();
            } else {
                rules.find('.btn-outline-danger').show();
            }
        }

        function updateBonusJSON() {
            const bonusRules = [];
            $('#bonusRules .bonus-rule-item').each(function() {
                const amount = parseFloat($(this).find('.bonus-amount').val()) || 0;
                const percent = parseFloat($(this).find('.bonus-percent').val()) || 0;
                
                if (amount > 0 && percent > 0) {
                    bonusRules.push({
                        min_amount: amount,
                        bonus_percent: percent,
                        description: `Bonus ${percent}% cho giao dịch từ $${amount.toFixed(2)} USD`
                    });
                }
            });
            
            $('#bonus').val(JSON.stringify(bonusRules));
        }
    </script>
@endpush