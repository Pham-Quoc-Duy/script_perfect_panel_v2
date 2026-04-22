@extends('admin.layouts.app')

@section('title', 'Thêm ngôn ngữ mới')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Thêm ngôn ngữ mới',
                    'breadcrumb' => 'Ngôn ngữ',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Thông tin ngôn ngữ</h4>
                                <p class="text-muted mb-0 mt-1">Nhập thông tin chi tiết của ngôn ngữ</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.language.store') }}" method="POST" id="createLanguageForm">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên ngôn ngữ <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                            id="name" name="name" value="{{ old('name') }}" 
                                            required placeholder="Ví dụ: Tiếng Việt, English">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="code" class="form-label">Mã ngôn ngữ <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                            id="code" name="code" value="{{ old('code') }}" 
                                            required placeholder="Ví dụ: vi, en" maxlength="10">
                                        <small class="text-muted">Mã ISO 639-1 (vi, en, fr, etc.)</small>
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="flag" class="form-label">URL Cờ</label>
                                        <input type="url" class="form-control @error('flag') is-invalid @enderror" 
                                            id="flag" name="flag" value="{{ old('flag') }}" 
                                            placeholder="https://example.com/flag.png">
                                        <small class="text-muted">URL của hình ảnh cờ (tùy chọn)</small>
                                        @error('flag')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div id="flagPreview" style="display: none;" class="mb-3">
                                        <small class="text-muted d-block mb-2">Xem trước cờ:</small>
                                        <img id="previewFlag" src="" alt="Flag" class="rounded" style="max-width: 100%; max-height: 100px;">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Trạng thái</label>
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input @error('status') is-invalid @enderror" 
                                                   type="checkbox" id="language_status" 
                                                   {{ old('status', 1) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="language_status">
                                                Kích hoạt ngôn ngữ
                                            </label>
                                            <!-- Hidden input sẽ được JavaScript cập nhật -->
                                            <input type="hidden" name="status" id="status_value" value="{{ old('status', 1) }}">
                                        </div>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <a href="{{ route('admin.language.index') }}" class="btn btn-secondary">
                                            <i class="bx bx-x me-1"></i>Hủy
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bx bx-save me-1"></i>Tạo ngôn ngữ
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
                            <div class="card-body text-center">
                                <div id="preview-flag" class="mb-3">
                                    <div class="bg-light rounded d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 40px;">
                                        <i class="bx bx-image font-size-24 text-muted"></i>
                                    </div>
                                </div>
                                <h5 id="preview-name" class="text-muted mb-2">Tên ngôn ngữ</h5>
                                <p id="preview-code" class="text-muted mb-2"><code>-</code></p>
                                <span id="preview-status" class="badge bg-success">Hoạt động</span>
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
                                        <li>Tên ngôn ngữ nên rõ ràng</li>
                                        <li>Mã ngôn ngữ theo ISO 639-1</li>
                                        <li>Cờ nên có chất lượng cao</li>
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
    const isValidUrl = (string) => {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    };

    const updatePreview = () => {
        const name = $('#name').val() || 'Tên ngôn ngữ';
        const code = $('#code').val() || '-';
        const flag = $('#flag').val();
        const isActive = $('#language_status').is(':checked');
        
        $('#preview-name').text(name);
        $('#preview-code').html(`<code>${code}</code>`);
        
        if (flag && isValidUrl(flag)) {
            $('#preview-flag').html(`<img src="${flag}" alt="${code}" class="rounded" style="width: 60px; height: 40px; object-fit: cover;">`);
        } else {
            $('#preview-flag').html(`<div class="bg-light rounded d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 40px;">
                <i class="bx bx-image font-size-24 text-muted"></i>
            </div>`);
        }
        
        if (isActive) {
            $('#preview-status').removeClass('bg-danger').addClass('bg-success').text('Hoạt động');
        } else {
            $('#preview-status').removeClass('bg-success').addClass('bg-danger').text('Không hoạt động');
        }
    };

    $('#name, #code, #language_status').on('input change', updatePreview);
    
    // Handle status checkbox to update hidden field with integer values
    $('#language_status').on('change', function() {
        const isChecked = $(this).is(':checked');
        $('#status_value').val(isChecked ? 1 : 0);
        updatePreview();
    });
    
    $('#flag').on('change', function() {
        if (this.value && isValidUrl(this.value)) {
            $('#previewFlag').attr('src', this.value);
            $('#flagPreview').show();
        } else {
            $('#flagPreview').hide();
        }
        updatePreview();
    });
    
    $('#createLanguageForm').on('submit', function(e) {
        // Ensure status field has proper integer value before submission
        const isChecked = $('#language_status').is(':checked');
        $('#status_value').val(isChecked ? 1 : 0);
        
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i>Đang tạo...');
    });
    
    // Initialize status value on page load
    const initialChecked = $('#language_status').is(':checked');
    $('#status_value').val(initialChecked ? 1 : 0);
    
    updatePreview();
});
</script>
@endpush
