@extends('admin.settings.layout')

@section('tab-content')
    <form action="{{ route('admin.settings.update.appearance') }}" method="POST" id="appearanceForm">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-lg-6">
                <h5 class="mb-3">Cài đặt giao diện</h5>
                
                <div class="mb-3">
                    <label for="default_theme" class="form-label">Giao diện mặc định <span class="text-danger">*</span></label>
                    <select class="form-select @error('default_theme') is-invalid @enderror" 
                        id="default_theme" name="default_theme" required>
                        <option value="light" {{ old('default_theme', $config->default_theme) == 'light' ? 'selected' : '' }}>
                            <i class="bx bx-sun"></i> Sáng
                        </option>
                        <option value="dark" {{ old('default_theme', $config->default_theme) == 'dark' ? 'selected' : '' }}>
                            <i class="bx bx-moon"></i> Tối
                        </option>
                    </select>
                    @error('default_theme')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="notice_modal" class="form-label">Thông báo popup</label>
                    <textarea class="form-control @error('notice_modal') is-invalid @enderror" 
                        id="notice_modal" name="notice_modal" rows="4"
                        placeholder="Nội dung thông báo hiển thị khi người dùng truy cập website">{{ old('notice_modal', $config->notice_modal) }}</textarea>
                    <small class="text-muted">Để trống nếu không muốn hiển thị thông báo</small>
                    @error('notice_modal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-lg-6">
                <h5 class="mb-3">Cài đặt Domain</h5>
                
                <div class="mb-3">
                    <label for="domain_main" class="form-label">Domain chính</label>
                    <input type="text" class="form-control @error('domain_main') is-invalid @enderror" 
                        id="domain_main" name="domain_main" value="{{ old('domain_main', $config->domain_main) }}" 
                        placeholder="example.com">
                    <small class="text-muted">Domain chính của website (không bao gồm http://)</small>
                    @error('domain_main')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="domain" class="form-label">Danh sách domain</label>
                    <textarea class="form-control @error('domain') is-invalid @enderror" 
                        id="domain" name="domain" rows="3"
                        placeholder="example.com&#10;sub.example.com&#10;another-domain.com">{{ old('domain', $config->domain) }}</textarea>
                    <small class="text-muted">Mỗi domain một dòng. Dùng để cấu hình CORS và bảo mật.</small>
                    @error('domain')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Giao diện đăng nhập -->
        <div class="row mt-4">
            <div class="col-12">
                <h5 class="mb-3">Giao diện đăng nhập</h5>
                <p class="text-muted mb-3">Chọn template cho trang đăng nhập</p>
                
                <div class="mb-3">
                    <input type="hidden" name="default_login" id="default_login" value="{{ old('default_login', $config->default_login ?? 'default') }}">
                    
                    <div class="row g-3" id="login-templates">
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="default">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=200&h=150&fit=crop&crop=center" 
                                         alt="Login Template Default" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Default</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="modern">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=200&h=150&fit=crop&crop=center" 
                                         alt="Login Template Modern" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Modern</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="minimal">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=200&h=150&fit=crop&crop=center" 
                                         alt="Login Template Minimal" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Minimal</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="creative">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=200&h=150&fit=crop&crop=center" 
                                         alt="Login Template Creative" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Creative</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="gradient">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1504639725590-34d0984388bd?w=200&h=150&fit=crop&crop=center" 
                                         alt="Login Template Gradient" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Gradient</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Giao diện người dùng -->
        <div class="row mt-4">
            <div class="col-12">
                <h5 class="mb-3">Giao diện người dùng</h5>
                <p class="text-muted mb-3">Chọn template cho dashboard người dùng</p>
                
                <div class="mb-3">
                    <input type="hidden" name="default_interface" id="default_interface" value="{{ old('default_interface', $config->default_interface ?? 'default') }}">
                    
                    <div class="row g-3" id="interface-templates">
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="default">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?w=200&h=150&fit=crop&crop=center" 
                                         alt="Interface Template Default" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Default</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="professional">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=200&h=150&fit=crop&crop=center" 
                                         alt="Interface Template Professional" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Professional</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="compact">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=200&h=150&fit=crop&crop=center" 
                                         alt="Interface Template Compact" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Compact</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="modern">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1504639725590-34d0984388bd?w=200&h=150&fit=crop&crop=center" 
                                         alt="Interface Template Modern" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Modern</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Landing Page -->
        <div class="row mt-4">
            <div class="col-12">
                <h5 class="mb-3">Landing Page</h5>
                <p class="text-muted mb-3">Chọn template cho trang chủ</p>
                
                <div class="mb-3">
                    <input type="hidden" name="default_landingpage" id="default_landingpage" value="{{ old('default_landingpage', $config->default_landingpage ?? 'default') }}">
                    
                    <div class="row g-3" id="landing-templates">
                        <!-- Dòng 1 -->
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="template-1">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?w=200&h=150&fit=crop&crop=center" 
                                         alt="Landing Template 1" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Template 1</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="template-2">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=200&h=150&fit=crop&crop=center" 
                                         alt="Landing Template 2" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Template 2</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="template-3">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=200&h=150&fit=crop&crop=center" 
                                         alt="Landing Template 3" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Template 3</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="template-4">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=200&h=150&fit=crop&crop=center" 
                                         alt="Landing Template 4" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Template 4</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="template-5">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=200&h=150&fit=crop&crop=center" 
                                         alt="Landing Template 5" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Template 5</small>
                            </div>
                        </div>
                        
                        <!-- Dòng 2 -->
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="template-6">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1504639725590-34d0984388bd?w=200&h=150&fit=crop&crop=center" 
                                         alt="Landing Template 6" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Template 6</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="template-7">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?w=200&h=150&fit=crop&crop=center" 
                                         alt="Landing Template 7" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Template 7</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="template-8">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=200&h=150&fit=crop&crop=center" 
                                         alt="Landing Template 8" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Template 8</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="template-9">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=200&h=150&fit=crop&crop=center" 
                                         alt="Landing Template 9" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Template 9</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="template-10">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=200&h=150&fit=crop&crop=center" 
                                         alt="Landing Template 10" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Template 10</small>
                            </div>
                        </div>
                        
                        <!-- Dòng 3 -->
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="template-11">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=200&h=150&fit=crop&crop=center" 
                                         alt="Landing Template 11" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Template 11</small>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <div class="template-option" data-template="template-12">
                                <div class="template-preview border rounded overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?w=200&h=150&fit=crop&crop=center" 
                                         alt="Landing Template 12" class="img-fluid">
                                    <div class="template-overlay">
                                        <i class="bx bx-check-circle text-white"></i>
                                    </div>
                                </div>
                                <small class="d-block text-center mt-1">Template 12</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Xem trước giao diện</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="theme-preview-light" class="border rounded p-3 mb-3" style="background: #fff;">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bg-primary rounded-circle me-2" style="width: 8px; height: 8px;"></div>
                                        <div class="bg-warning rounded-circle me-2" style="width: 8px; height: 8px;"></div>
                                        <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                                    </div>
                                    <div class="bg-light p-2 rounded mb-2">
                                        <div class="bg-primary" style="height: 4px; width: 60%; margin-bottom: 4px;"></div>
                                        <div class="bg-secondary" style="height: 3px; width: 80%;"></div>
                                    </div>
                                    <div class="text-center">
                                        <small class="text-muted">Giao diện sáng</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="theme-preview-dark" class="border rounded p-3 mb-3" style="background: #2a3042;">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bg-primary rounded-circle me-2" style="width: 8px; height: 8px;"></div>
                                        <div class="bg-warning rounded-circle me-2" style="width: 8px; height: 8px;"></div>
                                        <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                                    </div>
                                    <div class="p-2 rounded mb-2" style="background: #3a4252;">
                                        <div class="bg-primary" style="height: 4px; width: 60%; margin-bottom: 4px;"></div>
                                        <div class="bg-light" style="height: 3px; width: 80%;"></div>
                                    </div>
                                    <div class="text-center">
                                        <small class="text-light">Giao diện tối</small>
                                    </div>
                                </div>
                            </div>
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

@push('styles')
<style>
.template-option {
    cursor: pointer;
    transition: all 0.3s ease;
}

.template-preview {
    position: relative;
    height: 120px;
    overflow: hidden;
}

.template-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.template-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.template-overlay i {
    font-size: 24px;
}

.template-option:hover .template-preview img {
    transform: scale(1.05);
}

.template-option:hover .template-overlay {
    opacity: 1;
}

.template-option.selected {
    transform: translateY(-2px);
}

.template-option.selected .template-preview {
    border: 2px solid #007bff !important;
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}

.template-option.selected .template-overlay {
    opacity: 1;
    background: rgba(0, 123, 255, 0.8);
}

.template-option.selected small {
    color: #007bff;
    font-weight: 600;
}

@media (max-width: 768px) {
    .template-preview {
        height: 100px;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Template selection functionality
    function initTemplateSelection(containerSelector, hiddenInputSelector) {
        const container = $(containerSelector);
        const hiddenInput = $(hiddenInputSelector);
        const currentValue = hiddenInput.val();
        
        // Set initial selection
        container.find(`.template-option[data-template="${currentValue}"]`).addClass('selected');
        
        // Handle template selection
        container.on('click', '.template-option', function() {
            const template = $(this).data('template');
            
            // Remove previous selection
            container.find('.template-option').removeClass('selected');
            
            // Add selection to clicked template
            $(this).addClass('selected');
            
            // Update hidden input
            hiddenInput.val(template);
        });
    }
    
    // Initialize all template selections
    initTemplateSelection('#login-templates', '#default_login');
    initTemplateSelection('#interface-templates', '#default_interface');
    initTemplateSelection('#landing-templates', '#default_landingpage');
    
    // Highlight selected theme
    const updateThemePreview = () => {
        const selectedTheme = $('#default_theme').val();
        
        $('.card-body [id^="theme-preview-"]').removeClass('border-primary').addClass('border');
        
        if (selectedTheme === 'light') {
            $('#theme-preview-light').removeClass('border').addClass('border-primary border-2');
        } else if (selectedTheme === 'dark') {
            $('#theme-preview-dark').removeClass('border').addClass('border-primary border-2');
        }
    };

    // Update preview on theme change
    $('#default_theme').on('change', updateThemePreview);
    
    // Form submission
    $('#appearanceForm').on('submit', function(e) {
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i>Đang lưu...');
    });
    
    // Initial preview update
    updateThemePreview();
});
</script>
@endpush