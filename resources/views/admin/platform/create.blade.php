@extends('admin.layouts.app')

@section('title', 'Thêm nền tảng mới')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Thêm nền tảng mới',
                    'breadcrumb' => 'Nền tảng',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Thông tin nền tảng</h4>
                                <p class="text-muted mb-0 mt-1">Nhập thông tin chi tiết của nền tảng mạng xã hội</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.platform.store') }}" method="POST" id="createPlatformForm">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="platform_name" class="form-label">Tên nền tảng <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="platform_name" name="name" value="{{ old('name') }}" required
                                            placeholder="Ví dụ: Facebook, Instagram">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="platform_position" class="form-label">Vị trí</label>
                                                <input type="number"
                                                    class="form-control @error('position') is-invalid @enderror"
                                                    id="platform_position" name="position" value="{{ old('position', 0) }}"
                                                    min="0" placeholder="0">
                                                <small class="text-muted">Thứ tự hiển thị (tùy chọn)</small>
                                                @error('position')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Trạng thái</label>
                                                <div class="form-check form-switch mt-2">
                                                    <input class="form-check-input @error('status') is-invalid @enderror"
                                                        type="checkbox" id="platform_status" name="status"
                                                        {{ old('status', true) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="platform_status">
                                                        Kích hoạt nền tảng
                                                    </label>
                                                </div>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="platform_image" class="form-label">URL Hình ảnh</label>
                                        <input type="url" class="form-control @error('image') is-invalid @enderror"
                                            id="platform_image" name="image" value="{{ old('image') }}"
                                            placeholder="https://example.com/image.png">
                                        <small class="text-muted">URL của hình ảnh nền tảng (tùy chọn)</small>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                            
                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <a href="{{ route('admin.platform.index') }}" class="btn btn-secondary">
                                            <i class="bx bx-x me-1"></i>Hủy
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-save me-1"></i>Tạo nền tảng
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
                                            style="max-height: 200px;">
                                    </div>
                                    <div id="noImagePreview" class="text-muted">
                                        <i class="bx bx-image display-4"></i>
                                        <p>Nhập URL hình ảnh để xem trước</p>
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
                                        <li>Tên nền tảng nên rõ ràng</li>
                                        <li>Hình ảnh nên có chất lượng cao</li>
                                        <li>Vị trí để sắp xếp thứ tự</li>
                                        <li>Kích hoạt khi sẵn sàng</li>
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
            // Utility functions
            const isValidUrl = (string) => {
                try {
                    new URL(string);
                    return true;
                } catch (_) {
                    return false;
                }
            };

            const showImagePreview = (url) => {
                if (url && isValidUrl(url)) {
                    $('#previewImg').attr('src', url).on('error', function() {
                        hideImagePreview('Không thể tải hình ảnh từ URL này');
                    });
                    $('#imagePreview').show();
                    $('#noImagePreview').hide();
                } else {
                    hideImagePreview('Nhập URL hình ảnh để xem trước');
                }
            };

            const hideImagePreview = (message = 'Nhập URL hình ảnh để xem trước') => {
                $('#imagePreview').hide();
                $('#noImagePreview').show().find('p').text(message);
            };

            // Image preview functionality
            $('#platform_image').on('input', function() {
                showImagePreview(this.value);
            });

            // Form validation and submission
            $('#createPlatformForm').on('submit', function(e) {
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                
                // Validate image URL if provided
                const imageUrl = $('#platform_image').val();
                if (imageUrl && !isValidUrl(imageUrl)) {
                    e.preventDefault();
                    $('#platform_image').addClass('is-invalid');
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

            // Initialize preview
            showImagePreview($('#platform_image').val());
        });
    </script>
@endpush
