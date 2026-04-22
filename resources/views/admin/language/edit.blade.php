@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa ngôn ngữ')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Chỉnh sửa ngôn ngữ',
                    'breadcrumb' => 'Ngôn ngữ',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Thông tin ngôn ngữ</h4>
                                <p class="text-muted mb-0 mt-1">Chỉnh sửa thông tin chi tiết của ngôn ngữ</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.language.update', $language) }}" method="POST" id="editLanguageForm">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên ngôn ngữ <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                            id="name" name="name" value="{{ $language->name }}" 
                                            required placeholder="Ví dụ: Tiếng Việt, English">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="code" class="form-label">Mã ngôn ngữ <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                            id="code" name="code" value="{{ $language->code }}" 
                                            required placeholder="Ví dụ: vi, en" maxlength="10">
                                        <small class="text-muted">Mã ISO 639-1 (vi, en, fr, etc.)</small>
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="flag" class="form-label">URL Cờ</label>
                                        <input type="url" class="form-control @error('flag') is-invalid @enderror" 
                                            id="flag" name="flag" value="{{ $language->flag ?? '' }}" 
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
                                                   type="checkbox" id="status" name="status" 
                                                   {{ $language->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status">
                                                Kích hoạt ngôn ngữ
                                            </label>
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
                                            <i class="bx bx-save me-1"></i>Lưu thay đổi
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
                                    @if($language->flag)
                                        <img src="{{ $language->flag }}" alt="{{ $language->code }}" class="rounded" style="width: 60px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 40px;">
                                            <i class="bx bx-image font-size-24 text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <h5 id="preview-name" class="text-muted mb-2">{{ $language->name }}</h5>
                                <p id="preview-code" class="text-muted mb-2"><code>{{ $language->code }}</code></p>
                                <span id="preview-status" class="badge {{ $language->status ? 'bg-success' : 'bg-danger' }}">
                                    {{ $language->status ? 'Hoạt động' : 'Không hoạt động' }}
                                </span>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Thông tin</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <small class="text-muted d-block">ID:</small>
                                    <code>#{{ $language->id }}</code>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block">Tạo lúc:</small>
                                    <small>{{ $language->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Cập nhật lúc:</small>
                                    <small>{{ $language->updated_at->format('d/m/Y H:i') }}</small>
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
        const isActive = $('#status').is(':checked');
        
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

    $('#name, #code, #status').on('input change', updatePreview);
    
    $('#flag').on('change', function() {
        if (this.value && isValidUrl(this.value)) {
            $('#previewFlag').attr('src', this.value);
            $('#flagPreview').show();
        } else {
            $('#flagPreview').hide();
        }
        updatePreview();
    });
    
    $('#editLanguageForm').on('submit', function(e) {
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i>Đang lưu...');
    });
    
    updatePreview();
});
</script>
@endpush
