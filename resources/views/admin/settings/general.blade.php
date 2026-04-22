@extends('admin.settings.layout')

@section('tab-content')
    <form action="{{ route('admin.settings.update.general') }}" method="POST" id="generalForm">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-lg-8">
                <h5 class="mb-3">Thông tin website</h5>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề website <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title', $config->title) }}" 
                                required placeholder="Perfect Panel Vietnam">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="keywords" class="form-label">Từ khóa SEO</label>
                            <input type="text" class="form-control @error('keywords') is-invalid @enderror" 
                                id="keywords" name="keywords" value="{{ old('keywords', $config->keywords) }}" 
                                placeholder="smm panel, social media marketing">
                            @error('keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả website <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                        id="description" name="description" rows="3" required
                        placeholder="Mô tả ngắn về website của bạn">{{ old('description', $config->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo URL</label>
                            <input type="url" class="form-control @error('logo') is-invalid @enderror" 
                                id="logo" name="logo" value="{{ old('logo', $config->logo) }}" 
                                placeholder="https://example.com/logo.png">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="favicon" class="form-label">Favicon URL</label>
                            <input type="url" class="form-control @error('favicon') is-invalid @enderror" 
                                id="favicon" name="favicon" value="{{ old('favicon', $config->favicon) }}" 
                                placeholder="https://example.com/favicon.ico">
                            @error('favicon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="og_image" class="form-label">OG Image URL</label>
                            <input type="url" class="form-control @error('og_image') is-invalid @enderror" 
                                id="og_image" name="og_image" value="{{ old('og_image', $config->og_image) }}" 
                                placeholder="https://example.com/og-image.jpg">
                            @error('og_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <h5 class="mb-3 mt-4">Cài đặt mặc định</h5>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="default_landingpage" class="form-label">Trang đích <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('default_landingpage') is-invalid @enderror" 
                                id="default_landingpage" name="default_landingpage" value="{{ old('default_landingpage', $config->default_landingpage) }}" 
                                required placeholder="/">
                            @error('default_landingpage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="default_login" class="form-label">Trang đăng nhập <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('default_login') is-invalid @enderror" 
                                id="default_login" name="default_login" value="{{ old('default_login', $config->default_login) }}" 
                                required placeholder="/login">
                            @error('default_login')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="default_currency" class="form-label">Tiền tệ mặc định <span class="text-danger">*</span></label>
                            <select class="form-select @error('default_currency') is-invalid @enderror" 
                                id="default_currency" name="default_currency" required>
                                <option value="USD" {{ old('default_currency', $config->default_currency) == 'USD' ? 'selected' : '' }}>USD ($)</option>
                                <option value="VND" {{ old('default_currency', $config->default_currency) == 'VND' ? 'selected' : '' }}>VND (₫)</option>
                                <option value="EUR" {{ old('default_currency', $config->default_currency) == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                            </select>
                            @error('default_currency')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="default_lang" class="form-label">Ngôn ngữ mặc định <span class="text-danger">*</span></label>
                            <select class="form-select @error('default_lang') is-invalid @enderror" 
                                id="default_lang" name="default_lang" required>
                                <option value="en" {{ old('default_lang', $config->default_lang) == 'en' ? 'selected' : '' }}>English</option>
                                <option value="vi" {{ old('default_lang', $config->default_lang) == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                            </select>
                            @error('default_lang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="timezone" class="form-label">Múi giờ <span class="text-danger">*</span></label>
                            <select class="form-select @error('timezone') is-invalid @enderror" 
                                id="timezone" name="timezone" required>
                                <option value="UTC" {{ old('timezone', $config->timezone) == 'UTC' ? 'selected' : '' }}>UTC (UTC+0)</option>
                                <option value="Asia/Ho_Chi_Minh" {{ old('timezone', $config->timezone) == 'Asia/Ho_Chi_Minh' ? 'selected' : '' }}>Asia/Ho_Chi_Minh (UTC+7)</option>
                                <option value="America/New_York" {{ old('timezone', $config->timezone) == 'America/New_York' ? 'selected' : '' }}>America/New_York (UTC-5)</option>
                                <option value="Europe/London" {{ old('timezone', $config->timezone) == 'Europe/London' ? 'selected' : '' }}>Europe/London (UTC+0)</option>
                            </select>
                            @error('timezone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Trạng thái website</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input @error('status') is-invalid @enderror" 
                               type="checkbox" id="setting_status" name="status" value="1"
                               {{ old('status', $config->status) ? 'checked' : '' }}>
                        <label class="form-check-label" for="setting_status">
                            Website hoạt động
                        </label>
                    </div>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card bg-light">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Xem trước</h6>
                    </div>
                    <div class="card-body text-center">
                        <div id="preview-logo" class="mb-3">
                            @if($config->logo)
                                <img src="{{ $config->logo }}" alt="Logo" class="rounded" style="max-width: 100px; max-height: 60px; object-fit: contain;">
                            @else
                                <div class="bg-white rounded d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 60px;">
                                    <i class="bx bx-image font-size-24 text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <h6 id="preview-title" class="mb-2">{{ $config->title ?: 'Tiêu đề website' }}</h6>
                        <p id="preview-description" class="text-muted small mb-2">{{ $config->description ?: 'Mô tả website' }}</p>
                        <span id="preview-status" class="badge {{ $config->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $config->status ? 'Hoạt động' : 'Bảo trì' }}
                        </span>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Hướng dẫn</h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info mb-0">
                            <h6 class="alert-heading mb-2">Lưu ý:</h6>
                            <ul class="mb-0 small">
                                <li>Tiêu đề sẽ hiển thị ở header và title tag</li>
                                <li>Logo nên có kích thước phù hợp (200x60px)</li>
                                <li>Mô tả dùng cho SEO meta description</li>
                                <li>Tắt website khi bảo trì</li>
                            </ul>
                        </div>
                    </div>
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
    const isValidUrl = (string) => {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    };

    const updatePreview = () => {
        const title = $('#title').val() || 'Tiêu đề website';
        const description = $('#description').val() || 'Mô tả website';
        const logo = $('#logo').val();
        const siteActive = $('#setting_status').is(':checked');
        
        $('#preview-title').text(title);
        $('#preview-description').text(description);
        
        if (logo && isValidUrl(logo)) {
            $('#preview-logo').html(`<img src="${logo}" alt="Logo" class="rounded" style="max-width: 100px; max-height: 60px; object-fit: contain;">`);
        } else {
            $('#preview-logo').html(`<div class="bg-white rounded d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 60px;">
                <i class="bx bx-image font-size-24 text-muted"></i>
            </div>`);
        }
        
        if (siteActive) {
            $('#preview-status').removeClass('bg-danger').addClass('bg-success').text('Hoạt động');
        } else {
            $('#preview-status').removeClass('bg-success').addClass('bg-danger').text('Bảo trì');
        }
    };

    // Update preview on input changes
    $('#title, #description, #logo, #setting_status').on('input change', updatePreview);
    
    // Form submission
    $('#generalForm').on('submit', function(e) {
        // Add hidden input for unchecked checkbox
        if (!$('#setting_status').is(':checked')) {
            $(this).append('<input type="hidden" name="status" value="0">');
        }
        
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i>Đang lưu...');
    });
    
    // Initial preview update
    updatePreview();
});
</script>
@endpush