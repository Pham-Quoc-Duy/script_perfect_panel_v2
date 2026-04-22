@extends('admin.layouts.app')

@section('title', 'Thêm phương thức thanh toán')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Thêm phương thức thanh toán',
                    'breadcrumb' => 'Phương thức thanh toán',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Thông tin phương thức thanh toán</h4>
                                <p class="text-muted mb-0 mt-1">Nhập thông tin chi tiết của phương thức thanh toán</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.payments.method.store') }}" method="POST" enctype="multipart/form-data" id="createPaymentMethodForm">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên phương thức <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name') }}" required
                                               placeholder="Ví dụ: Chuyển khoản ngân hàng, Ví điện tử">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="type" class="form-label">Loại phương thức <span class="text-danger">*</span></label>
                                        <select class="form-select @error('type') is-invalid @enderror" 
                                                id="type" name="type" required>
                                            <option value="">-- Chọn loại phương thức --</option>
                                            @foreach(\App\Models\PaymentMethod::getTypes() as $value => $label)
                                                <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Chọn loại phương thức thanh toán phù hợp</small>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Hình ảnh</label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                                       id="image" name="image" accept="image/*">
                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Chấp nhận: JPG, PNG, GIF. Tối đa 2MB.</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Trạng thái</label>
                                                <div class="form-check form-switch mt-2">
                                                    <input class="form-check-input @error('status') is-invalid @enderror" 
                                                           type="checkbox" id="payment_method_status" name="status" value="1"
                                                           {{ old('status', true) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="payment_method_status">
                                                        Kích hoạt phương thức thanh toán
                                                    </label>
                                                </div>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <a href="{{ route('admin.payments.method.index') }}" class="btn btn-secondary">
                                            <i class="bx bx-x me-1"></i>Hủy
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-save me-1"></i>Tạo phương thức
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Xem trước</h4>
                            </div>
                            <div class="card-body">
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

                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Hướng dẫn</h4>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info mb-0">
                                    <h6 class="alert-heading mb-2">Lưu ý khi tạo:</h6>
                                    <ul class="mb-0 small">
                                        <li>Tên phương thức nên rõ ràng và dễ hiểu</li>
                                        <li>Hình ảnh nên có chất lượng cao và phù hợp</li>
                                        <li>Kích hoạt khi đã sẵn sàng sử dụng</li>
                                        <li>Có thể thêm tài khoản thanh toán sau</li>
                                    </ul>
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

            const hideImagePreview = () => {
                $('#imagePreview').hide();
                $('#noImagePreview').show();
            };

            // Form validation and submission
            $('#createPaymentMethodForm').on('submit', function(e) {
                let isValid = true;
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                
                // Check required fields
                const name = $('#name').val().trim();
                
                if (!name) {
                    $('#name').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#name').removeClass('is-invalid');
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
            $('.form-control').on('input', function() {
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